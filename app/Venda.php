<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{

    protected $fillable = ['cliente_id', 'proserv_id', 'situacao', 'valorvenda', 'valorcusto'];

    protected $dates = ['deleted_at'];

    protected $hidden = ['cliente_id'];

    function cliente() {
        return $this->belongsTo('App\Cliente')->select(['id','nome']);
    }

    function prodserv() {
        return $this->belongsTo('App\ProdutoServico');
    }
}
