<?php

namespace App\Application\Services;

use App\Domain\Entities\FarmaciaEntity;
use App\Domain\Interfaces\FarmaciaRepositoryInterface;
use App\Helpers\Haversine;

class FarmaciaService
{
    private FarmaciaRepositoryInterface $farmaciaRepository;

    public function __construct(FarmaciaRepositoryInterface $farmaciaRepository)
    {
        $this->farmaciaRepository = $farmaciaRepository;
    }

    public function getFarmaciaCercana(float $latitud, float $longitud): ?FarmaciaEntity
    {
        $farmaciaMasCercana = null;
        $distanciaMinima = PHP_FLOAT_MAX;
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        
        foreach (FarmaciaEntity::all() as $farmacia) {
            $latFarma = $farmacia->latitud;
            $lonFarma = $farmacia->longitud;
            $distancia = Haversine::calcularDistancia($lat, $lon, $latFarma, $lonFarma);
            if ($distanciaMinima>$distancia) {
                $distanciaMinima=$distancia;
                $farmaciaMasCercana = $farmacia->id;
            }   
        }

        $farmacia = FarmaciaEntity::find($farmaciaMasCercana);
    }
}
