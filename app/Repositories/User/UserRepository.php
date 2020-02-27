<?php namespace App\Repositories\User;

use App\Repositories\Repository;
use App\Repositories\User\UserRepositoryInterface;
use App\Models\User;

/**
 * Repositorio do Usuário
 *
 * @author Mauricio Luiz Geraldo Junior <mauricio.junior@nexcore.com.br>
 */
class UserRepository extends Repository implements UserRepositoryInterface{

    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function buscaUsuarioPorId($id) : User
    {
        return $this->model->find($id);
    }

}
