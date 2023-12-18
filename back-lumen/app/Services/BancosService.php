<?php

namespace App\Services;

use App\Repositories\BancosRepository;
use Illuminate\Database\Eloquent\Collection;

use Exception;

class BancosService
{
    private $bancosRepository;

    public function __construct(BancosRepository $bancosRepository)
    {
        $this->bancosRepository = $bancosRepository;
    }

    public function listar(): Collection|array
    {
        try {
            return $this->bancosRepository->listar();
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
            $resultado = $this->bancosRepository->cadastrar($dados);

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
            $this->bancosRepository->editar($id, $dados);
            return ['mensagem' => 'Registro editado com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($id)
    {
        try {
            $this->bancosRepository->remover($id);
            return ['mensagem' => 'Registro removida com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
