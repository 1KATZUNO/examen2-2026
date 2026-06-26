<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Material;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    /**
     * Obtener la lista de materiales y las categorías asociadas a éstos.
     * GET /api/materiales
     */
    public function index(): JsonResponse
    {
        $materiales = Material::with('categoria')->get();

        return response()->json($materiales);
    }

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

    /**
     * Actualizar un material.
     * PUT/PATCH /api/materiales/{material}
     */
    public function update(Request $request, Material $material): JsonResponse
    {
        $validated = $request->validate([
            'codigo' => ['sometimes', 'integer', Rule::unique('materiales', 'codigo')->ignore($material->id)],
            'unidad_medida' => ['sometimes', 'string', 'max:255'],
            'descripcion' => ['sometimes', 'string', 'max:255'],
            'ubicacion' => ['sometimes', 'string', 'max:255'],
            'categoria_id' => ['sometimes', 'integer', 'exists:categorias,id'],
        ]);

        $material->update($validated);

        return response()->json($material->load('categoria'));
    }
}
