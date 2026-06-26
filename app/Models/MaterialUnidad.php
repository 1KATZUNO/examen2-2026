<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialUnidad extends Model
{
    protected $table = 'material_unidades';

    protected $fillable = [
        'cantidad',
        'material_id',
        'unidad_id',
        'presupuesto_id',
    ];

    /**
     * Un MaterialUnidad pertenece a un Material (1..* -> 1).
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    /**
     * Un MaterialUnidad pertenece a una Unidad ("pertenece a", 0..* -> 1).
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    /**
     * Un MaterialUnidad fue comprado con un Presupuesto (0..* -> 1).
     */
    public function presupuesto(): BelongsTo
    {
        return $this->belongsTo(Presupuesto::class, 'presupuesto_id');
    }
}
