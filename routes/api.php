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
Route::get('/farmacia', [ApiFarmaciaController::class, 'farmaciaCercana']);

//TODO: Definir condiciones para los valores de la URL
