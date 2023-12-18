<?php

namespace Tests;

use App\Repositories\FaturasRepository;
use App\Services\FaturasService;
use App\Models\Faturas;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class FaturasServiceTest extends TestCase
{
    public function testListar()
    {
        $Repository = $this->createMock(FaturasRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        $Service = new FaturasService($Repository);
        $result = $Service->listar();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRemover()
    {
        $ItensIds = [0,52,null];

        // for ($i = 0; $i < 10; $i++) {
        //     $ItensIds[] = rand(1, 1000);
        // }

        $repository = $this->createMock(FaturasRepository::class);
        $repository->method('remover')->willReturn(['sucesso' => true]);

        $service = new FaturasService($repository);

        foreach ($ItensIds as $Id) {
            $result = $service->remover($Id);
            $this->assertTrue($result['sucesso']);
        }
    }

    public function testCadastrar()
    {
        $dadosMock = [
            'usuario_id' => 1,
            'descricao' => 'Nova Fatura',
            'valor_total' => 1000.00,
            'data_vencimento' => '2024-09-20',
            'parcelas' => 5,
        ];

        $repository = new FaturasRepository();

        $repositoryMock = $this->getMockBuilder(FaturasRepository::class)
            ->onlyMethods(['cadastrar'])
            ->getMock();

        $repositoryMock->method('cadastrar')->willReturn($repository->cadastrar($dadosMock));

        $service = new FaturasService($repositoryMock);
        $result = $service->cadastrar($dadosMock);

        $this->assertTrue($result['sucesso']);
    }

    public function testEditar()
    {
        $dadosMock = [
            'usuario_id' => 1,
            'descricao' => 'Nova Fatura',
            'valor_total' => 1000.00,
            'data_vencimento' => '2024-09-20',
            'parcelas' => 5,
        ];

        $Id = 13;

        $repository = new FaturasRepository();

        $repositoryMock = $this->getMockBuilder(FaturasRepository::class)
            ->onlyMethods(['editar'])
            ->getMock();

        $repositoryMock->method('editar')->willReturn(true);

        $service = new FaturasService($repositoryMock);
        $result = $service->editar($Id, $dadosMock);

        $this->assertTrue($result['sucesso']);
    }
}
