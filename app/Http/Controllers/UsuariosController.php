<?php

namespace App\Http\Controllers;

use App\Services\UsuariosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;


class UsuariosController extends Controller
{
    private $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    public function listar(): JsonResponse
    {
        $resultado = $this->usuariosService->listar();
        return response()->json($resultado);
    }

    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'usuario' => 'required|string|max:255',
                'senha' => 'required|string|max:255',
                'nome' => 'nullable|string|max:255',
                'email' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();

            $resultado = $this->usuariosService->cadastrar($dados);
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
                'usuario' => 'required|string|max:255',
                'senha' => 'required|string|max:255',
                'nome' => 'nullable|string|max:255',
                'email' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();

            $resultado = $this->usuariosService->editar($id, $dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function remover($id)
    {
        $resultado = $this->usuariosService->remover($id);
        return response()->json($resultado);
    }
}
