<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unidad extends Model
{
    protected $table = 'unidades';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Una Unidad tiene muchos MaterialUnidad (1 -> 0..*).
     */
    public function materialUnidades(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class, 'unidad_id');
    }

    /**
     * Una Unidad tiene muchos Presupuesto (1 -> 1..*).
     */
    public function presupuestos(): HasMany
    {
        return $this->hasMany(Presupuesto::class, 'unidad_id');
    }
}
