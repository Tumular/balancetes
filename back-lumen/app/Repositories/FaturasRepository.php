<?php

namespace App\Repositories;

use App\Models\Faturas;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class FaturasRepository
{
    public function listar(): Collection
    {
        return Faturas::orderBy('id', 'desc')->get();
    }

    public function cadastrar(array $dados): Faturas
    {
        return Faturas::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $item = Faturas::findOrFail($id);

            if (!$item) {
                throw new Exception('Registro não encontrado.');
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
            $item = Faturas::findOrFail($id);

            if (!$item) {
                throw new Exception('Registro não encontrado.');
            }

            $item->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
