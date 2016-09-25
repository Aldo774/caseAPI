<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nome', 'nivel', 'email', 'hash'];

    protected $hidden = ['senha'];

    protected $dates = ['deleted_at'];
}
