<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ProdutoServico;

class ProdServController extends Controller
{
    public function __construct() {
        $this->middleware('jwt.auth', ['except' => ['index', 'show', 'store', 'update']]);
    }

    public function index()
    {
        $prodservs = ProdutoServico::all();
        return response()->json($prodservs);
    }

    public function show($id)
    {
        $prodserv = ProdutoServico::find($id);

        if(!$prodserv) {
            return response()->json([
                'message'   => 'Produto/Serviço não encontrado',
            ], 404);
        }

        return response()->json($prodserv);
    }

    public function store(Request $request)
    {
        $prodserv = new ProdutoServico();
        $prodserv->fill($request->all());
        $prodserv->save();

        return response()->json($prodserv, 201);
    }

    public function update(Request $request, $id)
    {
        $prodserv = ProdutoServico::find($id);

        if(!$prodserv) {
            return response()->json([
                'message'   => 'Produto/Serviço não encontrado',
            ], 404);
        }

        $prodserv->fill($request->all());
        $prodserv->save();

        return response()->json($prodserv);
    }

    public function destroy($id)
    {
        $prodserv = ProdutoServico::find($id);

        if(!$prodserv) {
            return response()->json([
                'message'   => 'Produto/Serviço não encontrado',
            ], 404);
        }

        $prodserv->delete();
    }

    public function edit($id)
    {
        //
    }
}
