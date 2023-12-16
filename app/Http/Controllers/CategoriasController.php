<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Services\CategoriasService;

class CategoriasController extends Controller
{
    protected $categoriasService;

    public function __construct(CategoriasService $categoriasService)
    {
        $this->categoriasService = $categoriasService;
    }

    public function listar()
    {
        $categorias = $this->categoriasService->listar();
        return response()->json($categorias);
    }

    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'cor' => 'required|string|max:7',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $dados = $validator->validated();

            $resultado = $this->categoriasService->cadastrar($dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function editar(Request $request, $id)
    {
        try {

            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'cor' => 'required|string|max:7',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $dados = $validator->validated();

            $resultado = $this->categoriasService->editar($id, $dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function remover($id)
    {
        $resultado = $this->categoriasService->remover($id);
        return response()->json($resultado);
    }
}
