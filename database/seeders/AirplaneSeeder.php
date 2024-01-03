<?php

namespace Database\Seeders;

use App\Helpers\FlightHelper;
use App\Models\Airplane;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirplaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $tamFlight = FlightHelper::generateFlights('TAM', 0, 20, 1);
       Airplane::insert($tamFlight);

       $golFlight = FlightHelper::generateFlights('GLO', 0, 20, 2);
       Airplane::insert($golFlight);

       $azulFlight = FlightHelper::generateFlights('AZU', 0, 20, 3);
       Airplane::insert($azulFlight);

       $aviancaFlight = FlightHelper::generateFlights('ONE', 0, 20, 4);
       Airplane::insert($aviancaFlight);
    }
}
