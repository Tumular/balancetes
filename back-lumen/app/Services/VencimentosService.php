<?php

namespace App\Services;

use App\Repositories\VencimentosRepository;
use Illuminate\Database\Eloquent\Collection;

use Exception;

class VencimentosService
{
    protected $vencimentosRepository;

    public function __construct(VencimentosRepository $vencimentosRepository)
    {
        $this->vencimentosRepository = $vencimentosRepository;
    }

    public function listar(): Collection|array
    {
        try {
            return $this->vencimentosRepository->listar();
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
            $resultado = $this->vencimentosRepository->cadastrar($dados);

            return [
                'mensagem' => 'Registro efetuado com sucesso.',
                'sucesso' => true,
                'vencimento' => $resultado,
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
            $this->vencimentosRepository->editar($id, $dados);
            return ['mensagem' => 'Registro editado com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($id)
    {
        try {
            $this->vencimentosRepository->remover($id);
            return ['mensagem' => 'Registro removido com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
