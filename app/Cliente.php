<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome'];

    protected $dates = ['deleted_at'];

    public function tel()
    {
        return $this->hasMany('App\Telefone', 'cliente_id')->select(['cliente_id','numero']);
    }

    public function vendas()
    {
    	return $this->hasMany('App\Venda', 'cliente_id')->select(['cliente_id','situacao', 'valorvenda']);
    }
}
