<?php

namespace App\Http\Controllers;

use App\Services\BancosService;

class BancosController extends Controller
{
    private $bancoService;

    public function __construct(BancosService $bancosService)
    {
        $this->bancosService = $bancosService;
    }

    public function listarBancos()
    {
        $bancos = $this->bancosService->listarBancos();
        return response()->json($bancos);
    }
}
