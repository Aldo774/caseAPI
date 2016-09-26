<?php

Route::group(array('prefix' => 'api'), function()
{

	Route::get('/', function () {
		return response()->json(['message' => 'caseAPI', 'status' => 'Connected']);;
	});

	Route::resource('clientes', 'ClientesController');
	Route::resource('despesas', 'DespesasController');
	Route::resource('produtoseservicos', 'ProdServController');
	Route::resource('telefones', 'TelefonesController');
	Route::resource('usuarios', 'UsuariosController');
	Route::resource('vendas', 'VendasController');
	Route::post('auth/login', 'AuthController@authenticate');
});

Route::get('/', function () {
	return redirect('api');
});