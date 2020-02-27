<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Dominios\Usuarios\UsuarioAdaptadorInterface;
use App\Models\User;

class UsuarioFormRequest extends FormRequest
{
    /**
     * Lidar com as regras do usuario
     *
     * @var array
     */
    private $rules;

    /**
     * Lidar com o dominio do usuario
     *
     * @var UsuarioAdaptadorInterface
     */
    private $usuario;

    public function __construct(UsuarioAdaptadorInterface $usuario)
    {
        $this->rules = [
            'nome' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'ramal' => 'required|numeric',
            'status' => 'boolean'
        ];

        $this->usuario = $usuario;
    }

    /**
     * Determina se o usuario esta autorizado a fazer essa requisao
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Retorna regras de validação para serem aplicadas na requisao
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * Persistir dados de Usuario
     *
     * @return UsuarioAdaptadorInterface
     */
    public function persitiRequesicao() : UsuarioAdaptadorInterface
    {
        $this->usuario->setNome(head($this->only(["nome"])))
                      ->setEmail(head($this->only(["email"])))
                      ->setPassword(head($this->only(["password"])))
                      ->setRamal(head($this->only(["ramal"])))
                      ->setStatus(head($this->only(["status"])));

        $this->usuario->repositorio()->create([
            "nome"     => $this->usuario->getNome(),
            "email"    => $this->usuario->getEmail(),
            "password" => $this->usuario->getPassword(),
            "ramal"    => $this->usuario->getRamal(),
            "status"   => $this->usuario->getStatus()
        ]);

        return $this->usuario;
    }

    public function atualizaRequisicaoPorId(int $id) : UsuarioAdaptadorInterface
    {
        $this->usuario->setNome(head($this->only(["nome"])))
                      ->setEmail(head($this->only(["email"])))
                      ->setPassword(head($this->only(["password"])))
                      ->setRamal(head($this->only(["ramal"])))
                      ->setStatus(head($this->only(["status"])));

        $this->usuario->repositorio()->update($this->usuario->paraArray(), $id);

        return $this->usuario;
    }
}
