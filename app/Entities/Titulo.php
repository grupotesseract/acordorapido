<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'estado',
    ];

  	/**
     * Pega o cliente desse pagamento
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }	

  	/**
     * Pega a empresa que gerou o pagamento
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'empresa_id');
    }	
    
    /**
     * Executa as funções quando o Titulo passa pro verde
     */
    public function ficaVerde($obj)
    {
        $titulo = Titulo::find($obj->id);
        $titulo->estado = "verde";
        $titulo->save();

        $user = $titulo->cliente->user;
        // Envia o SMS
        // @todo

    }
}
