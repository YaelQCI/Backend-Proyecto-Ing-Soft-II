<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CasoController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\HerramientaController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ChatbotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí se registran las rutas de tu aplicación.
| Puedes mantener las rutas de autenticación y añadir las nuevas.
|
*/

// Rutas de autenticación (públicas)
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
Route::post('/verify', [App\Http\Controllers\Api\AuthController::class, 'verify']);

// Rutas protegidas
Route::middleware('auth:api')->get('/user', [App\Http\Controllers\Api\UserController::class, 'show']);

// --------------------
// Rutas de Usuarios
// --------------------
Route::get('/usuarios', [UsuarioController::class, 'index']);
Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);

// --------------------
// Rutas de Casos
// --------------------
Route::get('/casos', [CasoController::class, 'index']);
Route::get('/casos/{id}', [CasoController::class, 'show']);

// --------------------
// Rutas de Asignaciones
// --------------------
Route::get('/asignaciones/caso/{idCaso}', [AsignacionController::class, 'porCaso']);

// --------------------
// Rutas de Evidencias
// --------------------
Route::get('/evidencias/caso/{idCaso}', [EvidenciaController::class, 'porCaso']);

// --------------------
// Rutas de Actividades
// --------------------
Route::get('/actividades/caso/{idCaso}', [ActividadController::class, 'porCaso']);

// --------------------
// Rutas de Herramientas
// --------------------
Route::get('/herramientas', [HerramientaController::class, 'index']);
Route::get('/herramientas/categorias/{id}/herramientas', [HerramientaController::class, 'porCategoria']);

// --------------------
// Rutas de Logs
// --------------------
Route::get('/logs/usuario/{idUsuario}', [LogController::class, 'porUsuario']);
Route::get('/logs/caso/{idCaso}', [LogController::class, 'porCaso']);

// --------------------
// Rutas de Chatbots
// --------------------
Route::get('/chatbots/usuario/{idUsuario}', [ChatbotController::class, 'porUsuario']);
