<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Venda;

class VendasController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store', 'update']]);
    }

    public function index()
    {
        $vendas = Venda::all();
        return response()->json($vendas);
    }

    public function show($id)
    {
        $venda = Venda::find($id);

        if(!$venda) {
            return response()->json([
                'message'   => 'Venda não encontrada',
            ], 404);
        }

        return response()->json($venda);
    }

    public function store(Request $request)
    {
        $venda = new Venda();
        $venda->fill($request->all());
        $venda->save();

        return response()->json($venda, 201);
    }

    public function update(Request $request, $id)
    {
        $venda = Venda::find($id);

        if(!$venda) {
            return response()->json([
                'message'   => 'Venda não encontrada',
            ], 404);
        }

        $venda->fill($request->all());
        $venda->save();

        return response()->json($venda);
    }

    public function destroy($id)
    {
        $venda = Venda::find($id);

        if(!$venda) {
            return response()->json([
                'message'   => 'Venda não encontrada',
            ], 404);
        }

        $venda->delete();
    }

    public function edit($id)
    {
        //
    }

}
