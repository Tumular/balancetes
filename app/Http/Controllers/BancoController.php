<?php

namespace App\Http\Controllers;

use App\Services\BancoService;

class BancoController extends Controller
{
    private $bancoService;

    public function __construct(BancoService $bancoService)
    {
        $this->bancoService = $bancoService;
    }

    public function listarBancos()
    {
        $bancos = $this->bancoService->listarBancos();
        return response()->json($bancos);
    }
}
