<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inspection;
use App\Models\InspectionResult;
use App\Models\Machine;
use App\Models\Question;
use Database\Factories\InspectionFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Department;
use App\Models\Space;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MachineSeeder::class,
        ]);

        $customers = Customer::factory()->count(10)->create();

        foreach ($customers as $customer) {
            $locations = Location::factory()->count(2)->for($customer)->create();

            foreach ($locations as $location) {
                $departments = Department::factory()->count(2)->for($location)->create();

                foreach ($departments as $department) {
                    $spaces = Space::factory()->count(2)->for($department)->create();

                    foreach ($spaces as $space) {
                        $machines = Machine::inRandomOrder()->limit(3)->get();

                        $space->machines()->attach($machines);
                    }
                }
            }
        }

        User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        foreach (Machine::all() as $machine) {
            $questions = Question::factory()->count(10)->create();

            $user = User::all()->random();
            $inspection = Inspection::factory()->for($machine->spaces()->first())->for($machine)->for($user)->create();

            foreach ($questions as $question) {
                InspectionResult::factory()->for($inspection)->for($question)->create();
            }

            $machine->inspectionList->questions()->attach($questions);
        }
    }
}
