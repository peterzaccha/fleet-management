<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gizaToAswan = Trip::create([
            'name' => "From Giza To Aswan",
        ]);
        $gizaToAswan->cities()->attach([
            2 => ['order' => 1],
            17 => ['order' => 2],
            11 => ['order' => 3],
            16 => ['order' => 4],
            27 => ['order' => 5],
            25 => ['order' => 6],
            24 => ['order' => 7],
            15 => ['order' => 8],
        ]);
        $gizaToAswan->generatePath();

        $aswanToGiza = Trip::create(['name' => "From Aswan To Giza"]);
        $aswanToGiza->cities()->attach([
            2 => ['order' => 8],
            17 => ['order' => 7],
            11 => ['order' => 6],
            16 => ['order' => 5],
            27 => ['order' => 4],
            25 => ['order' => 3],
            24 => ['order' => 2],
            15 => ['order' => 1],
        ]);
        $aswanToGiza->generatePath();
    }
}
