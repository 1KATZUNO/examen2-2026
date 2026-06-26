<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Presupuesto extends Model
{
    protected $table = 'presupuestos';

    protected $fillable = [
        'codigo_presupuesto',
        'nombre_presupuesto',
        'unidad_id',
    ];

    /**
     * Un Presupuesto pertenece a una Unidad (1..* -> 1).
     */
    public function unidad(): BelongsTo
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }

    /**
     * Un Presupuesto tiene muchos MaterialUnidad (1 -> 0..*).
     */
    public function materialUnidades(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class, 'presupuesto_id');
    }
}
