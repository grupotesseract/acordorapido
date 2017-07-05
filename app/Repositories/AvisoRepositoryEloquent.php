<?php

namespace App\Repositories;

use App\Aviso;
use GuzzleHttp\Client;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AvisoRepositoryEloquent.
 */
class AvisoRepositoryEloquent extends BaseRepository implements AvisoRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Aviso::class;
    }

    /**
     * Boot up the repository, pushing criteria.
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function enviarAviso($aviso)
    {
        $client = new Client(['base_uri' => 'https://api-rest.zenvia360.com.br/services/']); //GuzzleHttp\Client

        $result = $client->request('POST', 'send-sms',

            [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Basic YnJpdHRvOkpCM0R1T1lCbnc=',
                    'Accept'        => 'application/json',
                ],
                'json' => [
                    'sendSmsRequest' => [
                        'from'           => $aviso['titulo'],
                        'to'             => '55'.$aviso['to'],
                        'msg'            => $aviso['texto'],
                        'callbackOption' => 'NONE',
                        'aggregateId'    => $aviso['id'],
                    ],
                ],
            ]
        );

        $result->getStatusCode();
        $response = $result->getBody();
    }
}
