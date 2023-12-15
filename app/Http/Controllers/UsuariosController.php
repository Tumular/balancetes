<?php

namespace App\Http\Controllers;

use App\Services\UsuariosService;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    private $usuariosService;

    public function __construct(UsuariosService $usuariosService)
    {
        $this->usuariosService = $usuariosService;
    }

    public function cadastrar(Request $request)
    {
        $dados = $request->all();
        $usuario = $this->usuariosService->cadastrarUsuario($dados);

        return response()->json($usuario, 201);
    }

    public function removerUsuario($id)
    {
        $resultado = $this->usuariosService->removerUsuario($id);

        return response()->json($resultado);
    }

    public function listarUsuarios()
    {
        $usuarios = $this->usuariosService->listarUsuarios();

        return response()->json($usuarios);
    }
}
