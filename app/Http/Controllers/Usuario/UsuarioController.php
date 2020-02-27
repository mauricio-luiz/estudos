<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domain\Usuarios\UsuarioAdpterInterface;
use App\Domain\Usuarios\Usuarios;
use App\Http\Requests\StoreUsuario;
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

    public function __construct(UsuarioAdpterInterface $usuario)
    {
        $this->usuario = $usuario;
        $this->usuarios = new Usuarios(new User());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = $this->usuarios
                         ->paginar(15)
                         ->lista()
                         ->toArray();

        return response()->json([
            'status' => true,
            'mensagem' => "Usuarios encontrados",
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create', ['user' => 'hello word']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsuario $request)
    {
        try{
            $request->persitir();
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('usuario.create', ['user' => 'hello word']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("here");
    }
}
