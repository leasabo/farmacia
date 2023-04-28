<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\FarmaciaEntity;
use App\Domain\Exceptions\FarmaciaNotFoundException;
use App\Domain\Interfaces\FarmaciaRepositoryInterface;
use App\Models\Farmacia as FarmaciaModel;

class FarmaciaRepository implements FarmaciaRepositoryInterface
{
    public function save(FarmaciaEntity $farmacia): void
    {
