<?php

namespace App\Services;

use App\Repositories\UsuariosRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsuariosService
{
    private $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    public function listar(): Collection|array
    {
        try {
            return $this->usuariosRepository->listar();
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
            $usuarioExistente = $this->usuariosRepository->usuarioExiste($dados['usuario']);

            if ($usuarioExistente) {
                return ['mensagem' => 'Usuário já cadastrado. Escolha outro nome de usuário', 'sucesso' => false];
            }

            $dados['senha'] = Hash::make($dados['senha']);
            $resultado = $this->usuariosRepository->cadastrar($dados);

            return [
                'mensagem' => 'Registro efetuado com sucesso.',
                'sucesso' => true,
                'vencimento' => $resultado,
            ];
        } catch (\Throwable $th) {
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
            $this->usuariosRepository->editar($id, $dados);
            return ['mensagem' => 'Registro editado com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($id)
    {
        try {
            $this->usuariosRepository->remover($id);
            return ['mensagem' => 'Registro removido com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover Registro: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
