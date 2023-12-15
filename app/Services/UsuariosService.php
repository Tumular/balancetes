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

    public function listarUsuarios()
    {
        return $this->usuariosRepository->listarUsuarios();
    }

    public function cadastrarUsuario($dados)
    {
        try {
            $usuarioExistente = $this->usuariosRepository->usuarioExiste($dados['usuario']);

            if ($usuarioExistente) {
                return 'Usuário já cadastrado. Escolha outro nome de usuário.';
            }

            $dados['senha'] = Hash::make($dados['senha']);
            $this->usuariosRepository->criarUsuario($dados);

            return 'Usuário cadastrado com sucesso!';
        } catch (\Throwable $th) {
            return 'Erro ao cadastrar usuário:' . $e->getMessage();
        }

    }

    public function removerUsuario($usuarioId)
    {
        try {
            $this->usuariosRepository->removerUsuario($usuarioId);

            return ['mensagem' => 'Usuário removido com sucesso.', 'sucesso' => true];
        } catch (Exception $e) {
            return ['mensagem' => 'Erro ao remover usuário: ' . $e->getMessage(), 'sucesso' => false];
        }
    }
}
