<?php

namespace App\Repositories;

use App\Models\Categorias;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class CategoriasRepository
{
    public function listar(): Collection
    {
        return Categorias::orderBy('id', 'desc')->get();
    }

    public function cadastrar(array $dados): Categorias
    {
        return Categorias::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $item = Categorias::findOrFail($id);

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
            $item = Categorias::findOrFail($id);

            if (!$item) {
                throw new Exception('Categoria não encontrada.');
            }

            $item->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
