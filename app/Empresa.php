<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	public $timestamps = true;

    protected $fillable = [
        'nome',
    ];

    /**
     * Pega o usuário da empresa
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Pega os titulos desse usuario
     */
    public function titulos()
    {
        return $this->hasMany('App\Titulo');
    }
}
