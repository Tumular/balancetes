<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transacoes extends Model
{
    use SoftDeletes;

    protected $table = 'transacoes';

    protected $fillable = [
        'usuario_id',
        'banco_id',
        'vencimento_id',
        'valor',
        'tipo'
    ];
}
