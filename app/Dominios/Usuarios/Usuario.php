<?php namespace App\Dominios\Usuarios;

use App\Dominios\Usuarios\UsuarioAdaptadorInterface;
use App\Dominios\Usuarios\Usuarios;
use App\Repositorios\Usuario\UsuarioRepositorio;
use Illuminate\Support\Collection;
use App\Models\User;

class Usuario implements UsuarioAdaptadorInterface{

    /**
     * Lidar com o nome
     * @var string
     */
    private $nome = null;

    /**
     * Lidar com email
     * @var string
     */
    private $email = null;

    /**
     * Lidar com password
     * @var string
     */
    private $password = null;

    /**
     * Lidar com o ramal
     * @var int
     */
    private $ramal = 0;

    /**
     * Lidar com o status
     * @var boolean
     */
    private $status = false;

    /**
     * Lidar com o Repository de Usuario
     *
     * @var UsuarioRepositorio;
     */
    private $usuarioRepositorio;

    /**
     * Lidar com a instancia da classe
     * @since 1.0.0
     */
    public function __construct(User $user){
        $this->usuarioRepositorio = new UsuarioRepositorio($user);
    }

    /**
     * Lida com retorno do repositorio do usuario
     * @return UsuarioRepositorio
     */
    public function repositorio() : UsuarioRepositorio
    {
        return $this->usuarioRepositorio;
    }

    /**
     * Lidar com o retorno do atributo nome
     * @return  string
     */
    public function getNome() : string
    {
        return $this->nome;
    }

    /**
     * Lidar com o inicio do atributo nome
     * @param  string  $name
     * @return self
     */
    public function setNome(string $nome) : Usuario
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Lidar com o retorno do atributo email
     * @return  string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     * Lidar com o inicio do atributo email
     * @param  string  $email
     * @return  self
     */
    public function setEmail(string $email) : Usuario
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Lidar com o retorno do atributo password
     * @return  string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * Lidar com o inicio do atributo password
     * @param  string  $password
     * @return  self
     */
    public function setPassword(string $password) : Usuario
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Lidar com o retorno do atributo ramal
     * @return  integer
     */
    public function getRamal() : string
    {
        return $this->ramal;
    }

    /**
     * Lidar com o inicio do atributo ramal
     * @param  integer  $ramal
     * @return  self
     */
    public function setRamal(string $ramal) : Usuario
    {
        $this->ramal = $ramal;
        return $this;
    }

    /**
     * Lidar com o retorno do atributo status
     * @return  boolean
     */
    public function getStatus() : bool
    {
        return $this->status;
    }

    /**
     * Lidar com o inicio do atributo status
     * @param  boolean  $status
     * @return self
     */
    public function setStatus(bool $status) : Usuario
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Converte atributos da classe em json
     * @return string
     */
    public function toJson() : string
    {
        return json_encode([
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'ramal' => $this->getRamal(),
            'status' => $this->getStatus()
        ]);
    }

    /**
     * Converte um JSON para uma instancia da classe
     * @return void
     */
    public function fromJson($json) : Usuario
    {
        $usuario = new Usuario(new User);
        $json = json_decode($json, true);

        $usuario->setNome($json['nome'])
                ->setEmail($json['email'])
                ->setPassword($json['password'])
                ->setRamal($json['ramal'])
                ->setStatus($json['status']);

        return $usuario;
    }

    /**
     * Converte atributos da classe em array
     * @return array
     */
    public function paraArray() : array
    {
        return [
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'ramal' => $this->getRamal(),
            'status' => $this->getStatus()
        ];
    }

    /**
     * Fabrica usuario atraves do seu id
     *
     * @param integer $id
     * @return Usuario
     */
    public function fabricaUsuarioPor(int $id) : Usuario
    {
        $usuarioModel = $this->repositorio()->buscaUsuarioPor($id);
        $usuario = new Usuario(new User);
        $usuario->setNome($usuarioModel->nome)
                ->setEmail($usuarioModel->email)
                ->setPassword($usuarioModel->password)
                ->setRamal($usuarioModel->ramal)
                ->setStatus($usuarioModel->status);

        return $usuario;
    }
}
