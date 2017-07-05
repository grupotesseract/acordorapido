<?php

namespace App\Repositories;

use App\Entities\Importacao;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ImportacaoRepositoryEloquent.
 */
class ImportacaoRepositoryEloquent extends BaseRepository implements ImportacaoRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Importacao::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
