<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AvisoEnviado extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "avisosenviados";

    protected $fillable = ['user_id', 'aviso_id', 'estado', 'tipodeaviso', 'status'];

    public function aviso()
    {
        return $this->belongsTo('App\Aviso');
    }

}
