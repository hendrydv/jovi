<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Department;
use App\Models\Location;
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
        } catch (Exception | ErrorException | QueryException $e) {
            $this->info("Something went wrong: " . $e->getMessage());
            DB::rollBack();
            return Command::FAILURE;
        }

        DB::commit();

        return Command::SUCCESS;
    }
}
