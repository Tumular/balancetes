<?php

namespace App\Http\Controllers;

use App\Services\FaturasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class FaturasController extends Controller
{
    private $faturasService;

    public function __construct(FaturasService $faturasService)
    {
        $this->faturasService = $faturasService;
    }

    public function listar(): JsonResponse
    {
        $resultado = $this->faturasService->listar();
        return response()->json($resultado);
    }

    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'usuario_id' => 'required|integer',
                'descricao' => 'nullable|string|max:255',
                'valor_total' => 'required|numeric',
                'data_vencimento' => 'required|date_format:d/m/Y',
                'parcelas' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();
            $dados['data_vencimento'] = Carbon::createFromFormat('d/m/Y', $dados['data_vencimento'])->format('Y-m-d');

            $resultado = $this->faturasService->cadastrar($dados);
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
                'usuario_id' => 'required|integer',
                'descricao' => 'nullable|string|max:255',
                'valor_total' => 'required|numeric',
                'data_vencimento' => 'required|date_format:d/m/Y',
                'parcelas' => 'required|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();
            $dados['data_vencimento'] = Carbon::createFromFormat('d/m/Y', $dados['data_vencimento'])->format('Y-m-d');

            $resultado = $this->faturasService->editar($id, $dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function remover($id)
    {
        $resultado = $this->faturasService->remover($id);
        return response()->json($resultado);
    }
}
