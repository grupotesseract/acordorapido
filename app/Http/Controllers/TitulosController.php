<?php

namespace App\Http\Controllers;

use App\Aviso;
use App\Cliente as Cliente;
use App\Empresa as Empresa;
use App\Http\Requests\TituloCreateRequest;
use App\Http\Requests\TituloUpdateRequest;
use App\Importacao as Importacao;
use App\Repositories\AvisoRepository;
use App\Repositories\TituloRepository;

use App\Repositories\ModeloAvisoRepository;
use App\Titulo as Titulo;
use App\Validators\TituloValidator;
use Auth;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Redirect;

class TitulosController extends Controller
{
    /**
     * @var TituloRepository
     */
    protected $repository;

    /**
     * @var TituloValidator
     */
    protected $validator;

    public function __construct(TituloRepository $repository, TituloValidator $validator, AvisoRepository $avisoRepository, ModeloAvisoRepository $modeloAvisoRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->avisoRepository = $avisoRepository;
        $this->modeloAvisoRepository = $modeloAvisoRepository;

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $titulos = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $titulos,
            ]);
        }

        $titulos = Titulo::with(['avisos' => function ($query) {
            $query->where('status','>=',1);
        }])->get();

        dd($titulos);
        
        return view('titulos.index', compact('titulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TituloCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TituloCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $titulo = $this->repository->create($request->all());

            $response = [
                'message' => 'Titulo created.',
                'data'    => $titulo->toArray(),
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
        $titulo = $this->repository->find($id);
        $avisos = $titulo->avisos;

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $titulo,
            ]);
        }

        return view('titulos.show', compact('titulo','avisos'));
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
        $titulo = $this->repository->find($id);

        return view('titulos.edit', compact('titulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TituloUpdateRequest $request
     * @param string              $id
     *
     * @return Response
     */
    public function update(TituloUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $titulo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Titulo updated.',
                'data'    => $titulo->toArray(),
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
                'message' => 'Titulo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Titulo deleted.');
    }

    public function importacao($estado)
    {
        $escolas = Empresa::all();

        return view('importacao')->with(['estado'=> $estado, 'escolas' => $escolas]);
    }

    public function showModulo($estado)
    {
        $u = Auth::user();
        $titulos = Titulo::porEstado($estado)
        ->with(['avisos' => function ($query) {
            $query->where('status','>=',1);
        }])
        ->get();

        if ($u->hasRole('aluno')) {
            $cliente = $u->cliente;
            if (!$cliente) {
                dd('aluno não encontrado');
            }
            $avisos = Aviso::where('cliente_id', $cliente->id);
        }

        if ($u->hasRole('escola')) {
            $empresa = $u->empresa;
            if (!$empresa) {
                dd('empresa não encontrada');
            }
            $avisos = Aviso::where('cliente_id', $empresa->id);
        }

        if ($u->hasRole('admin')) {
            $avisos = Aviso::query();
        }

        $avisos = $avisos->where('estado',$estado);
        $totalAvisos = $avisos->count();

        $totalSMSs = $avisos->get()->each(function ($aviso) { 
            $aviso->totalSMS = $aviso->avisosenviados()->smss()->count(); 
        })->pluck('totalSMS')->sum();

        $totalLigacoes = $avisos->get()->each(function ($aviso) { 
            $aviso->totalLigacoes = $aviso->avisosenviados()->ligacoes()->count(); 
        })->pluck('totalLigacoes')->sum();

        return view('modulos.show')->with([
            'titulos' => $titulos,
            'totalAvisos' => $totalAvisos,
            'totalSMSs' => $totalSMSs,
            'totalLigacoes' => $totalLigacoes,
        ]);
    }

    public function titulos($id_importacao)
    {
        //$titulos = Titulo::where('importacao_id', $id_importacao)->get();
        $importacao = Importacao::find($id_importacao)->first();
        $titulos = $importacao->titulos->all();
        $escola = $importacao->empresa;

        return view('importacoes.titulos')->with(['escola'=> $escola, 'titulos'=> $titulos, 'importacao'=> $importacao]);
    }

    public function importa(TituloCreateRequest $request, string $estado)
    {
        $importacao = Importacao::create(['user_id' => Auth::id(), 'modulo' => $estado, 'empresa_id' => $request->escola]);
        $importacao_id = $importacao->id;
        $empresa_id = $request->escola;

        $titulos_importados = array();

        Excel::load($request->file('excel'), function ($reader) use ($estado,$empresa_id,$importacao_id,&$titulos_importados) {
            $reader->each(function ($sheet) use ($estado,$empresa_id,$importacao_id,&$titulos_importados) {
                $cliente = Cliente::firstOrNew(['rg' => $sheet->rg]);
                $cliente->nome = $sheet->nome;
                $cliente->user_id = Auth::id();
                $cliente->turma = $sheet->turma;
                $cliente->periodo = $sheet->periodo;
                $cliente->responsavel = $sheet->responsavel;
                $cliente->celular = $sheet->celular;
                $cliente->telefone = $sheet->telefone;
                $cliente->telefone2 = $sheet->telefone2;
                $cliente->celular2 = $sheet->celular2;
                $cliente->rg = $sheet->rg;
                $cliente->save();
                $cliente_id = $cliente->id;

                $titulo = Titulo::firstOrNew(['titulo' => $sheet->titulo, 'empresa_id' => $empresa_id]);
                $titulo->cliente_id = $cliente_id;
                $titulo->empresa_id = $empresa_id;
                $titulo->pago = false;
                $titulo->vencimento = $sheet->vencimento;
                $titulo->valor = $sheet->valor;
                $titulo->titulo = $sheet->titulo;
                $titulo->estado = $estado;
                $titulo->save();
                $titulos_importados[] = $titulo->id;

                //criar registro na tabela pivot
                $titulo->importacoes()->attach($importacao_id);

                $vencimento = date('d-m-Y', strtotime(str_replace('-', '/', $titulo->vencimento)));

                $user_id = Auth::id();
                $escola = Empresa::find($empresa_id)->nome;
                
                //TODO - AQUI DEVE SER PARAMETRIZADO A MENSAGEM POR ESTADO E ESCOLA
                $retorno = $this->modeloAvisoRepository->parametrizaAviso($estado,$empresa_id,$vencimento);


                if (count($this->avisoRepository->findWhere(['titulo_id'  => $titulo->id,'estado' => $estado])->toArray()) == 0) {                    
                    $this->avisoRepository->create(
                        [
                            'tituloaviso' => $retorno['titulo'],
                            'texto'      => $retorno['mensagem'],
                            'user_id'    => Auth::id(),
                            'cliente_id' => $cliente_id,
                            'status'     => 0,
                            'estado'     => $estado,
                            'titulo_id'  => $titulo->id,
                        ]

                    );
                }
            });
        });

        //TODO: CONFIRMAR COM EDILSON
        if ($estado == 'verde' OR $estado == 'azul') {
            $this->repository->atualizaPagantes($estado,$empresa_id, $titulos_importados);
        }

        \Session::flash('flash_message_success', true);
        \Session::flash('flash_message', 'Títulos importados com sucesso!');

        return Redirect::to('/importacao/'.$estado);
    }
}
