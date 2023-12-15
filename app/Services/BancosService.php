<?php

namespace App\Services;

use App\Repositories\BancosRepository;

class BancosService
{
    private $bancosRepository;

    public function __construct(BancosRepository $bancosRepository)
    {
        $this->bancosRepository = $bancosRepository;
    }

    public function listarBancos()
    {
        return $this->bancosRepository->listarBancos();
    }
}
