<?php

namespace Tests;

use App\Repositories\CategoriasRepository;
use App\Services\CategoriasService;
use App\Models\Categorias;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class CategoriasServiceTest extends TestCase
{
    public function testListar()
    {
        $Repository = $this->createMock(CategoriasRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        $Service = new CategoriasService($Repository);
        $result = $Service->listar();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRemover()
    {
        $ItensIds = [1,25,358];

        // for ($i = 0; $i < 10; $i++) {
        //     $ItensIds[] = rand(1, 1000);
        // }

        $repository = $this->createMock(CategoriasRepository::class);
        $repository->method('remover')->willReturn(['sucesso' => true]);

        $service = new CategoriasService($repository);

        foreach ($ItensIds as $Id) {
            $result = $service->remover($Id);
            $this->assertTrue($result['sucesso']);
        }
    }

    public function testCadastrarBanco()
    {
        $dadosBanco = [
            'usuario_id' => 2,
            'nome' => 'Editado',
            'cor' => '#f0000',
        ];

        $repository = $this->createMock(CategoriasRepository::class);
        $repository->method('cadastrar')->willReturn(new Categorias());

        $service = new CategoriasService($repository);
        $result = $service->cadastrar($dadosBanco);

        $this->assertTrue($result['sucesso']);
    }

    public function testCadastrar()
    {
        $dadosBanco = [
            'usuario_id' => 2,
            'nome' => 'Editado',
            'cor' => '#f0000',
        ];

        $repository = new CategoriasRepository();

        $repositoryMock = $this->getMockBuilder(CategoriasRepository::class)
            ->onlyMethods(['cadastrar'])
            ->getMock();

        $repositoryMock->method('cadastrar')->willReturn($repository->cadastrar($dadosBanco));

        $service = new CategoriasService($repositoryMock);
        $result = $service->cadastrar($dadosBanco);

        $this->assertTrue($result['sucesso']);
    }

    public function testEditar()
    {
        $dadosEdicao = [
            'usuario_id' => 2,
            'nome' => 'Editado',
            'cor' => '#f0000',
        ];

        $bancoId = 1568;

        $repository = new CategoriasRepository();

        $repositoryMock = $this->getMockBuilder(CategoriasRepository::class)
            ->onlyMethods(['editar'])
            ->getMock();

        $repositoryMock->method('editar')->willReturn(true);

        $service = new CategoriasService($repositoryMock);
        $result = $service->editar($bancoId, $dadosEdicao);

        $this->assertTrue($result['sucesso']);
    }
}
