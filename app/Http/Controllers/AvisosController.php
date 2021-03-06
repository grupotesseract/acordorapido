<?php

namespace App\Http\Controllers;

use App\Http\Requests\AvisoCreateRequest;

use App\Http\Requests\AvisoUpdateRequest;
use App\Repositories\AvisoRepository;
use App\Validators\AvisoValidator;

use App\Entities\AvisoEnviado as AvisoEnviado;

use App\Repositories\AvisoEnviadoRepository;


use Auth;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class AvisosController extends Controller
{
    /**
     * @var AvisoRepository
     */
    protected $repository;

    /**
     * @var AvisoValidator
     */
    protected $validator;

    public function __construct(AvisoRepository $repository, AvisoValidator $validator, AvisoEnviadoRepository $avisoenviadorepository)
    {
        $this->middleware('auth');
        $this->repository = $repository;
        $this->avisoenviadorepository = $avisoenviadorepository;

        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $avisos = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $avisos,
            ]);
        }

        return view('avisos.index', compact('avisos'));
    }

    /**
     * Lista os avisos pendentes.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendentes()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $avisos = $this->repository->findByField('status', 0)->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $avisos,
            ]);
        }

        return view('avisos.index', compact('avisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AvisoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AvisoCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $aviso = $this->repository->create($request->all());

            $response = [
                'message' => 'Aviso created.',
                'data'    => $aviso->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aviso = $this->repository->find($id);

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $aviso,
            ]);
        }

        return view('avisos.show', compact('aviso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aviso = $this->repository->find($id);

        return view('avisos.edit', compact('aviso'));
    }

    public function create()
    {
        return view('avisos.edit', compact('aviso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AvisoUpdateRequest $request
     * @param string             $id
     *
     * @return Response
     */
    public function update(AvisoUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $aviso = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Aviso updated.',
                'data'    => $aviso->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {
            return response()->json([
                'message' => 'Aviso deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Aviso deleted.');
    }

    public function salvaLigacao(Request $request) {
        $aviso = $this->repository->find($request->aviso_id);

        $this->avisoenviadorepository->create([
                'user_id' => Auth::id(),
                'aviso_id' => $aviso->id,
                'estado' => $aviso->estado,
                'tipodeaviso' => 1,
                'status' => '1',
                'observacaoligacao' => $request->observacaoligacao,
                'tempoligacao' => $request->tempoligacao[0]
            ]);      

        $aviso->status = $aviso->status + 1;
        $aviso->save();

        return redirect()->back();

    }

    public function enviaSMS($aviso_id)
    {
        $aviso = $this->repository->find($aviso_id);

        $retorno = $this->repository->enviarAviso([
            'to'     => $aviso->cliente->celular,
            'titulo' => $aviso->tituloaviso,
            'texto'  => $aviso->texto,
            'id'     => $aviso->cliente->id,
        ]);

        if ($retorno == '200') {
            $aviso->status = $aviso->status + 1;
        }

        $avisoenviado = new AvisoEnviado;
        $avisoenviado->user_id = Auth::id();
        $avisoenviado->aviso_id = $aviso->id;
        $avisoenviado->estado = $aviso->estado;
        $avisoenviado->tipodeaviso = 0; //SMS
        $avisoenviado->status = $retorno; //Terá código de retorno da API    

        $avisoenviado->save();
        $aviso->save();

        return redirect()->back();
    }

    public function enviarAviso(AvisoCreateRequest $request)
    {
        $aviso = $this->repository->create($request->all());

        $retorno = $this->repository->enviarAviso($request);

        //TRATAR RETORNO
        if ($retorno = '200') {
            return redirect()->back()->with('message', 'SMS enviado com sucesso!');
        }
        else
            return redirect()->back()->with('message', 'Houve algum erro ao enviar o SMS. Código do erro '.$retorno);

    }

    public function enviarLoteAviso(Request $request) 
    {
        foreach ($request->aviso as $key => $value) {
            $aviso = $this->repository->find($value);
            $retorno = $this->repository->enviarAviso([
                'to'     => $aviso->cliente->celular,
                'titulo' => $aviso->tituloaviso,
                'texto'  => $aviso->texto,
                'id'     => $aviso->cliente->id,
            ]);

            if ($retorno == '200') {
                $aviso->status = $aviso->status + 1;
            }

            $avisoenviado = new AvisoEnviado;
            $avisoenviado->user_id = Auth::id();
            $avisoenviado->aviso_id = $aviso->id;
            $avisoenviado->estado = $aviso->estado;
            $avisoenviado->tipodeaviso = 0; //SMS
            $avisoenviado->status = $retorno; //Terá código de retorno da API    

            $avisoenviado->save();
            $aviso->save();            
        }

        return redirect()->back()->with('message', 'Avisos enviados com sucesso!');
    }
}
