<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bancos extends Model
{
    use SoftDeletes;

    protected $table = 'bancos';

    protected $fillable = [
        'usuario_id',
        'nome',
        'saldo'
    ];
}
