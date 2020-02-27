<?php namespace App\Repositorios\Usuario;

use App\Models\User as Usuario;

interface UsuarioRepositorioInterface{
    public function buscaUsuarioPorId(int $id) : Usuario;
}