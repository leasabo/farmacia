<?php

namespace App\Domain\Exceptions;

use Exception;

class FarmaciaNotFoundException extends Exception
{
    protected $message = 'Farmacia no encontrada.';
}
