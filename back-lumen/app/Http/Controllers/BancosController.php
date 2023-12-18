<?php

namespace App\Http\Controllers;

use App\Services\BancosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;


class BancosController extends Controller
{
    private $bancoService;

    public function __construct(BancosService $bancosService)
    {
        $this->bancosService = $bancosService;
    }

    public function listar(): JsonResponse
    {
        $resultado = $this->bancosService->listar();
        return response()->json($resultado);
    }

    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'usuario_id' => 'required|integer',
                'nome' => 'required|string|max:255',
                'saldo' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();

            $resultado = $this->bancosService->cadastrar($dados);
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
                'saldo' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
                'usuario_id' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();

            $resultado = $this->bancosService->editar($id, $dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function remover($id)
    {
        $resultado = $this->bancosService->remover($id);
        return response()->json($resultado);
    }
}
