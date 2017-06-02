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

    /**
     * Pega o usuário do aviso
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
