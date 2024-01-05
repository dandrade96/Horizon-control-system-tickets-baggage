<?php

namespace App\Helpers;

class FlightHelper
{
    public static function generateFlights($icaoCode, $start, $end, $airlineId)
    {
        $flights = [];
        for ($i = $start; $i <= $end; $i++) {
            $flights[] = [
                "icao24" => $icaoCode . str_pad($i, 3, '0', STR_PAD_LEFT),
                "airline_id" => $airlineId
            ];
        }
        return $flights;
    }
}
