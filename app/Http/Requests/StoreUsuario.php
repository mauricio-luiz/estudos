<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Usuarios\UsuarioAdpterInterface;
use App\Models\User;

class StoreUsuario extends FormRequest
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
     * @var UsuarioAdpterInterface
     */
    private $usuario;

    public function __construct(UsuarioAdpterInterface $usuario)
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    public function persitir() : UsuarioAdpterInterface
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
}
