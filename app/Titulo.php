<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{

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
}
