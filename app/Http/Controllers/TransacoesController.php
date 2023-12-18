<?php

namespace App\Http\Controllers;

use App\Services\TransacoesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;


class TransacoesController extends Controller
{
    private $transacoesService;

    public function __construct(TransacoesService $transacoesService)
    {
        $this->transacoesService = $transacoesService;
    }

    public function listar(): JsonResponse
    {
        $resultado = $this->transacoesService->listar();
        return response()->json($resultado);
    }

    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'usuario_id' => 'required|integer',
                'banco_id' => 'required|integer',
                'vencimento_id' => 'required|integer',
                'valor' => 'required|numeric',
                'tipo' => 'required|in:saida,entrada',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();

            $resultado = $this->transacoesService->cadastrar($dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function remover($id)
    {
        $resultado = $this->transacoesService->remover($id);
        return response()->json($resultado);
    }
}
