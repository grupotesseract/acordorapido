<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ImportacaoRepository;
use App\Entities\Importacao;
use App\Validators\ImportacaoValidator;

/**
 * Class ImportacaoRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ImportacaoRepositoryEloquent extends BaseRepository implements ImportacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Importacao::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
