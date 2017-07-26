<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class AvisoEnviado extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = "avisosenviados";

    protected $fillable = ['user_id', 'aviso_id', 'estado', 'tipodeaviso', 'status','observacaoligacao', 'tempoligacao'];

    public function aviso()
    {
        return $this->belongsTo('App\Aviso');
    }

    /**
     * scope por estado
     */
    public function scopePorEstado($query, $valor)
    {
        return $query->where('estado', $valor);
    }
    
    /**
     * Scope para pegar os de tipodeaviso SMS (0)
     *
     * @param mixed $query
     */
    public function scopeSmss($query)
    {
        return $query->where('tipodeaviso', 0);
    }

    /**
     * Scope para pegar os de tipodeaviso Ligacao telefonica (1)
     *
     * @param mixed $query
     */
    public function scopeLigacoes($query)
    {
        return $query->where('tipodeaviso', 1);
    }
    

}
