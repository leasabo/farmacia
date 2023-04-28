<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

//TODO: Conviene crear otro .env para realizar los tests

class FarmaciaCercanaTest extends TestCase
{
    /**
     * Test buscarFarmaciaCercana.
     *
     * @return void
     */
    public function testBuscarFarmaciaCercana()
    {
        // Parámetros de ubicación (Belén, Catamarca)
        $lat = -27.6622483;
        $lon = -67.0747852;

        // Se hace la petición al endpoint
        $response = $this->get('/api/farmacia?lat=' . $lat . '&lon=' . $lon);

        // Se verifica que la respuesta tenga el código HTTP 200 (OK)
        $response = $this->get('/api/farmacia?lat=-27.6622483&lon=-67.0747852');

        $response->assertStatus(200)
            ->assertJson([
                "msg" => "Farmacia más cercana",
                "data" => [
                    'nombre'        => "Schvening",
                    'direccion'     => "Avellaneda 138, Coronel Du Graty, Chaco",
                    'latitud'       => "-27.68551130",
                    'longitud'      => "-60.91201020"]
            ]);
    }
}
