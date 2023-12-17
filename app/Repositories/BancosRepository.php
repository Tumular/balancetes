<?php

namespace App\Repositories;

use App\Models\Bancos;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class BancosRepository
{
    public function listar(): Collection
    {
        return Bancos::orderBy('id', 'desc')->get();
    }

    public function cadastrar(array $dados): Bancos
    {
        return Bancos::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $item = Bancos::findOrFail($id);

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
            $item = Bancos::findOrFail($id);

            if (!$item) {
                throw new Exception('Banco não encontrado.');
            }

            $item->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
