<?php

use App\Http\Controllers\Api\FarmaciaController as ApiFarmaciaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\App\Controllers\Api\FarmaciaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Rutas CRUD
Route::post('create-farmacia', [ApiFarmaciaController::class, 'create']);
Route::get('list-farmacia', [ApiFarmaciaController::class, 'list']);
Route::get('show-farmacia/{id}', [ApiFarmaciaController::class, 'show']);
Route::put('update-farmacia/{id}', [ApiFarmaciaController::class, 'update']);
Route::delete('delete-farmacia/{id}', [ApiFarmaciaController::class, 'delete']);

//Ruta para la farmacia más cercana
//GET http://localhost:<port>/api/farmacia?lat=<number>&lon=<number>
// Route::get('/farmacia?lat={lat}&lon={lon}', 'FarmaciaController@buscarFarmaciaCercana')

//TODO: Agregar condición del where para la ruta anterior
// ->where([
//     'lat' => '[0-9.-]+',
//     'lon' => '[0-9.-]+'
// ]);

// Route::get('colaboradores/{nombre}', function($nombre){
// 	return "Mostrando el colaborador $nombre";
// })->where(array('nombre' => '[a-zA-Z]+'));


//Route::post('login', [ApiFarmaciaController::class, 'login']);

//Grupo de rutas pensado por si se implementa login
// Route::group(['middleware' => ["auth:sanctum"]], function(){
//     Route::get('eliminar', [FarmaciaController::class, 'eliminar']); //Ruta para eliminar una farmacia
//     Route::get('eliminar', [FarmaciaController::class, 'eliminar']); //Ruta para eliminar una farmacia
//     Route::get('eliminar', [FarmaciaController::class, 'eliminar']); //Ruta para eliminar una farmacia
// });


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
