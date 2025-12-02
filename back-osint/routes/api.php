<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Rutas de autenticación (públicas)
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::post('/verify', [App\Http\Controllers\Api\AuthController::class, 'verify']);

// Rutas protegidas
Route::middleware('auth:api')->get('/user', [App\Http\Controllers\Api\UserController::class, 'show']);

// Rutas del Módulo Capturista (protegidas)
Route::middleware(['auth:api', 'capturista'])->prefix('capturista')->group(function () {
    
    // Gestión de casos asignados
    Route::get('/casos', [App\Http\Controllers\Api\CapturistaController::class, 'getCasosAsignados']);
    Route::get('/casos/{id}', [App\Http\Controllers\Api\CapturistaController::class, 'verCaso']);
    
    // Gestión de evidencias
    Route::get('/casos/{idCaso}/evidencias', [App\Http\Controllers\Api\CapturistaController::class, 'getEvidencias']);
    Route::post('/evidencias', [App\Http\Controllers\Api\CapturistaController::class, 'agregarEvidencia']);
    Route::put('/evidencias/{id}', [App\Http\Controllers\Api\CapturistaController::class, 'actualizarEvidencia']);
    Route::delete('/evidencias/{id}', [App\Http\Controllers\Api\CapturistaController::class, 'eliminarEvidencia']);
    
    // Generación de reportes
    Route::get('/casos/{idCaso}/reporte-completo', [App\Http\Controllers\Api\CapturistaController::class, 'generarReporteCompleto']);
    Route::get('/casos/{idCaso}/reporte-evidencias', [App\Http\Controllers\Api\CapturistaController::class, 'generarReporteEvidencias']);
    Route::post('/casos/{idCaso}/reporte-personalizado', [App\Http\Controllers\Api\CapturistaController::class, 'generarReportePersonalizado']);
    
    // Gestión de reportes
    Route::get('/casos/{idCaso}/reportes', [App\Http\Controllers\Api\CapturistaController::class, 'listarReportes']);
    Route::get('/reportes/{nombreArchivo}/descargar', [App\Http\Controllers\Api\CapturistaController::class, 'descargarReporte']);
});