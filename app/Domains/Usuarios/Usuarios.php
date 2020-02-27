<?php namespace App\Domain\Usuarios;

use App\Domain\Usuarios\Usuario;
use Illuminate\Support\Collection;
use App\Repositories\User\UserRepository;
use App\Models\User;

/**
 * Classe responsável por criar uma coleção de Usuarios
 *
 * @author Maurício Junior <mauricio.junior@nexcore.com.br>
 */
class Usuarios{

    /**
     * Armazena coleção de usuarios
     *
     * @var Collection
     */
    private $usuarios = null;

    /**
     * Lidar com a instancia de usuarios
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->usuarioRepository = new UserRepository($user);
        $this->usuarios = collect();
    }

    /**
     * Retorna repositorio da classe
     *
     * @return UserRepository
     */
    public function repositorio() : UserRepository
    {
        return $this->usuarioRepository;
    }

    /**
     * Cria uma listagem de usuarios através da coleção de usuario
     *
     * @param Usuario $usuario
     * @return void
     */
    public function paginar(int $take)
    {
        $usuarios = $this->repositorio()
                          ->paginate(15)
                          ->map(function ($item, $indice) {
                                $usuario = new Usuario(new User());
                                $usuario->setNome($item->nome);
                                $usuario->setEmail($item->email);
                                $usuario->setPassword($item->password);
                                $usuario->setRamal($item->ramal);
                                $usuario->setStatus($item->status);
                                return $usuario->toJson();
                            });

        $test = $this->repositorio()->paginate(15);
        echo '<pre>'; print_r($test); exit(0);


        $this->usuarios = $this->usuarios->concat($usuarios);
        return $this;
    }

    /**
     * Retorna usuarios criados por esta instancia
     *
     * @return Collection
     */
    public function lista() : Collection
    {
        return $this->usuarios;
    }
}