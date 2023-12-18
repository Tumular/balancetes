<?php

namespace App\Repositories;

use App\Models\Transacoes;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class TransacoesRepository
{
    public function listar(): Collection
    {
        return Transacoes::orderBy('id', 'desc')->get();
    }

    public function cadastrar(array $dados): Transacoes
    {
        return Transacoes::create($dados);
    }

    public function remover($id)
    {
        try {
            $item = Transacoes::findOrFail($id);

            if (!$item) {
                throw new Exception('Registro não encontrado.');
            }

            $item->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
