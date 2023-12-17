<?php

namespace Tests;

use App\Repositories\VencimentosRepository;
use App\Services\VencimentosService;
use App\Models\Vencimentos;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class VencimentosServiceTest extends TestCase
{
    public function testListar()
    {
        $Repository = $this->createMock(VencimentosRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        $Service = new VencimentosService($Repository);
        $result = $Service->listar();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRemover()
    {
        $ItensIds = [0,52,null];

        // for ($i = 0; $i < 10; $i++) {
        //     $ItensIds[] = rand(1, 1000);
        // }

        $repository = $this->createMock(VencimentosRepository::class);
        $repository->method('remover')->willReturn(['sucesso' => true]);

        $service = new VencimentosService($repository);

        foreach ($ItensIds as $Id) {
            $result = $service->remover($Id);
            $this->assertTrue($result['sucesso']);
        }
    }

    public function testCadastrarBanco()
    {
        $dadosMock = [
            'usuario_id' => 1,
            'descricao' => 'Novo Vencimento',
            'observacao' => 'Nova Observação',
            'valor' => 1000.00,
            'data_vencimento' => '2025-09-20',
            'tipo' => 'pagamento',
            'categoria_id' => 18,
            'fatura_cartao_id' => null,
        ];

        $repository = $this->createMock(VencimentosRepository::class);
        $repository->method('cadastrar')->willReturn(new Vencimentos());

        $service = new VencimentosService($repository);
        $result = $service->cadastrar($dadosMock);

        $this->assertTrue($result['sucesso']);
    }

    public function testCadastrar()
    {
        $dadosMock = [
            'usuario_id' => 1,
            'descricao' => 'Novo Vencimento',
            'observacao' => 'Nova Observação',
            'valor' => 1000.00,
            'data_vencimento' => '2025-09-20',
            'tipo' => 'pagamento',
            'categoria_id' => 18,
            'fatura_cartao_id' => null,
        ];

        $repository = new VencimentosRepository();

        $repositoryMock = $this->getMockBuilder(VencimentosRepository::class)
            ->onlyMethods(['cadastrar'])
            ->getMock();

        $repositoryMock->method('cadastrar')->willReturn($repository->cadastrar($dadosMock));

        $service = new VencimentosService($repositoryMock);
        $result = $service->cadastrar($dadosMock);

        $this->assertTrue($result['sucesso']);
    }

    public function testEditar()
    {
        $dadosMock = [
            'usuario_id' => 1,
            'descricao' => 'Novo Vencimento',
            'observacao' => 'Nova Observação',
            'valor' => 1000.00,
            'data_vencimento' => '2025-09-20',
            'tipo' => 'pagamento',
            'categoria_id' => 18,
            'fatura_cartao_id' => null,
        ];

        $Id = 13;

        $repository = new VencimentosRepository();

        $repositoryMock = $this->getMockBuilder(VencimentosRepository::class)
            ->onlyMethods(['editar'])
            ->getMock();

        $repositoryMock->method('editar')->willReturn(true);

        $service = new VencimentosService($repositoryMock);
        $result = $service->editar($Id, $dadosMock);

        $this->assertTrue($result['sucesso']);
    }
}
