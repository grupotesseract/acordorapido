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
        return $this->belongsTo('App\Cliente');
    }	

  	/**
     * Pega a empresa que gerou o pagamento
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa');
    }	

    public function avisos()
    {
      return $this->hasMany('App\Aviso');
    }
    
    /**
     * Atribui pago para todos os que não foram importados no módulo Verde
     */
    public function ficaPago($obj)
    {
        $titulo = Titulo::find($obj->id);
        $titulo->estado = "verde";
        $titulo->save();

        $user = $titulo->cliente->user;
        // Envia o SMS
        // @todo

    }


        
}
