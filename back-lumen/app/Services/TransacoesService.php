<?php

namespace App\Services;

use App\Repositories\TransacoesRepository;
use Illuminate\Database\Eloquent\Collection;

use Exception;

class TransacoesService
{
    protected $transacoesRepository;

    public function __construct(TransacoesRepository $transacoesRepository)
    {
        $this->transacoesRepository = $transacoesRepository;
    }

    public function listar(): Collection|array
    {
        try {
            return $this->transacoesRepository->listar();
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
            $resultado = $this->transacoesRepository->cadastrar($dados);

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

    public function remover($id)
    {
        try {
            $this->transacoesRepository->remover($id);
            return ['mensagem' => 'Registro removido com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
