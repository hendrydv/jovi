<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\InspectionList;
use App\Models\InspectionMachine;
use App\Models\InspectionMachineResult;
use App\Models\InspectionResult;
use App\Models\Machine;
use App\Models\Question;
use App\Models\SpaceMachine;
use Database\Factories\InspectionMachineResultFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Department;
use App\Models\Space;
use App\Models\Option;

use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = app(Generator::class);

        $this->call([
            UserSeeder::class,
            MachineSeeder::class,
            OptionSeeder::class,
        ]);

        $adminUser = User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        $customers = Customer::factory()->count(3)->create();

        Question::factory()->count(50)->create()->each(function ($question) {
            $question->options()->attach(Option::all()->random(3));
        });

        InspectionList::factory()->count(5)->create()->each(function ($inspectionList) {
            $inspectionList->questions()->attach(Question::all()->random(10));
        });

        foreach ($customers as $customer) {
            $inspection = Inspection::factory(['date' => date('Y-m-d')])->for($customer)->for($adminUser)->create();

            $locations = Location::factory()->count(2)->for($customer)->create();

            foreach ($locations as $location) {
                $departments = Department::factory()->count(2)->for($location)->create();

                foreach ($departments as $department) {
                    $spaces = Space::factory()->count(2)->for($department)->create();

                    foreach ($spaces as $space) {
                        $machines = Machine::all()->random(2);

                        foreach ($machines as $idx => $machine) {
                            $space->machines()->attach($machine, [
                                'inventory_number' => $idx + 1,
                            ]);

                            $inspectionList = InspectionList::all()->random();
                            foreach ($inspectionList->questions as $question) {
                                $spaceMachine = SpaceMachine::where([
                                    'space_id' => $space->id,
                                    'machine_id' => $machine->id,
                                ])->first();
                                InspectionMachineResult::factory([
                                    'result' => null,
                                ])->for($inspection)->for($spaceMachine)->for($question)->create();
                            }

                            $machine->inspectionList()->associate($inspectionList);

                            $machine->save();
                        }
                    }
                }
            }
        }
    }
}
