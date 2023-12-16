<?php

use App\Http\Controllers\BancosController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CategoriasController;


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
