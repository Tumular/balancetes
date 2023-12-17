<?php

namespace App\Http\Controllers;

use App\Services\VencimentosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class VencimentosController extends Controller
{
    private $vencimentosService;

    public function __construct(VencimentosService $vencimentosService)
    {
        $this->vencimentosService = $vencimentosService;
    }

    public function listar(): JsonResponse
    {
        $resultado = $this->vencimentosService->listar();
        return response()->json($resultado);
    }

    public function cadastrar(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'usuario_id' => 'required|integer',
                'descricao' => 'required|string|max:255',
                'observacao' => 'nullable|string|max:255',
                'valor' => 'required|numeric',
                'data_vencimento' => 'required|date_format:d/m/Y',
                'tipo' => 'required|in:recebimento,pagamento',
                'categoria_id' => 'nullable|integer',
                'fatura_cartao_id' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();
            $dados['data_vencimento'] = Carbon::createFromFormat('d/m/Y', $dados['data_vencimento'])->format('Y-m-d');

            $resultado = $this->vencimentosService->cadastrar($dados);
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
                'descricao' => 'required|string|max:255',
                'observacao' => 'nullable|string|max:255',
                'valor' => 'required|numeric',
                'data_vencimento' => 'required|date_format:d/m/Y',
                'tipo' => 'required|in:recebimento,pagamento',
                'categoria_id' => 'nullable|integer',
                'fatura_cartao_id' => 'nullable|integer',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'mensagem' => 'Erro de validação: ' . $validator->errors()->first(),
                    'sucesso' => false,
                ]);
            }

            $dados = $validator->validated();
            $dados['data_vencimento'] = Carbon::createFromFormat('d/m/Y', $dados['data_vencimento'])->format('Y-m-d');

            $resultado = $this->vencimentosService->editar($id, $dados);
            return response()->json($resultado);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(['mensagem' => 'Erro interno do servidor: ' . $e->getMessage(), 'sucesso' => false], 500);
        }
    }

    public function remover($id)
    {
        $resultado = $this->vencimentosService->remover($id);
        return response()->json($resultado);
    }
}
