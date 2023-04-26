<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmacia;
use Illuminate\Http\Request;

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
        
    }

    public function update(Request $request, $id){
        if ( Farmacia::where(["id"=>$id])->exists() ) {
            $farmacia = Farmacia::find($id);

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
}
