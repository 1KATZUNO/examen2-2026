<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
    ];

    /**
     * Una Categoria tiene muchos Material (1 -> 0..*).
     */
    public function materiales(): HasMany
    {
        return $this->hasMany(Material::class, 'categoria_id');
    }
}
