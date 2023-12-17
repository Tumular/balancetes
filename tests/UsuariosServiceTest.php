<?php

namespace Tests;

use App\Repositories\UsuariosRepository;
use App\Services\UsuariosService;
use App\Models\Usuarios;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class UsuariosServiceTest extends TestCase
{
    public function testListar()
    {
        $Repository = $this->createMock(UsuariosRepository::class);
        $Repository->method('listar')->willReturn(new Collection());

        $Service = new UsuariosService($Repository);
        $result = $Service->listar();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRemover()
    {
        $ItensIds = [31,2,38];

        // for ($i = 0; $i < 10; $i++) {
        //     $ItensIds[] = rand(1, 1000);
        // }

        $repository = $this->createMock(UsuariosRepository::class);
        $repository->method('remover')->willReturn(['sucesso' => true]);

        $service = new UsuariosService($repository);

        foreach ($ItensIds as $Id) {
            $result = $service->remover($Id);
            $this->assertTrue($result['sucesso']);
        }
    }

    public function testCadastrar()
    {
        $dadosMock = [
            'usuario' => 'SirTestinho',
            'nome' => 'TesteEdição',
            'email' => 'teste@teste.com',
            'senha' => 'pagamento',
        ];

        $repository = $this->createMock(UsuariosRepository::class);
        $repository->method('cadastrar')->willReturn(new Usuarios());

        $service = new UsuariosService($repository);
        $result = $service->cadastrar($dadosMock);

        $this->assertTrue($result['sucesso']);
    }

    public function testEditar()
    {
        $dadosMock = [
            'usuario' => 'SirTestinho',
            'nome' => 'TesteEdição',
            'email' => 'teste@teste.com',
            'senha' => 'pagamento',
        ];

        $Id = 13;

        $repository = new UsuariosRepository();

        $repositoryMock = $this->getMockBuilder(UsuariosRepository::class)
            ->onlyMethods(['editar'])
            ->getMock();

        $repositoryMock->method('editar')->willReturn(true);

        $service = new UsuariosService($repositoryMock);
        $result = $service->editar($Id, $dadosMock);

        $this->assertTrue($result['sucesso']);
    }
}
