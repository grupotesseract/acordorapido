<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'nome',
        'cidade',
        'estado',
        'user_id'
    ];

    /**
     * Pega o usuário da empresa.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Pega os titulos desse usuario.
     */
    public function titulos()
    {
        return $this->hasMany('App\Titulo');
    }

    /**
     * Pega os clientes dessa empresa.
     */
    public function clientes()
    {
        return $this->hasMany('App\Cliente');
    }

    public function modeloavisos()
    {
        return $this->hasMany('App\ModeloAviso');
    }

    public function importacoes()
    {
        return $this->hasMany('App\Importacao');
    }
}
