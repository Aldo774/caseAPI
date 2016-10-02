<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Telefone;
use Validator;

class TelefonesController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store', 'update']]);
    }

    public function index()
    {
        $telefones = Telefone::all();
        return response()->json($telefones);
    }

    public function show($id)
    {
        $telefone = Telefone::find($id);

        if(!$telefone) {
            return response()->json([
                'message'   => 'Telefone não encontrado',
            ], 404);
        }

        return response()->json($telefone);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'numero' => 'required|max:20',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $telefone = new Telefone();
        $telefone->fill($data);
        $telefone->save();

        return response()->json($telefone, 201);
    }

    public function update(Request $request, $id)
    {

        $telefone = Telefone::find($id);

        if(!$telefone) {
            return response()->json([
                'message'   => 'Telefone não encontrado',
            ], 404);
        }

        $data = $request->all();

        $validator = Validator::make($data, [
            'numero' => 'required|max:20',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $telefone->fill($data);
        $telefone->save();

        return response()->json($telefone);
    }

    public function destroy($id)
    {
        $telefone = Telefone::find($id);

        if(!$telefone) {
            return response()->json([
                'message'   => 'Telefone não encontrado',
            ], 404);
        }

        $telefone->delete();
    }

    public function edit($id)
    {
        //
    }

}
