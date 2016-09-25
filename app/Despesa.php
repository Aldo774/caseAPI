<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    protected $fillable = ['nome', 'valor', 'situacao'];

    protected $dates = ['deleted_at'];
}
