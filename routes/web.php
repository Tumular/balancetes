<?php

use App\Http\Controllers\BancosController;
use App\Http\Controllers\UsuariosController;

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

//$router->get('/bancos', [BancosController::class, 'listarBancos']);
$router->get('/bancos', 'BancosController@listarBancos');
$router->get('/usuarios', 'UsuariosController@listarUsuarios');
$router->post('/usuarios/cadastrar','UsuariosController@cadastrar');
$router->delete('/usuarios/remover/{id}','UsuariosController@removerUsuario');

