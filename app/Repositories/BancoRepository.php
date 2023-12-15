<?php

namespace App\Repositories;

use App\Models\Banco;

class BancoRepository
{
    public function listarBancos()
    {
        return Banco::all();
    }
}
