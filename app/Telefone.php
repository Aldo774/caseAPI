<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = ['numero', 'id_cliente'];

    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
