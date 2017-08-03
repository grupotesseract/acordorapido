<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ModeloAvisoCreateRequest;
use App\Http\Requests\ModeloAvisoUpdateRequest;
use App\Repositories\ModeloAvisoRepository;
use App\Repositories\EmpresaRepository;

use App\Validators\ModeloAvisoValidator;
use Auth;


class ModeloAvisosController extends Controller
{

    /**
     * @var ModeloAvisoRepository
     */
    protected $repository;

    /**
     * @var ModeloAvisoValidator
     */
    protected $validator;

    public function __construct(ModeloAvisoRepository $repository, ModeloAvisoValidator $validator, EmpresaRepository $empresaRepository)
    {
        $this->repository = $repository;
        $this->empresaRepository = $empresaRepository;
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
        $modeloAvisos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $modeloAvisos,
            ]);
        }

        return view('modeloAvisos.index', compact('modeloAvisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ModeloAvisoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloAvisoCreateRequest $request)
    {

        try {

            
            $request->request->add(['user_id' => Auth::id()]);

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $modeloAviso = $this->repository->create($request->all());

            $response = [
                'message' => 'ModeloAviso created.',
                'data'    => $modeloAviso->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect('/avisomodelos')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect('/avisomodelos')->withErrors($e->getMessageBag())->withInput();
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
        $modeloAviso = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $modeloAviso,
            ]);
        }

        return view('modeloAvisos.show', compact('modeloAviso'));
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

        $modeloAviso = $this->repository->find($id);
        $escolas = $this->empresaRepository->all();

        return view('modeloAvisos.edit', compact('modeloAviso','escolas'));
    }

    /**
     * Criar modelo de avisos
     * @return [type] view de criação
     */
    public function create()
    {        
        $escolas = $this->empresaRepository->all();
        return view('modeloAvisos.edit', compact('escolas'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ModeloAvisoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ModeloAvisoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $modeloAviso = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ModeloAviso updated.',
                'data'    => $modeloAviso->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect('/avisomodelos')->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect('/avisomodelos')->withErrors($e->getMessageBag())->withInput();
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
                'message' => 'ModeloAviso deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect('/avisomodelos')->with('message', 'ModeloAviso deleted.');
    }
}
