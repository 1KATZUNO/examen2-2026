<?php

use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

// Insertar un material con su categoría asociada (miembro equipo 1)
Route::post('/materiales', [MaterialController::class, 'store']);
