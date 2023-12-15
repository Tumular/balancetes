<?php

namespace App\Repositories;

use App\Models\Usuarios;
use Exception;

class UsuariosRepository
{
    public function listarUsuarios()
    {
        return Usuarios::all();
    }

    public function criarUsuario($dados)
    {
        return Usuarios::create($dados);
    }

    public function removerUsuario($usuarioId)
    {
        try {
            $usuario = Usuarios::find($usuarioId);

            if (!$usuario) {
                throw new Exception('Usuário não encontrado.');
            }

            $usuario->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function usuarioExiste($usuario)
    {
        return Usuarios::where('usuario', $usuario)->exists();
    }
}
