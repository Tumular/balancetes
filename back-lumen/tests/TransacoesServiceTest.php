<?php

namespace Tests;

use App\Repositories\TransacoesRepository;
use App\Services\TransacoesService;
use App\Models\Transacoes;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class TransacoesServiceTest extends TestCase
{
    public function testListar()
    {
        $Repository = $this->createMock(TransacoesRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        $Service = new TransacoesService($Repository);
        $result = $Service->listar();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRemover()
    {
        $ItensIds = [0,52,null];

        // for ($i = 0; $i < 10; $i++) {
        //     $ItensIds[] = rand(1, 1000);
        // }

        $repository = $this->createMock(TransacoesRepository::class);
        $repository->method('remover')->willReturn(['sucesso' => true]);

        $service = new TransacoesService($repository);

        foreach ($ItensIds as $Id) {
            $result = $service->remover($Id);
            $this->assertTrue($result['sucesso']);
        }
    }

    public function testCadastrar()
    {
        $dadosMock = [
            'usuario_id' => 1,
            'banco_id' => 1,
            'vencimento_id' => 1,
            'valor' => 1000.00,
            'tipo' => 'entrada',
        ];

        $repository = new TransacoesRepository();

        $repositoryMock = $this->getMockBuilder(TransacoesRepository::class)
            ->onlyMethods(['cadastrar'])
            ->getMock();

        $repositoryMock->method('cadastrar')->willReturn($repository->cadastrar($dadosMock));

        $service = new TransacoesService($repositoryMock);
        $result = $service->cadastrar($dadosMock);

        $this->assertTrue($result['sucesso']);
    }

}
