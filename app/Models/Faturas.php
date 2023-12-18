<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faturas extends Model
{
    use SoftDeletes;

    protected $table = 'faturas_cartoes';

    protected $fillable = [
        'usuario_id',
        'valor_total',
        'data_vencimento',
        'descricao',
        'parcelas'
    ];
}
