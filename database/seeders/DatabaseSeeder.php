<?php

namespace Database\Seeders;

use App\Models\Inspection;
use App\Models\InspectionMachine;
use App\Models\InspectionResult;
use App\Models\Machine;
use App\Models\Question;
use App\Models\SpaceMachine;
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
        ]);

        $adminUser = User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        $customers = Customer::factory()->count(10)->create();

        Option::factory()->count(10)->create();

        foreach ($customers as $customer) {
            $inspection = Inspection::factory(['date' => date('Y-m-d')])->for($customer)->for($adminUser)->create();

            $locations = Location::factory()->count(2)->for($customer)->create();

            foreach ($locations as $location) {
                $departments = Department::factory()->count(2)->for($location)->create();

                foreach ($departments as $department) {
                    $spaces = Space::factory()->count(2)->for($department)->create();

                    foreach ($spaces as $space) {
                        $machines = Machine::inRandomOrder()->limit(3)->get();

                        foreach ($machines as $idx => $machine) {
                            $space->machines()->attach($machine, [
                                'inventory_number' => $idx + 1,
                            ]);

                            $questions = Question::factory()->count(10)->create();

                            foreach ($questions as $question) {
                                $question->options()->attach(Option::all()->random(3));
                            }

                            $machine->inspectionList->questions()->attach($questions);
                        }
                    }
                }
            }
        }
    }
}
