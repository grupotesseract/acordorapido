<?php

namespace App\Repositories;

use App\Empresa;
use App\Validators\EmpresaValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EmpresaRepositoryEloquent.
 */
class EmpresaRepositoryEloquent extends BaseRepository implements EmpresaRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Empresa::class;
    }

    /**
     * Specify Validator class name.
     *
     * @return mixed
     */
    public function validator()
    {
        return EmpresaValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
