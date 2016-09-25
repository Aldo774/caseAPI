<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ['nome'];

    protected $dates = ['deleted_at'];

    public function tel()
    {
        return $this->hasMany('App\Telefone');
    }

    public function vendas()
    {
    	return $this->belongsTo('App\Venda');
    }
}
