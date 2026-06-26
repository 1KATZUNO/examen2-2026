<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Valida que el endpoint encargado de insertar nuevos registros de
     * materiales, para el escenario en el cual el material no existe,
     * lo hace correctamente.
     */
    #[Test]
    public function dadoUnMaterialQueNoExiste_insertarMaterial_funcionaCorrectamente(): void
    {
        // Arrange: una categoría existente y un material que aún no existe.
        $categoria = Categoria::create(['nombre' => 'Herramientas']);

        $payload = [
            'codigo' => 1001,
            'unidad_medida' => 'unidad',
            'descripcion' => 'Taladro percutor',
            'ubicacion' => 'Bodega A',
            'categoria_id' => $categoria->id,
        ];

        $this->assertDatabaseMissing('materiales', ['codigo' => 1001]);

        // Act: se solicita la inserción del material.
        $response = $this->postJson('/api/materiales', $payload);

        // Assert: se creó correctamente y quedó persistido con su categoría.
        $response->assertCreated();
        $response->assertJsonPath('codigo', 1001);
        $response->assertJsonPath('categoria.id', $categoria->id);

        $this->assertDatabaseHas('materiales', [
            'codigo' => 1001,
            'descripcion' => 'Taladro percutor',
            'categoria_id' => $categoria->id,
        ]);
    }
}
