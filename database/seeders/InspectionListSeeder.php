<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InspectionList;
use App\Models\Question;

use Faker\Factory as Faker;

class InspectionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $faker = Faker::create();
        InspectionList::factory()
            ->count(10)
            ->has(Question::factory()->count(5))
            ->create();

//        foreach ($inspectionLists as $inspectionList) {
//            for ($i = 0; $i < 10; $i++) {
//                $inspectionList->questions()->attach(Question::factory()->create(), ['index' => $i]);
//            }
//        }
    }
}
