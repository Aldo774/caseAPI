<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Despesa;

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
        $despesa = new Despesa();
        $despesa->fill($request->all());
        $despesa->save();

        return response()->json($despesa, 201);
    }

    public function update(Request $request, $id)
    {
        $despesa = Despesa::find($id);

        if(!$despesa) {
            return response()->json([
                'message'   => 'Despesa não encontrada',
            ], 404);
        }

        $despesa->fill($request->all());
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
