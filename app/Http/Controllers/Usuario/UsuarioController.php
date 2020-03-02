<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Dominios\Usuarios\UsuarioAdaptadorInterface;
use App\Dominios\Usuarios\Usuarios;
use App\Http\Requests\UsuarioFormRequest;
use App\Models\User;
use Exception;

class UsuarioController extends Controller
{
    /**
     * Lidar com o dominio de Usuario
     *
     * @var Usuario
     */
    protected $usuario = null;

    public function __construct(UsuarioAdaptadorInterface $usuario)
    {
        $this->usuario = $usuario;
        $this->usuarios = new Usuarios(new User());
    }

    /**
     * Exibi a listagem deste recurso
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = $this->usuarios
                         ->paginaPor(15)
                         ->lista()
                         ->toArray();

        return response()->json([
            'status' => true,
            'mensagem' => "Usuarios encontrados",
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Mostra o formulario para criar um novo recurso
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create', ['user' => 'hello word']);
    }

    /**
     * Armazena um recurso recem-criado no armazenamento.
     *
     * @param App\Http\Requests\UsuarioFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioFormRequest $request)
    {
        try{
            $request->persitiRequesicao();
            return response()
                ->json([
                    'status' => true,
                    'mensagem' => 'Usuario criado com sucesso',
                ], 201);
        }catch(Exception $e){
            return response()
                ->json([
                    'status' => false,
                    'mensagem' => "Erro ao criar usuario {$e->message}",
                ], 400);
        }
    }

    /**
     * Exibe o recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Mostra o formulário para editar o recurso especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('usuario.create', ['user' => 'hello word']);
    }

    /**
     * Atualize o recurso especificado no armazenamento.
     *
     * @param App\Http\Requests\UsuarioFormRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioFormRequest $request, int $id)
    {
        try{
            $usuario = $request->atualizaRequisicaoPorId($id);
            return response()
                ->json([
                    'status' => true,
                    'mensagem' => 'Usuario atualizado com sucesso',
                    'usuario' => $usuario->paraArray()
                ], 200);
        }catch(Exception $e){
            return response()
                ->json([
                    'status' => false,
                    'mensagem' => "Erro ao criar usuario {$e->getMessage()}",
                ], 400);
        }
    }

    /**
     * Remova o recurso especificado do armazenamento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try{
            $usuario = $this->usuario->fabricaUsuarioPor($id);
            $usuario->repositorio()->removeUsuarioPor($id);
            return response()
                ->json([
                    'status' => true,
                    'mensagem' => 'Usuario removido com sucesso',
                    'usuario' => $usuario->paraArray()
                ], 200);
        }catch(Exception $e){
            return response()
                ->json([
                    'status' => false,
                    'mensagem' => "Erro ao remover usuario {$e->getMessage()}",
                ], 400);
        }
    }
}
