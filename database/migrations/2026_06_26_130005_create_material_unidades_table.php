<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * MaterialUnidad (idMaterialUnidad, cantidad, idUnidad).
     * Relaciones:
     *  - pertenece a un Material (-material, 1..* -> 1)
     *  - pertenece a una Unidad  (-unidad, "pertenece a", 0..* -> 1)
     *  - comprado con un Presupuesto (-presupuesto, 0..* -> 1)
     */
    public function up(): void
    {
        Schema::create('material_unidades', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->foreignId('material_id')->constrained('materiales')->cascadeOnDelete();
            $table->foreignId('unidad_id')->constrained('unidades')->cascadeOnDelete();
            $table->foreignId('presupuesto_id')->constrained('presupuestos')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_unidades');
    }
};
