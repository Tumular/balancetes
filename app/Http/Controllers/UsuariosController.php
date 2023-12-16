<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Services\UsuariosService;

class UsuariosController extends Controller
{
    private $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    public function listar()
    {
        $usuarios = $this->usuariosService->listar();
        return response()->json($usuarios);
    }

    public function cadastrar(Request $request)
    {
        $dados = $request->all();
        $usuario = $this->usuariosService->cadastrar($dados);

        return response()->json($usuario, 201);
    }

    public function editar(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required|string|max:255',
                'email' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
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
