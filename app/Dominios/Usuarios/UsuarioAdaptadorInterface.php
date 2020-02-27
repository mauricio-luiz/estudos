<?php namespace App\Dominios\Usuarios;

use App\Dominios\Usuarios\Usuario;

interface UsuarioAdaptadorInterface{

    /**
     * Retorna o Repositorio corrente do dominio
     *
     * @return void
     */
    public function repositorio();

    /**
     * Lida com o instancia da classe convertendo para JSON
     *
     * @return string
     */
    public function toJson() : string;

    /**
     * Lida com o objeto da classe convertendo o JSON para uma instancia da classe
     *
     * @return string
     */
    public function fromJson($json) : Usuario;
}