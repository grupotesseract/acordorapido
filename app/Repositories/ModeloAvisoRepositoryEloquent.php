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
}
