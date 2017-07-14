<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'texto',
        'tituloaviso',
        'user_id',
        'cliente_id',
        'status',
        'titulo_id',
        'estado',
    ];

    /**
     * Pega o usuário do aviso.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Pega o cliente do aviso.
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * Pertence a um titulo.
     */
    public function titulo()
    {
        return $this->belongsTo('App\Titulo');
    }

    public function avisosenviados()
    {
        return $this->hasMany('App\Entities\AvisoEnviado', 'aviso_id', 'id');
    }
}
