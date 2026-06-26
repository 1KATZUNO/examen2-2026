<?php

use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;

// Obtener la lista de materiales y sus categorías asociadas (miembro equipo 3)
Route::get('/materiales', [MaterialController::class, 'index']);

// Insertar un material con su categoría asociada (miembro equipo 1)
Route::post('/materiales', [MaterialController::class, 'store']);

// Actualizar un material (miembro equipo 2)
Route::match(['put', 'patch'], '/materiales/{material}', [MaterialController::class, 'update']);
