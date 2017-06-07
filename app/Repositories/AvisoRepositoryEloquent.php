<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvisoRepository;
use App\Aviso;
use App\Validators\AvisoValidator;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

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

    public function enviarAviso () 
    {

        $client = new Client(); //GuzzleHttp\Client
        
        $result = $client->get('http://www.zenvia360.com.br/GatewayIntegration/msgSms.do', 
            [
                'headers' => [
                    'Authorization'=> 'Basic '.'YnJpdHRvOkpCM0R1T1lCbnc=',
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'sendSmsRequest' => [
                    'from' => 'Aviso Rápido',
                    'to' => '5514981225509',
                    'msg' => 'teste zenvia',
                    'callbackOption' => 'NONE',
                    'id' => '2'
                ]
            ]
        );
        
        $result->getStatusCode();
        $response = $result->getBody();

        dd($result);    

    }
}
