<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Usuario;

class UsuariosController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => []]);
    }

    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json([
                'message'   => 'Usuario não encontrado',
            ], 404);
        }

        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->fill($request->all());
        $usuario->hash = Hash::make($usuario->id);
        $usuario->save();

        return response()->json($usuario, 201);
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json([
                'message'   => 'Usuario não encontrado',
            ], 404);
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

        $usuario->delete();
    }

    public function edit($id)
    {
        //
    }

}
