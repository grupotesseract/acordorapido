<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'id',
        'estado',
        'empresa_id',
        'pago',
        'vencimento',
        'valor',
        'titulo'
    ];

    /**
     * Pega o cliente desse pagamento.
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * Pega a empresa que gerou o pagamento.
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
     * Atribui pago para todos os que não foram importados no módulo Verde.
     */
    public function ficaPago($obj)
    {
        $titulo = self::find($obj->id);
        $titulo->estado = 'verde';
        $titulo->save();

        $user = $titulo->cliente->user;
        // Envia o SMS
        // @todo
    }

    /**
     * Scopes
     */

    /**
     * scopePagos - Scope para facilitar a query pelos Titulos pagos
     *
     * @param mixed $query
     */
    public function scopePagos($query)
    {
        return $query->where('pago', true);
    }

    /**
     * scopeAzuis Facilitar query dois titulos Azuis
     *
     * @param mixed $query
     */
    public function scopeAzuis($query)
    {
        return $query->where('estado', 'azul');
    }

    /**
     * scopeVerdes Facilitar query dois titulos Verdes
     *
     * @param mixed $query
     */
    public function scopeVerdes($query)
    {
        return $query->where('estado', 'verde');
    }

    /**
     * scopeAmarelos Facilitar query dois titulos Amarelos
     *
     * @param mixed $query
     */
    public function scopeAmarelos($query)
    {
        return $query->where('estado', 'amarelo');
    }

    /**
     * scopeCinzas Facilitar query dois titulos Cinzas
     *
     * @param mixed $query
     */
    public function scopeVermelhos($query)
    {
        return $query->where('estado', 'vermelho');
    }

    /**
     * scopeCinzas Facilitar query dois titulos Cinza
     *
     * @param mixed $query
     */
    public function scopeCinzas($query)
    {
        return $query->where('estado', 'cinza');
    }
}
