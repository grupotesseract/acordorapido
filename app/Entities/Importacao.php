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
        return $this->belongsTo('App\Titulo');
    }
}
