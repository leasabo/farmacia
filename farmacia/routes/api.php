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

Route::post('crear', [ApiFarmaciaController::class, 'crear']);
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
