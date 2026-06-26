<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Material (codigo, unidadMedida, descripcion, ubicacion).
     * Relaciones: pertenece a una Categoria (0..* -> 1) y tiene muchos MaterialUnidad.
     */
    public function up(): void
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->unique();
            $table->string('unidad_medida');
            $table->string('descripcion');
            $table->string('ubicacion');
            $table->foreignId('categoria_id')->constrained('categorias')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materiales');
    }
};
