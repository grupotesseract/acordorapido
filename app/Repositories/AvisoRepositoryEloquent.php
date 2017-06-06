<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvisoRepository;
use App\Entities\Aviso;
use App\Validators\AvisoValidator;

/**
 * Class AvisoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AvisoRepositoryEloquent extends BaseRepository implements AvisoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Aviso::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
