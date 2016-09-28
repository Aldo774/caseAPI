<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cliente;
use Validator;

class ClientesController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store', 'update']]);
    }

    public function index()
    {
        $clientes = Cliente::all();
        return response()->json($clientes);
    }

    public function show($id)
    {
        $cliente = Cliente::with('tel', 'vendas')->find($id);

        if(!$cliente) {
            return response()->json([
                'message'   => 'Cliente não encontrado',
            ], 404);
        }

        return response()->json($cliente);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $cliente = new Cliente();
        $cliente->fill($data);
        $cliente->save();

        return response()->json($cliente, 201);
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $cliente = Cliente::find($id);

        if(!$cliente) {
            return response()->json([
                'message'   => 'Cliente não encontrado',
            ], 404);
        }

        $cliente->fill($data);
        $cliente->save();

        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente) {
            return response()->json([
                'message'   => 'Cliente não encontrado',
            ], 404);
        }

        $cliente->delete();
    }

    public function create()
    {
        //
    }

    public function edit($id)
    {
        //
    }

}
