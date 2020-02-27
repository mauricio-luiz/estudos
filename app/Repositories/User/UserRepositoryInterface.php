<?php namespace App\Repositories\User;

use App\Models\User as Usuario;

interface UserRepositoryInterface{
    public function buscaUsuarioPorId($id) : Usuario;
}