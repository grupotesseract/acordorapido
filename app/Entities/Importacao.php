<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
	public $timestamps = true;

    protected $table = 'importacoes';
    protected $fillable = ['user_id'];

    /**
     * Pega o usuário que realizou a importação
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Pega os titulos da importação
     */
    public function titulos()
    {
        return $this->hasMany('App\Titulo');
    }

    public function titulosCount()
    {
      return $this->hasMany('App\Titulo')
        ->selectRaw('importacao_id, count(*) as aggregate')
        ->groupBy('importacao_id');
    }

    public function getTitulosCountAttribute()
    {
        // if relation is not loaded already, let's do it first
        if ( ! array_key_exists('titulosCount', $this->relations)) 
            $this->load('titulosCount');

        $related = $this->getRelation('titulosCount');

        // then return the count directly
        return ($related) ? (int) $related->aggregate : 0;
    }
}
