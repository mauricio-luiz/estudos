<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;
use App\Dominios\Usuarios\Usuario;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Lidar com a pagina inicial de usuarios.
     *
     * @return void
     */
    public function testIndex()
    {
        $usuarios = collect([]);
        $usuarioMock = factory(User::class, 5)
                       ->create()
                       ->map(function ($item, $indice) {
                            $usuario = new Usuario(new User());
                            $usuario->setNome($item->nome);
                            $usuario->setEmail($item->email);
                            $usuario->setPassword($item->password);
                            $usuario->setRamal($item->ramal);
                            $usuario->setStatus($item->status);
                            return $usuario->toJson();
                    });
        $usuarios = $usuarios->concat($usuarioMock);

        $response = $this->get('/usuarios');
        $response->assertStatus(200);

        $response->assertExactJson([
            'status'   => true,
            'mensagem' => 'Usuarios encontrados',
            'usuarios' => $usuarios->toArray()
        ]);
    }

    /**
     * Lidar com a pagina de criar usuario.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get('/usuarios/create');
        $response->assertStatus(200);
    }

    /**
     * Lidar com a pagina de editar usuario.
     *
     * @return void
     */
    public function testEdit()
    {
        $response = $this->get('/usuarios/1/edit');
        $response->assertStatus(200);
    }

    /**
     * Lidar com o metodo de salvar usuario.
     *
     * @return void
     */
    public function testPersistirDados()
    {
        $usuarioMock = factory(User::class)->make();

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('POST', '/usuarios',
            [
                'nome'     => $usuarioMock->nome,
                'email'    => $usuarioMock->email,
                'password' => $usuarioMock->password,
                'ramal'    => $usuarioMock->ramal,
                'status'   => $usuarioMock->status
            ]
        );

        $response->assertStatus(201)
                 ->assertJson([
                    'status' => true,
                    'mensagem' => 'Usuario criado com sucesso'
        ]);
    }

    public function testAtualizarDados()
    {
        $usuarioMock = factory(User::class)->create();

        $usuario = [
            'nome' => 'Novo nome',
            'email' => 'email@email.com',
            'password' => '123456',
            'ramal' => '7890',
            'status' => false
        ];

        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->json('PUT', "/usuarios/{$usuarioMock->id}",
            [
                'nome'     => $usuario['nome'],
                'email'    => $usuario['email'],
                'password' => $usuario['password'],
                'ramal'    => $usuario['ramal'],
                'status'   => $usuario['status']
            ]
        );

        $response->assertStatus(200)
                ->assertJson([
                    'status' => true,
                    'mensagem' => 'Usuario atualizado com sucesso',
                    'usuario' => $usuario
                ]);
    }
}
