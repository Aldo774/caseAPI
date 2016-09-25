<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{

    protected $fillable = ['id_cliente', 'id_prodserv', 'situacao'];

    protected $dates = ['deleted_at'];

    function cliente() {
        return $this->belongsTo('App\Cliente');
    }

    function prodserv() {
        return $this->belongsTo('App\ProdutoServico');
    }
}
