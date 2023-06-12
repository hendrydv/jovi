<?php

namespace App\Console\Commands;

use App\Models\Customer;
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
        DB::beginTransaction();

        $user = new User();
        $user->name = 'Admin Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin123');
        $user->is_admin = true;
        $user->save();

        try {
            $db = DB::connection('mysql_acces');

            $relaties = $db->select('select * from relaties');

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
            }

            $adressen = $db->select('select * from adressen');
            dd($adressen);

        } catch (Exception | ErrorException | QueryException $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();

        return Command::SUCCESS;
    }
}