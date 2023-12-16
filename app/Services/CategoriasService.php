<?php

namespace App\Services;

use App\Repositories\CategoriasRepository;
use Exception;

class CategoriasService
{
    protected $categoriasRepository;

    public function __construct(CategoriasRepository $categoriasRepository)
    {
        $this->categoriasRepository = $categoriasRepository;
    }

    public function listar()
    {
        return $this->categoriasRepository->listar();
    }

    public function cadastrar($dados)
    {
        try {
            $this->categoriasRepository->cadastrar($dados);
            return ['mensagem' => 'Categoria cadastrada com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao cadastrar categoria: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function editar($id, $dados)
    {
        try {
            $this->categoriasRepository->editar($id, $dados);
            return ['mensagem' => 'Categoria atualizada com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar categoria: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($id)
    {
        try {
            $this->categoriasRepository->remover($id);
            return ['mensagem' => 'Categoria removida com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover categoria: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
