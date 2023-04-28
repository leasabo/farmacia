<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmacia;
use Illuminate\Http\Request;
use App\Helpers\Haversine;

class FarmaciaController extends Controller
{
    // TODO: El nombre de la farmacia podría ser único
    // TODO: Validar que la latitud y la longitud sean numéricos
    public function create(Request $request){
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'latitud' => 'required|numeric',
            'longitud' => 'required|numeric'
        ]);

        $farmacia = new Farmacia();
        $farmacia->nombre = $request->nombre;
        $farmacia->direccion = $request->direccion;
        $farmacia->latitud = $request->latitud;
        $farmacia->longitud = $request->longitud;

        $farmacia->save();

        return response()->json([
            "msg" => "Alta de farmacia exitosa",
        ], 201);
    }

    //TODO: Pensar en algún limitador por si son demasiadas las farmacias cargadas
    public function list(){
        $farmacias = Farmacia::all();
        return response()->json([
            "msg" => "Listado de farmacias",
            "data" => $farmacias
        ], 200);
    }

    public function show($id){
        if ( Farmacia::where(["id"=>$id])->exists() ) {
            $farmacia = Farmacia::where(["id"=>$id])->first();
            return response()->json([
                "msg" => "Datos de la farmacia solicitada",
                "data" => $farmacia
            ], 200);
        }else {
            return response()->json([
                "msg" => "La farmacia no fue encontrada"
            ], 404);
        }
    }

    public function update(Request $request, $id){
        if ( Farmacia::where(["id"=>$id])->exists() ) {
            $farmacia = Farmacia::find($id);

            //Si algún valor no es proporcionado, queda el que ya tenía
            $farmacia->nombre = isset($request->nombre) ? $request->nombre: $farmacia->nombre;
            $farmacia->direccion = isset($request->direccion) ? $request->direccion: $farmacia->direccion;
            $farmacia->latitud = isset($request->latitud) ? $request->latitud: $farmacia->latitud;
            $farmacia->longitud = isset($request->longitud) ? $request->longitud: $farmacia->longitud;

            $farmacia->save();

            return response()->json([
                "msg" => "Farmacia actualizada correctamente"
            ], 200);
        }else {
            return response()->json([
                "msg" => "La farmacia no fue encontrada"
            ], 404);
        }
    }

    public function delete($id){
        if ( Farmacia::where(["id"=>$id])->exists() ) {
            $farmacia = Farmacia::where(["id"=>$id])->first();

            $farmacia->delete();

            return response()->json([
                "msg" => "Farmacia eliminada correctamente"
            ], 200);
        }else {
            return response()->json([
                "msg" => "La farmacia no fue encontrada"
            ], 404);
        }
    }

    //TODO: Contemplar que no hayan farmacias cargadas
    public function farmaciaCercana(Request $request){
        $farmaciaMasCercana = null;
        $distanciaMinima = PHP_FLOAT_MAX;
        $lat = $request->query('lat');
        $lon = $request->query('lon');
        
        foreach (Farmacia::all() as $farmacia) {
            $latFarma = $farmacia->latitud;
            $lonFarma = $farmacia->longitud;
            $distancia = Haversine::calcularDistancia($lat, $lon, $latFarma, $lonFarma);
            if ($distanciaMinima>$distancia) {
                $distanciaMinima=$distancia;
                $farmaciaMasCercana = $farmacia->id;
            }   
        }

        $farmacia = Farmacia::find($farmaciaMasCercana);

        return response()->json([
            "msg" => "Farmacia más cercana",
            "data" => $farmacia
        ], 200);
    }

}
