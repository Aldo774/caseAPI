<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;
use Validator;

class UsuariosController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => []]);
    }

    public function index()
    {
        $usuarios = Usuario::all();

        if(\Auth::user()->nivel != 'Admin') {
            return response()->json([
                'message'   => 'Você não tem permissão para visualizar usuarios',
            ], 401);
        }

        return response()->json($usuarios);
    }

    protected function usuarioValidator($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:100',
            'email' => 'required|email|unique:usuarios'
        ]);

        return $validator;
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json([
                'message'   => 'Usuario não encontrado',
            ], 404);
        }

        if((\Auth::user()->id != $usuario->id) && (\Auth::user()->nivel != 'Admin')) {
            return response()->json([
                'message'   => 'Você não tem permissão para visualizar esse usuário',
            ], 401);
        }

        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
            'email' => 'required|email|unique:usuarios',
            'senha' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $usuario = new Usuario();
        $usuario->fill($data);
        $usuario->hash = Hash::make($usuario->id);
        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);
        $data = $request->all();

        if(!$usuario) {
            return response()->json([
                'message'   => 'Usuario não encontrado',
            ], 404);
        }

        if(array_key_exists('email', $data) && $usuario->email == $data['email']) {
            unset($data['email']);
        }

        $validator = Validator::make($data, [
            'nome' => 'max:100',
            'email' => 'email|unique:usuarios',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        if((\Auth::user()->id != $usuario->id) && (\Auth::user()->nivel != 'Admin')) {
            return response()->json([
                'message'   => 'Você não tem permissão para visualizar esse usuário',
            ], 401);
        }

        $usuario->fill($request->all());
        $usuario->save();

        return response()->json($usuario);
    }

    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json([
                'message'   => 'Usuario não encontrado',
            ], 404);
        }

        if((\Auth::user()->id != $usuario->id) && (\Auth::user()->nivel != 'Admin')) {
            return response()->json([
                'message'   => 'Você não tem permissão para visualizar esse usuário',
            ], 401);
        }

        $usuario->delete();
    }

    public function edit($id)
    {
        //
    }

}
