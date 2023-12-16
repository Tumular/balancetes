<?php

namespace Tests;

use App\Repositories\CategoriasRepository;
use App\Services\CategoriasService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class CategoriasServiceTest extends TestCase
{
    public function testListarCategoriasRetornaColecao()
    {
        // Mock do CategoriasRepository
        $Repository = $this->createMock(CategoriasRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        // Instância do CategoriasService com o mock do repository
        $Service = new CategoriasService($Repository);

        // Chama o método a ser testado
        $result = $Service->listar();

        // Assert: Verifica se o resultado é uma instância de Collection
        $this->assertInstanceOf(Collection::class, $result);
    }
}
