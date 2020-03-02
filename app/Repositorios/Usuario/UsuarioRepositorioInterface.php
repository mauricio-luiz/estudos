<?php namespace App\Repositorios\Usuario;

use App\Models\User as Usuario;

interface UsuarioRepositorioInterface{

    public function buscaUsuarioPor(int $id) : Usuario;

    public function removeUsuarioPor(int $id) : int;
}