public function testCreateFarmaciaSuccess()
{
    // Se crea una nueva farmacia con datos válidos
    $payload = [
        'nombre' => 'Farmacia San Pedro',
        'direccion' => 'Julio Argentino Roca 35, Resistencia, Chaco',
        'latitud' => -27.4517118,
        'longitud' => -59.0259271,
    ];
    $response = $this->postJson('/api/farmacia', $payload);

    // Se verifica que la respuesta HTTP sea 201 (creado)
    $response->assertStatus(201);

    // Se verifica que el cuerpo de la respuesta contenga los datos de la farmacia creada
    $response->assertJsonStructure([
        'data' => [
            'id',
            'nombre',
            'direccion',
            'latitud',
            'longitud',
            'created_at',
            'updated_at',
        ]
    ]);

    // Se verifica que la farmacia haya sido almacenada en la base de datos
    $this->assertDatabaseHas('farmacias', $payload);
}
