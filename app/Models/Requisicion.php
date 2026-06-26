<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisicion extends Model
{
    protected $table = 'requisiciones';

    protected $fillable = [
        'fecha',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];
}
