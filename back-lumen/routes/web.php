<?php

use App\Http\Controllers\BancosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\VencimentosController;


/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// rotas Bancos
$router->get('/bancos', 'BancosController@listar');
$router->post('/bancos','BancosController@cadastrar');
$router->put('/bancos/{id}','BancosController@editar');
$router->delete('/bancos/{id}','BancosController@remover');

// rotas Usuarios
$router->get('/usuarios', 'UsuariosController@listar');
$router->post('/usuarios','UsuariosController@cadastrar');
$router->put('/usuarios/{id}','UsuariosController@editar');
$router->delete('/usuarios/{id}','UsuariosController@remover');

// rotas Categorias
$router->get('/categorias', 'CategoriasController@listar');
$router->post('/categorias', 'CategoriasController@cadastrar');
$router->put('/categorias/{id}', 'CategoriasController@editar');
$router->delete('/categorias/{id}', 'CategoriasController@remover');

//rotas Vencimentos
$router->get('/vencimentos', 'VencimentosController@listar');
$router->post('/vencimentos', 'VencimentosController@cadastrar');
$router->put('/vencimentos/{id}', 'VencimentosController@editar');
$router->delete('/vencimentos/{id}', 'VencimentosController@remover');

//rotas Faturas
$router->get('/faturas', 'FaturasController@listar');
$router->post('/faturas', 'FaturasController@cadastrar');
$router->put('/faturas/{id}', 'FaturasController@editar');
$router->delete('/faturas/{id}', 'FaturasController@remover');

//rotas Transacoes
$router->get('/transacoes', 'TransacoesController@listar');
$router->post('/transacoes', 'TransacoesController@cadastrar');
$router->delete('/transacoes/{id}', 'TransacoesController@remover');
