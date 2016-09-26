<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = ['numero', 'cliente_id'];

    protected $dates = ['deleted_at'];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }
}
