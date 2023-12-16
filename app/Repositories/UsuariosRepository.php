<?php

namespace App\Repositories;

use App\Models\Usuarios;
use Exception;

class UsuariosRepository
{
    public function listar()
    {
        return Usuarios::all();
    }

    public function cadastrar($dados)
    {
        return Usuarios::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $usuario = Usuarios::findOrFail($id);

            if (!$usuario) {
                throw new Exception('Usuário não encontrada.');
            }

            $usuario->update($dados);
            return $usuario;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function remover($usuarioId)
    {
        try {
            $usuario = Usuarios::findOrFail($usuarioId);

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
