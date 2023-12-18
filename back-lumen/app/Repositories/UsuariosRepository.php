<?php

namespace App\Repositories;

use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class UsuariosRepository
{
    public function listar(): Collection
    {
        return Usuarios::orderBy('id', 'desc')->get();
    }

    public function cadastrar(array $dados): Usuarios
    {
        return Usuarios::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $item = Usuarios::findOrFail($id);

            if (!$item) {
                throw new Exception('Registro não encontrada.');
            }

            $item->update($dados);
            return $item;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function remover($id)
    {
        try {
            $item = Usuarios::findOrFail($id);

            if (!$item) {
                throw new Exception('Registro não encontrado.');
            }

            $item->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function usuarioExiste($usuario)
    {
        return Usuarios::where('usuario', $usuario)->exists();
    }
}
