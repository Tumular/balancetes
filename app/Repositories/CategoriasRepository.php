<?php

namespace App\Repositories;

use App\Models\Categorias;
use Exception;

class CategoriasRepository
{
    public function listar()
    {
        return Categorias::all();
    }

    public function cadastrar(array $dados)
    {
        return Categorias::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $categoria = Categorias::findOrFail($id);

            if (!$categoria) {
                throw new Exception('Categoria não encontrada.');
            }

            $categoria->update($dados);
            return $categoria;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function remover($id)
    {
        try {
            $categoria = Categorias::findOrFail($id);

            if (!$categoria) {
                throw new Exception('Categoria não encontrada.');
            }

            $categoria->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
