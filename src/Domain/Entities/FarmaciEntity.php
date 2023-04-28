<?php

namespace App\Domain\Entities;

final class FarmaciaEntity
{
    private int $id;
    private string $nombre;
    private string $direccion;
    private float $latitud;
    private float $longitud;

    public function __construct(int $id, string $nombre, string $direccion, float $latitud, float $longitud)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function getLatitud(): float
    {
        return $this->latitud;
    }

    public function getLongitud(): float
    {
        return $this->longitud;
    }
}
