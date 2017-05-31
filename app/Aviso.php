<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
	public $timestamps = true;

    protected $fillable = [
        'texto',
        'titulo',
    ];
}
