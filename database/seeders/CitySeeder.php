<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            ["id" => "1", "name" => "Cairo"],
            ["id" => "2", "name" => "Giza"],
            ["id" => "3", "name" => "Alexandria"],
            ["id" => "4", "name" => "Dakahlia"],
            ["id" => "5", "name" => "Red Sea"],
            ["id" => "6", "name" => "Beheira"],
            ["id" => "7", "name" => "Fayoum"],
            ["id" => "8", "name" => "Gharbiya"],
            ["id" => "9", "name" => "Ismailia"],
            ["id" => "10", "name" => "Menofia"],
            ["id" => "11", "name" => "Minya"],
            ["id" => "12", "name" => "Qaliubiya"],
            ["id" => "13", "name" => "New Valley"],
            ["id" => "14", "name" => "Suez"],
            ["id" => "15", "name" => "Aswan"],
            ["id" => "16", "name" => "Assiut"],
            ["id" => "17", "name" => "Beni Suef"],
            ["id" => "18", "name" => "Port Said"],
            ["id" => "19", "name" => "Damietta"],
            ["id" => "20", "name" => "Sharkia"],
            ["id" => "21", "name" => "South Sinai"],
            ["id" => "22", "name" => "Kafr Al sheikh"],
            ["id" => "23", "name" => "Matrouh"],
            ["id" => "24", "name" => "Luxor"],
            ["id" => "25", "name" => "Qena"],
            ["id" => "26", "name" => "North Sinai"],
            ["id" => "27", "name" => "Sohag"]
        ]);
    }
}
