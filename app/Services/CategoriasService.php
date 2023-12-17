<?php

namespace App\Services;

use App\Repositories\CategoriasRepository;
use Illuminate\Database\Eloquent\Collection;

use Exception;

class CategoriasService
{
    protected $categoriasRepository;

    public function __construct(CategoriasRepository $categoriasRepository)
    {
        $this->categoriasRepository = $categoriasRepository;
    }

    public function listar(): Collection|array
    {
        try {
            return $this->categoriasRepository->listar();
        } catch (\Exception $e) {
            return [
                'mensagem' => 'Erro ao obter dados: ' . $e->getMessage(),
                'detalhes' => [
                    'tipo' => get_class($e),
                    'linha' => $e->getLine(),
                ],
                'sucesso' => false,
            ];
        }
    }

    public function cadastrar(array $dados): array
    {
        try {
            $resultado = $this->categoriasRepository->cadastrar($dados);

            return [
                'mensagem' => 'Registro efetuado com sucesso.',
                'sucesso' => true,
                'categoria' => $resultado,
            ];
        } catch (Exception $e) {
            return [
                'mensagem' => 'Erro ao efetuar cadastro: ' . $e->getMessage(),
                'detalhes' => [
                    'tipo' => get_class($e),
                    'linha' => $e->getLine(),
                ],
                'sucesso' => false,
            ];
        }
    }

    public function editar($id, $dados)
    {
        try {
            $this->categoriasRepository->editar($id, $dados);
            return ['mensagem' => 'Registro editado com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($id)
    {
        try {
            $this->categoriasRepository->remover($id);
            return ['mensagem' => 'Registro removido com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
