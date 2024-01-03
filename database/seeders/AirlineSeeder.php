<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            [
                "name" => "LATAM",
                "icao" => "TAM",
            ],
            [
                "name" => "GOL",
                "icao" => "GLO",
            ],
            [
                "name" => "AZUL",
                "icao" => "AZU",
            ],
            [
                "name" => "AVIANCA",
                "icao" => "ONE",
            ]
        ];

        foreach($airlines as $airline) {
            Airline::create([
                'name' => $airline['name'],
                'icao' => $airline['icao']
            ]);
        }
    }
}
