<?php

namespace App\Helpers;

class Haversine
{
    public static function calcularDistancia($latitud1, $longitud1, $latitud2, $longitud2, $unidad = 'km')
    {
        $radioTierra = ($unidad === 'mi') ? 3959 : 6371; // Radio de la Tierra en millas o kilómetros

        $latitud1Rad = deg2rad($latitud1);
        $longitud1Rad = deg2rad($longitud1);
        $latitud2Rad = deg2rad($latitud2);
        $longitud2Rad = deg2rad($longitud2);

        $dlat = $latitud2Rad - $latitud1Rad;
        $dlong = $longitud2Rad - $longitud1Rad;

        $a = sin($dlat / 2) * sin($dlat / 2) +
            cos($latitud1Rad) * cos($latitud2Rad) *
            sin($dlong / 2) * sin($dlong / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distancia = $radioTierra * $c;

        return $distancia;
    }
}
