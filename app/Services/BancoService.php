<?php

namespace App\Services;

use App\Repositories\BancoRepository;

class BancoService
{
    private $bancoRepository;

    public function __construct(BancoRepository $bancoRepository)
    {
        $this->bancoRepository = $bancoRepository;
    }

    public function listarBancos()
    {
        return $this->bancoRepository->listarBancos();
    }
}
