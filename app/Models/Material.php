<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $table = 'materiales';

    protected $fillable = [
        'codigo',
        'unidad_medida',
        'descripcion',
        'ubicacion',
        'categoria_id',
    ];

    /**
     * Un Material pertenece a una Categoria (0..* -> 1).
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Un Material tiene muchos MaterialUnidad (1 -> 1..*).
     */
    public function materialUnidades(): HasMany
    {
        return $this->hasMany(MaterialUnidad::class, 'material_id');
    }
}
