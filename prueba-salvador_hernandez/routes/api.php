<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('employees')->group(function(){
    Route::get('/empleado/', [EmpleadoController::class, 'indexEmpleados']);
    Route::get('/empleado/{idEmpleado}', [EmpleadoController::class, 'get']);
    Route::post('/empleado', [EmpleadoController::class, 'insert']);
    Route::put('/empleado', [EmpleadoController::class, 'update']);
    Route::delete('/empleado/{idEmpleado}', [EmpleadoController::class, 'delete']);
    Route::get('/getMunicipios/{idDepartamento}',[EmpleadoController::class, 'getMunicipios']);
    Route::post('/obtenerEmpleadosFilter',[EmpleadoController::class,'obtenerEmpleadosFilter']);
});


