<?php

namespace App\Repositories;

use App\Models\Bancos;
use Exception;

class BancosRepository
{
    public function listar()
    {
        return Bancos::all();
    }

    public function cadastrar(array $dados)
    {
        return Bancos::create($dados);
    }

    public function editar($id, array $dados)
    {
        try {
            $banco = Bancos::findOrFail($id);

            if (!$banco) {
                throw new Exception('Banco não encontrada.');
            }

            $banco->update($dados);
            return $banco;

        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function remover($id)
    {
        try {
            $banco = Bancos::findOrFail($id);

            if (!$banco) {
                throw new Exception('Banco não encontrado.');
            }

            $banco->delete();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
