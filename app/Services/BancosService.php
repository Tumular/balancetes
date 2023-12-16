<?php

namespace App\Services;

use App\Repositories\BancosRepository;
use Exception;

class BancosService
{
    private $bancosRepository;

    public function __construct(BancosRepository $bancosRepository)
    {
        $this->bancosRepository = $bancosRepository;
    }

    public function listar()
    {
        return $this->bancosRepository->listar();
    }

    public function cadastrar($dados)
    {
        try {
            $this->bancosRepository->cadastrar($dados);
            return ['mensagem' => 'Banco cadastrado com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao cadastrar banco: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function editar($id, $dados)
    {
        try {
            $this->bancosRepository->editar($id, $dados);
            return ['mensagem' => 'Banco atualizada com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar banco: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($id)
    {
        try {
            $this->bancosRepository->remover($id);
            return ['mensagem' => 'Banco removida com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover banco: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
