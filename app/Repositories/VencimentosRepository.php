<?php

namespace App\Repositories;

use App\Models\Vencimentos;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class VencimentosRepository
{
    public function listar(): Collection
    {
        return Vencimentos::orderBy('id', 'desc')->get();
    }

    public function cadastrar(array $dados): Vencimentos
    {
        return Vencimentos::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $item = Vencimentos::findOrFail($id);

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
            $item = Vencimentos::findOrFail($id);

            if (!$item) {
                throw new Exception('Registro não encontrado.');
            }

            $item->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
