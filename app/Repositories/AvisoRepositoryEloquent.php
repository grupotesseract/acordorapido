<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AvisoRepository;
use App\Aviso;
use App\Validators\AvisoValidator;
use App\Http\Requests\AvisoCreateRequest;


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

    public function enviarAviso (AvisoCreateRequest $request) 
    {

        $client = new Client(['base_uri' => 'https://api-rest.zenvia360.com.br/services/']); //GuzzleHttp\Client
        
        $result = $client->request('POST','send-sms', 
            
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Basic YnJpdHRvOkpCM0R1T1lCbnc=',
                    'Accept' => 'application/json',
                ],
                'json' => [
                    'sendSmsRequest' => [                        
                        'from' => 'AcordoRápido',
                        'to' => '55'.$request['to'],
                        'msg' => $request['msg'],
                        'callbackOption' => 'NONE',
                        //SALVAR ID DO AVISO PREVIAMENTE CADASTRADO
                        //NO CASO DE ENVIOS SEPARADOS, DETECTAR ULTIMO ID
                        //PENSAR NESSA LÓGICA
                        'id' => '34',
                        'aggregateId' => '1111'
                    ]
                ]
            ]
        );       

                
        $result->getStatusCode();
        $response = $result->getBody();

    }
}
