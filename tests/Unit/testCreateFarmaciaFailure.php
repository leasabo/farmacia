public function testCreateFarmaciaFailure()
{
    // Se intenta crear una nueva farmacia con datos inválidos
    $payload = [
        'nombre' => '', // Se le pasa un nombre vacío
        'direccion' => 'Julio Argentino Roca 35, Resistencia, Chaco',
        'latitud' => -27.4517118,
        'longitud' => -59.0259271,
    ];
    $response = $this->postJson('/api/farmacia', $payload);

    // Se verifica que la respuesta HTTP sea 422 (unprocessable entity)
    $response->assertStatus(422);

    // Se verifica que la farmacia no haya sido almacenada en la base de datos
    $this->assertDatabaseMissing('farmacias', $payload);
}
