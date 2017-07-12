<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ModeloAviso extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [];

    protected $table = 'modeloavisos';

    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }

}
