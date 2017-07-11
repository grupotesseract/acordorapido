<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvisoEnviadoRepository;
use App\Entities\AvisoEnviado;
use App\Validators\AvisoEnviadoValidator;

/**
 * Class AvisoEnviadoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AvisoEnviadoRepositoryEloquent extends BaseRepository implements AvisoEnviadoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AvisoEnviado::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
