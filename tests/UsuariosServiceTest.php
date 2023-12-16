<?php

namespace Tests;

use App\Repositories\UsuariosRepository;
use App\Services\UsuariosService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class UsuariosServiceTest extends TestCase
{
    public function testListarUsuariosRetornaColecao()
    {
        // Mock do UsuariosRepository
        $Repository = $this->createMock(UsuariosRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        // Instância do UsuariosService com o mock do repository
        $Service = new UsuariosService($Repository);

        // Chama o método a ser testado
        $result = $Service->listar();

        // Assert: Verifica se o resultado é uma instância de Collection
        $this->assertInstanceOf(Collection::class, $result);
    }
}
