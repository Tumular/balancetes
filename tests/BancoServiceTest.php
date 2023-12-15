<?php

namespace Tests;

use App\Repositories\BancoRepository;
use App\Services\BancoService;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class BancoServiceTest extends TestCase
{
    public function testListarBancosRetornaColecao()
    {
        // Mock do BancoRepository
        $bancoRepository = $this->createMock(BancoRepository::class);
        $bancoRepository->method('listarBancos')->willReturn(new Collection());

        // Instância do BancoService com o mock do repository
        $bancoService = new BancoService($bancoRepository);

        // Chama o método a ser testado
        $result = $bancoService->listarBancos();

        // Assert: Verifica se o resultado é uma instância de Collection
        $this->assertInstanceOf(Collection::class, $result);
    }
}
