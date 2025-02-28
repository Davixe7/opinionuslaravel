<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\VoteController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use Illuminate\Http\Request;

// Rutas de autenticación
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth:sanctum']);

// Rutas públicas (sin autenticación)
Route::get('/surveys', [SurveyController::class, 'index']);
Route::get('/surveys/{survey}', [SurveyController::class, 'show']);
Route::get('/surveys/{survey}/options', [OptionController::class, 'index']);
Route::post('/surveys/{survey}/votes', [VoteController::class, 'store']);

// Rutas protegidas (con autenticación)
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/surveys', [SurveyController::class, 'store']);
    Route::put('/surveys/{survey}', [SurveyController::class, 'update']);
    Route::delete('/surveys/{survey}', [SurveyController::class, 'destroy']);
    Route::post('/surveys/{survey}/options', [OptionController::class, 'store']);
    Route::put('/surveys/{survey}/options/{option}', [OptionController::class, 'update']);
    Route::delete('/surveys/{survey}/options/{option}', [OptionController::class, 'destroy']);
    Route::apiResource('surveys.votes', VoteController::class, ['except' => ['store']]);
});

// Ruta para obtener información del usuario autenticado
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

