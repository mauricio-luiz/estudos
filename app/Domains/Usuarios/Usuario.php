<?php namespace App\Domain\Usuarios;

use App\Domain\Usuarios\UsuarioAdpterInterface;
use App\Domain\Usuarios\Usuarios;
use App\Repositories\User\UserRepository as UsuarioRepository;
use Illuminate\Support\Collection;
use App\Models\User;

class Usuario implements UsuarioAdpterInterface{

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
     * @var UsuarioRepository;
     */
    private $usuarioRepository;

    /**
     * Lidar com a instancia da classe
     * @since 1.0.0
     */
    public function __construct(User $user){
        $this->usuarioRepository = new UsuarioRepository($user);
    }

    public function repositorio()
    {
        return $this->usuarioRepository;
    }

    /**
     *
     * @return  string
     */
    public function getNome() : string
    {
        return $this->nome;
    }

    /**
     *
     * @param  string  $name  Lidar com o nome
     * @return self
     */
    public function setNome(string $nome) : Usuario
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     *
     * @return  string
     */
    public function getEmail() : string
    {
        return $this->email;
    }

    /**
     *
     * @param  string  $email  Lidar com email
     * @return  self
     */
    public function setEmail(string $email) : Usuario
    {
        $this->email = $email;
        return $this;
    }

    /**
     *
     * @return  string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     *
     * @param  string  $password  Lidar com password
     * @return  self
     */
    public function setPassword(string $password) : Usuario
    {
        $this->password = $password;
        return $this;
    }

    /**
     *
     * @return  integer
     */
    public function getRamal() : string
    {
        return $this->ramal;
    }

    /**
     *
     * @param  integer  $ramal  Lidar com o ramal
     * @return  self
     */
    public function setRamal(string $ramal) : Usuario
    {
        $this->ramal = $ramal;
        return $this;
    }

    /**
     *
     * @return  boolean
     */
    public function getStatus() : bool
    {
        return $this->status;
    }

    /**
     *
     * @param  boolean  $status  Lidar com o status
     * @return self
     */
    public function setStatus(bool $status) : Usuario
    {
        $this->status = $status;
        return $this;
    }

    /**
     *
     * Converte atributos da classe em json
     *
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
     *
     * @return void
     */
    public function fromJson($json) : Usuario
    {
        $usuario = new Usuario(new User());
        $json = json_decode($json, true);

        $usuario->setNome($json['nome'])
                ->setEmail($json['email'])
                ->setPassword($json['password'])
                ->setRamal($json['ramal'])
                ->setStatus($json['status']);

        return $usuario;
    }
}
