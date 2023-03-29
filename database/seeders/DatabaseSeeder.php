<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    public function run()
    {
        $this->call([
            UserSeeder::class,
        ]);

        $customers = Customer::factory()->count(10)->create();

        foreach ($customers as $customer) {
            $locations = Location::factory()->count(2)->for($customer)->create();

            foreach ($locations as $location) {
                $departments = Department::factory()->count(2)->for($location)->create();

                foreach ($departments as $department) {
                    Space::factory()->count(2)->for($department)->create();
                }
            }
        }

        User::factory()->create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
}
