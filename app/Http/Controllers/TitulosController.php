<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\TituloCreateRequest;
use App\Http\Requests\TituloUpdateRequest;
use App\Repositories\TituloRepository;
use App\Validators\TituloValidator;

use App\Empresa as Empresa;
use App\Cliente as Cliente;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Collections\RowCollection;
use Maatwebsite\Excel\Collections\SheetCollection;

use Auth;

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

    public function __construct(TituloRepository $repository, TituloValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
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

        return view('titulos.index', compact('titulos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TituloCreateRequest $request
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
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $titulo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $titulo,
            ]);
        }

        return view('titulos.show', compact('titulo'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
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
     * @param  TituloUpdateRequest $request
     * @param  string            $id
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
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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

    public function importa(TituloCreateRequest $request, $estado)
    {
        Excel::load('public/sample_titulos.xlsx', function($reader) {

            $reader->each(function($sheet) {
                $empresa = Empresa::ofNome($sheet->escola)->get()->first();
                if (is_null($empresa)) {
                    $empresa = new Empresa;
                    $empresa->nome = $sheet->escola;
                    $empresa->user_id = Auth::id();
                    $empresa->cidade = $sheet->cidade;
                    $empresa->estado = $sheet->estado;
                    $empresa->save();
                    $empresa_id = $empresa->id;
                }
                else
                    $empresa_id = $empresa->id;

                $cliente = Cliente::OfRGeEmpresa($sheet->rg)->get()->first();

                if (is_null($cliente)) {
                    $cliente = new Cliente;
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
                }
                else
                    $cliente_id = $cliente->id;


            });


        });

    }
}
