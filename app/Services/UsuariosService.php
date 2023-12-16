<?php

namespace App\Services;

use App\Repositories\UsuariosRepository;
use Illuminate\Support\Facades\Hash;
use Exception;

class UsuariosService
{
    private $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    public function listar()
    {
        return $this->usuariosRepository->listar();
    }

    public function cadastrar($dados)
    {
        try {
            $usuarioExistente = $this->usuariosRepository->usuarioExiste($dados['usuario']);

            if ($usuarioExistente) {
                return ['mensagem' => 'Usuário já cadastrado. Escolha outro nome de usuário', 'sucesso' => false];
            }

            $dados['senha'] = Hash::make($dados['senha']);
            $this->usuariosRepository->cadastrar($dados);

            return ['mensagem' => 'Usuário cadastrado com sucesso.', 'sucesso' => true];
        } catch (\Throwable $th) {
            return ['mensagem' => 'Erro ao cadastrar usuário: ' . $e->getMessage(), 'sucesso' => false];
        }

    }

    public function editar($id, $dados)
    {
        try {
            $this->usuariosRepository->editar($id, $dados);
            return ['mensagem' => 'Usuário editado com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao editar Usuário: ' . $e->getMessage(), 'sucesso' => false];
        }
    }

    public function remover($usuarioId)
    {
        try {
            $this->usuariosRepository->remover($usuarioId);
            return ['mensagem' => 'Usuário removido com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover usuário: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
