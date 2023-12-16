<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Services\BancosService;

class BancosController extends Controller
{
    private $bancoService;

    public function __construct(BancosService $bancosService)
    {
        $this->bancosService = $bancosService;
    }

    public function listar()
    {
        $bancos = $this->bancosService->listar();
        return response()->json($bancos);
    }

    public function cadastrar(Request $request)
    {
        $dados = $request->all();
        $bancos = $this->bancosService->cadastrar($dados);

        return response()->json($bancos, 201);
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
                throw new ValidationException($validator);
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
