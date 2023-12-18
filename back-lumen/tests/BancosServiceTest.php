<?php

namespace Tests;

use App\Repositories\BancosRepository;
use App\Services\BancosService;
use App\Models\Bancos;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class BancosServiceTest extends TestCase
{
    public function testListar()
    {
        $Repository = $this->createMock(BancosRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        $Service = new BancosService($Repository);
        $result = $Service->listar();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRemover()
    {
        $ItensIds = [01,22,8];

        // for ($i = 0; $i < 10; $i++) {
        //     $ItensIds[] = rand(1, 1000);
        // }

        $repository = $this->createMock(BancosRepository::class);
        $repository->method('remover')->willReturn(['sucesso' => true]);

        $service = new BancosService($repository);

        foreach ($ItensIds as $Id) {
            $result = $service->remover($Id);
            $this->assertTrue($result['sucesso']);
        }
    }

    public function testCadastrarBanco()
    {
        $dadosBanco = [
            'usuario_id' => 1,
            'nome' => 'Novo Banco',
            'saldo' => 1000.00,
        ];

        $repository = $this->createMock(BancosRepository::class);
        $repository->method('cadastrar')->willReturn(new Bancos());

        $service = new BancosService($repository);
        $result = $service->cadastrar($dadosBanco);

        $this->assertTrue($result['sucesso']);
    }

    public function testCadastrar()
    {
        $dadosBanco = [
            'usuario_id' => 1,
            'nome' => 'Novo Banco',
            'saldo' => 1000.00,
        ];

        $repository = new BancosRepository();

        $repositoryMock = $this->getMockBuilder(BancosRepository::class)
            ->onlyMethods(['cadastrar'])
            ->getMock();

        $repositoryMock->method('cadastrar')->willReturn($repository->cadastrar($dadosBanco));

        $service = new BancosService($repositoryMock);
        $result = $service->cadastrar($dadosBanco);

        $this->assertTrue($result['sucesso']);
    }

    public function testEditar()
    {
        $dadosEdicao = [
            'usuario_id' => 8,
            'nome' => 'Banco Editado',
            'saldo' => 1500.00,
        ];

        $bancoId = 1568;

        $repository = new BancosRepository();

        $repositoryMock = $this->getMockBuilder(BancosRepository::class)
            ->onlyMethods(['editar'])
            ->getMock();

        $repositoryMock->method('editar')->willReturn(true);

        $service = new BancosService($repositoryMock);
        $result = $service->editar($bancoId, $dadosEdicao);

        $this->assertTrue($result['sucesso']);
    }
}
