<?php namespace App\Repositorios\Usuario;

use App\Repositorios\Repositorio;
use App\Repositorios\Usuario\UsuarioRepositorioInterface;
use App\Models\User as Usuario;

/**
 * Repositorio do Usuário
 *
 * @author Mauricio Luiz Geraldo Junior <mauricio.junior@nexcore.com.br>
 */
class UsuarioRepositorio extends Repositorio implements UsuarioRepositorioInterface{

    /**
     * Lidar com a instancia do Repositorio do Usuario recebendo seu model
     *
     * @param User $user
     */
    public function __construct(Usuario $user)
    {
        parent::__construct($user);
    }

    /**
     * Busca usuario por id
     *
     * @param int $id
     * @return User
     */
    public function buscaUsuarioPorId(int $id) : Usuario
    {
        return $this->model->find($id);
    }

}
