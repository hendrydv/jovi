<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Customer;
use App\Models\Department;
use App\Models\Kind;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Space;
use App\Models\User;
use ErrorException;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ConvertDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'convert:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws Exception
     */
    public function handle(): int
    {
        $this->call('migrate:fresh', [
            '--force' => true,
        ]);

        DB::beginTransaction();

        try {
            $user = new User();
            $user->name = 'Admin Admin';
            $user->email = 'admin@admin.com';
            $user->password = bcrypt('admin123');
            $user->is_admin = true;
            $user->save();

            $this->info('Admin user created');

            $db = DB::connection('mysql_acces');

            $relaties = $db->select('select * from relaties');

            $this->info("Relaties: " . count($relaties) . " gevonden");

            foreach ($relaties as $relatie) {
                $customer = new Customer();
                $customer->id = $relatie->Relatienummer;
                $customer->name = $relatie->Naam;
                $customer->contract_start_date = $relatie->ContractStart;
                $customer->contract_end_date = $relatie->ContractEind;
                $customer->is_active = $relatie->Actief;
                $customer->preferred_month = array_search($relatie->Voorkeursmaand, Customer::MONTHS) ?: null;
                $customer->notes = $relatie->Memo;
                $customer->save();

                $adressen = $db->select('select * from adressen where Relatienummer = ?', [$relatie->Relatienummer]);

                $customerName = $relatie->Naam;
                $this->info("$customerName: Adressen: " . count($adressen) . " gevonden");

                foreach ($adressen as $adres) {
                    $location = new Location();
                    $location->id = $adres->AdresPrimary;
                    $location->customer_id = $adres->Relatienummer;
                    $location->street = $adres->Adres;
                    $location->city = $adres->Plaats;
                    $location->save();

                    $ruimtes = $db->select('select * from ruimtes where Adres = ?', [$adres->Adres]);

                    $departmentIds = [];
                    foreach ($ruimtes as $ruimte) {
                        $departmentIds[] = $ruimte->Afdelingsnummer;
                    }

                    $afdelingen = $db->select('select * from Afdelingen where Afdelingsnummer in (' . implode(',', array_unique($departmentIds)) . ')');

                    $adresName = $relatie->Naam . " " . $adres->Adres;
                    $this->info("$adresName: Afdelingen: " . count($afdelingen) . " gevonden");

                    foreach ($afdelingen as $afdeling) {
                        DB::table('departments')->insertOrIgnore([
                            'id' => $afdeling->Afdelingsnummer,
                            'location_id' => $adres->AdresPrimary,
                            'name' => $afdeling->Afdelingsnaam,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);

                        $ruimtes = $db->select('select * from ruimtes where Afdelingsnummer = ?', [$afdeling->Afdelingsnummer]);

                        $afdelingName = $relatie->Naam . " " . $adres->Adres . " " . $afdeling->Afdelingsnaam;
                        $this->info("$afdelingName: Ruimtes: " . count($ruimtes) . " gevonden");

                        foreach ($ruimtes as $ruimte) {
                            DB::table('spaces')->insertOrIgnore([
                                'id' => $ruimte->Ruimtenummer,
                                'department_id' => $afdeling->Afdelingsnummer,
                                'name' => $ruimte->Ruimtenaam,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        }
                    }
                }
                $this->info("--------------------");
            }

            $merken = $db->select('select distinct Merk from machines_algemeen');
            foreach ($merken as $merk){
                $brand = new Brand();
                $brand->name = ucfirst(strtolower($merk->Merk));
                $brand->save();
            }

            $omschrijvingen = $db->select('select distinct Omschrijving from machines_algemeen');
            foreach ($omschrijvingen as $omschrijving){
                $kind = new Kind();
                $kind->name = ucfirst(strtolower($omschrijving->Omschrijving));
                $kind->save();
            }

            $machines_algemeen = $db->select('select * from machines_algemeen');

            foreach ($machines_algemeen as $machine_algemeen){
                $machine = new Machine();
                $machine->id = $machine_algemeen->Machine_Index;
                $machine->type = $machine_algemeen->Type;
                $machine->brand_id = Brand::where('name', ucfirst(strtolower($machine_algemeen->Merk)))->first()->id;
                $machine->kind_id = Kind::where('name', ucfirst(strtolower($machine_algemeen->Omschrijving)))->first()->id;
                $machine->supplier = $machine_algemeen->Leverancier;
                //$machine->inspection_list_id = $machines_algemeen->Inspectielijst;
                $machine->save();
            }

            $machines_onderhoud = $db->select('select * from machines_onderhoud');
            foreach ($machines_onderhoud as $machine_onderhoud){
                $space = Space::where('id', $machine_onderhoud->Ruimtenummer)->first();
                $machine = Machine::find($machine_onderhoud->Machine_Index);
                $space->machines()->attach($machine, [
                    'id' => $machine_onderhoud->Machines_onderhoudPrimary,
                    'inventory_number' => $machine_onderhoud->Intern_nummer,
                ]);

                $machine->save();
            }


        } catch (Exception | ErrorException | QueryException $e) {
            $this->info("Something went wrong: " . $e->getMessage());
            DB::rollBack();
            return Command::FAILURE;
        }

        DB::commit();

        return Command::SUCCESS;
    }
}
