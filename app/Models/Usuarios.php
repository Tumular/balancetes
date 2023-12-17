<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuarios extends Model
{
    use SoftDeletes;

    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'senha',
        'nome',
        'email',
    ];
}
