<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmacia;
use Illuminate\Http\Request;

class FarmaciaController extends Controller
{
    // TODO: Validar que el nombre sea único
    // TODO: Validar que la latitud y la longitud sean numéricos
    public function crear(Request $request){
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'latitud' => 'required',
            'longitud' => 'required'
        ]);

        $farmacia = new Farmacia();
        $farmacia->nombre = $request->nombre;
        $farmacia->direccion = $request->direccion;
        $farmacia->latitud = $request->latitud;
        $farmacia->longitud = $request->longitud;

        $farmacia->save();

        return response()->json([
            "status" => 200,
            "msg" => "Alta de farmacia exitosa",
        ]);
    }
}
