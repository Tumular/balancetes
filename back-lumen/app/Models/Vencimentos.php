<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vencimentos extends Model
{
    use SoftDeletes;

    protected $table = 'vencimentos';

    protected $fillable = [
        'usuario_id',
        'descricao',
        'observacao',
        'valor',
        'data_vencimento',
        'tipo',
        'categoria_id',
        'fatura_cartao_id',
    ];
}
