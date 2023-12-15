<?php

namespace App\Repositories;

use App\Models\Bancos;

class BancosRepository
{
    public function listarBancos()
    {
        return Bancos::all();
    }
}
