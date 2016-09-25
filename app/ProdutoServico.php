<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoServico extends Model
{
    protected $fillable = ['nome', 'custo', 'tipo'];

    protected $dates = ['deleted_at'];

    function prodserv() {
        return $this->hasMany('App\Venda');
    }
}