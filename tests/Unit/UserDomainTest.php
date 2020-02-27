<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

use App\Domain\Usuarios\Usuario;
use App\Domain\Usuarios\Usuarios;
use App\Models\User;
use Illuminate\Support\Collection;

class UserDomainTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste de integridade do nome do Usuario
     *
     * @author Mauricio Junior <mauricio.junior@nexcore.com.br>
     * @return void
     */
    public function testAtributoNome()
    {
        $usuario = new Usuario(new User());
        $usuario->setNome('Mauricio Junior');
        $this->assertEquals('Mauricio Junior', $usuario->getNome());
    }

    /**
     * Teste de integridade do Email do Usuario
     *
     * @author Mauricio Junior <mauricio.junior@nexcore.com.br>
     * @return void
     */
    public function testAtributoEmail()
    {
        $usuario = new Usuario(new User());
        $usuario->setEmail('mauricio.junior@nexcore.com');
        $this->assertEquals('mauricio.junior@nexcore.com', $usuario->getEmail());
    }

    /**
     * Teste de integridade do Password do Usuario
     *
     * @author Mauricio Junior <mauricio.junior@nexcore.com.br>
     * @return void
     */
    public function testAtributoPassword()
    {
        $usuario = new Usuario(new User());
        $usuario->setPassword('123456');
        $this->assertEquals('123456', $usuario->getPassword());
    }

    /**
     * Teste de integridade do Ramal do Usuario
     *
     * @return void
     */
    public function testAtributoRamal()
    {
        $usuario = new Usuario(new User());
        $usuario->setRamal('1234');
        $this->assertEquals('1234', $usuario->getRamal());
    }

    /**
     * Teste de integridade do Status do Usuario
     *
     * @return void
     */
    public function testAtributoStatus(){
        $usuario = new Usuario(new User());
        $usuario->setStatus(true);
        $this->assertTrue($usuario->getStatus());
    }

    public function testToJson(){
        $usuario = new Usuario(new User());
        $usuario->setNome('Mauricio Junior');
        $usuario->setEmail('mauricio.junior@nexcore.com');
        $usuario->setPassword('123456');
        $usuario->setRamal('1234');
        $usuario->setStatus(true);

        $json = json_encode([
            'nome' => 'Mauricio Junior',
            'email' => 'mauricio.junior@nexcore.com',
            'password' => '123456',
            'ramal' => '1234',
            'status' => true
        ]);
        $this->assertEquals($json, $usuario->toJson());
    }

    public function testFromJson(){
        $usuario = new Usuario(new User());
        $nome = 'Mauricio Junior';
        $email = 'mauricio.junior@nexcore.com';
        $password = '123456';
        $ramal = '1234';
        $status = true;

        $json = json_encode([
            'nome' => $nome,
            'email' => $email,
            'password' => $password,
            'ramal' => $ramal,
            'status' => $status
        ]);
        $novoUsuario = $usuario->fromJson($json);

        $this->assertEquals($nome, $novoUsuario->getNome());
        $this->assertEquals($email, $novoUsuario->getEmail());
        $this->assertEquals($password, $novoUsuario->getPassword());
        $this->assertEquals($ramal, $novoUsuario->getRamal());
        $this->assertEquals($status, $novoUsuario->getStatus());
    }

    public function testLista(){
        $usuariosMockery = factory(User::class, 20)->create();
        $usuarios = new Usuarios(new User());
        $usuarios->paginar(15);

        $this->assertInstanceOf(Collection::class, $usuarios->lista());
    }


}
