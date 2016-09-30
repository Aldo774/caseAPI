<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Despesa;
use Validator;

class DespesasController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store', 'update']]);
    }

    public function index()
    {
        $despesas = Despesa::all();
        return response()->json($despesas);
    }

    public function show($id)
    {
        $despesa = Despesa::find($id);

        if(!$despesa) {
            return response()->json([
                'message'   => 'Despesa não encontrada',
            ], 404);
        }

        return response()->json($despesa);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
            'valor' => 'required|max:60',
            'situacao' => 'required|max:20'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $despesa = new Despesa();
        $despesa->fill($data);
        $despesa->save();

        return response()->json($despesa, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'nome' => 'required|max:100',
            'valor' => 'required|max:60',
            'situacao' => 'required|max:20'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $despesa = Despesa::find($id);

        if(!$despesa) {
            return response()->json([
                'message'   => 'Despesa não encontrada',
            ], 404);
        }

        $despesa->fill($data);
        $despesa->save();

        return response()->json($despesa);
    }

    public function destroy($id)
    {
        $despesa = Despesa::find($id);

        if(!$despesa) {
            return response()->json([
                'message'   => 'Despesa não encontrada',
            ], 404);
        }

        $despesa->delete();
    }

    public function edit($id)
    {
        //
    }
}
