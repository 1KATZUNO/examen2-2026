<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Insertar un material con su categoría asociada.
     * Se acepta una categoría existente (categoria_id) o el nombre de una
     * categoría nueva (categoria), que se crea si no existe.
     * POST /api/materiales
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'codigo' => ['required', 'integer', 'unique:materiales,codigo'],
            'unidad_medida' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:255'],
            'ubicacion' => ['required', 'string', 'max:255'],
            'categoria_id' => ['required_without:categoria', 'integer', 'exists:categorias,id'],
            'categoria' => ['required_without:categoria_id', 'string', 'max:255'],
        ]);

        $categoriaId = $validated['categoria_id']
            ?? Categoria::firstOrCreate(['nombre' => $validated['categoria']])->id;

        $material = Material::create([
            'codigo' => $validated['codigo'],
            'unidad_medida' => $validated['unidad_medida'],
            'descripcion' => $validated['descripcion'],
            'ubicacion' => $validated['ubicacion'],
            'categoria_id' => $categoriaId,
        ]);

        return response()->json($material->load('categoria'), 201);
    }
}
