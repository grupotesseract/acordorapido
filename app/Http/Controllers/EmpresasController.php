<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaCreateRequest;
use App\Http\Requests\EmpresaUpdateRequest;
use App\Repositories\EmpresaRepository;
use App\Validators\EmpresaValidator;
use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class EmpresasController extends Controller
{
    /**
     * @var EmpresaRepository
     */
    protected $repository;

    /**
     * @var EmpresaValidator
     */
    protected $validator;

    public function __construct(EmpresaRepository $repository, EmpresaValidator $validator)
    {
        $this->repository = $repository;
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
        $escolas = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $escolas,
            ]);
        }

        return view('escolas.index', compact('escolas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmpresaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $empresa = $this->repository->create($request->all());

            $response = [
                'message' => 'Empresa created.',
                'data'    => $empresa->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect('escolas/')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect('escolas/')->withErrors($e->getMessageBag())->withInput();
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
        $empresa = $this->repository->find($id);
        $empresa->titulos = 9;

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $empresa,
            ]);
        }

        $escola = $empresa;

        return view('escolas.show', compact('escola'));
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
        $empresa = $this->repository->find($id);

        $escola = $empresa;

        return view('escolas.edit', compact('escola'));
    }

    public function create()
    {       
        return view('escolas.edit', compact('escola'));
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param EmpresaUpdateRequest $request
     * @param string               $id
     *
     * @return Response
     */
    public function update(EmpresaUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $empresa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Empresa updated.',
                'data'    => $empresa->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }

            return redirect('escolas/')->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect('escolas/')->withErrors($e->getMessageBag())->withInput();
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
                'message' => 'Empresa deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect('escolas/')->with('message', 'Empresa deleted.');
    }
}
