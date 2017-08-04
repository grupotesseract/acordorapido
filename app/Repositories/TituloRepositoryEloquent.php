<?php

namespace App\Repositories;

use App\Titulo as Titulo;
use App\Validators\TituloValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TituloRepositoryEloquent.
 */
class TituloRepositoryEloquent extends BaseRepository implements TituloRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Titulo::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return TituloValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Atualiza para pago todos os titulos que não foram importados para o módulo VERDE.
     *
     * @param number $empresa ID da Empresa
     */
    public function atualizaPagantes($estado,$empresa_id, $titulosimportados)


    {
        if ($estado == 'azul' OR $estado == 'verde') {
            $estado_pagantes = 'azul';    
        }
        elseif ($estado == 'amarelo') {
            $estado_pagantes = 'verde';
        }
        elseif ($estado == 'vermelho') {
            $estado_pagantes = 'amarelo';
        }

        
        Titulo::where('empresa_id', $empresa_id)
              ->where('estado', $estado_pagantes)
              ->where('pago', false)
              ->whereNotIn('id', $titulosimportados)
              ->update(['pago' => true]);
    }
}
