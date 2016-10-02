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
        $data = $request->all();

        $validator = Validator::make($data, [
            'situacao' => 'required|max:20',
            'valorcusto' => 'required|max:10',
            'valorvenda' => 'required|max:10',
            'cliente_id' => 'required|exists:clientes,id',
            'proserv_id' => 'required|exists:produto_servicos,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $venda = new Venda();
        $venda->fill($data);
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

        $data = $request->all();

        $validator = Validator::make($data, [
            'situacao' => 'required|max:20',
            'valorcusto' => 'required|max:10',
            'valorvenda' => 'required|max:10',
            'cliente_id' => 'required|exists:clientes,id',
            'proserv_id' => 'required|exists:produto_servicos,id'
        ]);

        if($validator->fails()) {
            return response()->json([
                'message'   => 'Falha ao Validar',
                'errors'    => $validator->errors()->all()
            ], 422);
        }

        $venda->fill($data);
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
