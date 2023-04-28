<?php

namespace App\Domain\Interfaces;

use App\Domain\Entities\Farmacia;

interface FarmaciaRepositoryInterface
{
    public function save(FarmaciaEntity $farmacia): void;
    public function getById(int $id): ?FarmaciaEntity;
}
