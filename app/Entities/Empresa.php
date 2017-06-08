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

    /**
     * Pega os clientes dessa empresa
     */
    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    
    /**
      * Checagem inicial da importação da existência da escola!
      Futuramente, isso inserirá automaticamente uma escola
      */ 

    public function scopeOfNome($query, $nome)
    {
        return $query->where('nome', $nome);
    }
}
}
