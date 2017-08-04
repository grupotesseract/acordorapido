<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ModeloAvisoRepository;
use App\Entities\ModeloAviso;
use App\Validators\ModeloAvisoValidator;

/**
 * Class ModeloAvisoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ModeloAvisoRepositoryEloquent extends BaseRepository implements ModeloAvisoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ModeloAviso::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ModeloAvisoValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function parametrizaAviso ($estado, $empresa, $vencimento = null) {
                
        $modeloaviso = ModeloAviso::where('tipo',ucfirst($estado))->where('empresa_id',$empresa)->get()->first();

        if (!$modeloaviso) {
            return false;
        }

        $modelo_aviso_final['mensagem'] = str_replace('[escola]', $modeloaviso->empresa->nome, $modeloaviso['mensagem']);
        
        if ($vencimento) {
            $modelo_aviso_final['mensagem'] = str_replace('[vencimento]', $vencimento, $modelo_aviso_final['mensagem']);
        }
        
        $modelo_aviso_final['titulo'] = $modeloaviso['titulo'];


        return $modelo_aviso_final;

    }
}
