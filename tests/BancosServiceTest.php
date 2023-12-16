<?php

namespace Tests;

use App\Repositories\BancosRepository;
use App\Services\BancosService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class BancosServiceTest extends TestCase
{
    public function testListarBancosRetornaColecao()
    {
        // Mock do BancosRepository
        $bancosRepository = $this->createMock(BancosRepository::class);
        $bancosRepository->method('listar')->willReturn(new Collection());

        // Instância do BancoService com o mock do repository
        $bancosService = new BancosService($bancosRepository);

        // Chama o método a ser testado
        $result = $bancosService->listar();

        // Assert: Verifica se o resultado é uma instância de Collection
        $this->assertInstanceOf(Collection::class, $result);
    }
}
