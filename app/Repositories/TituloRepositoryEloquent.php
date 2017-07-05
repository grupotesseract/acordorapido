<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TituloRepository;
use App\Titulo as Titulo;
use App\Validators\TituloValidator;

/**
 * Class TituloRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TituloRepositoryEloquent extends BaseRepository implements TituloRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Titulo::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TituloValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Atualiza para pago todos os titulos que não foram importados para o módulo VERDE
     *
     * @param      number  $empresa     ID da Empresa
     */
    public function atualizaPagantes ($empresa_id) {
        Titulo::where('empresa_id',$empresa_id)
              ->where('estado','azul')
              ->where('pago',false)
              ->update(['pago' => true]);
    }
}
