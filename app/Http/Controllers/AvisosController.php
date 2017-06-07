<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\AvisoCreateRequest;
use App\Http\Requests\AvisoUpdateRequest;
use App\Repositories\AvisoRepository;
use App\Validators\AvisoValidator;




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

    public function __construct(AvisoRepository $repository, AvisoValidator $validator)
    {
        $this->middleware('auth');
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
        $avisos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $avisos,
            ]);
        }

        dd ($avisos);
        //return view('avisos.index', compact('avisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AvisoCreateRequest $request
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $aviso = $this->repository->find($id);

        return view('avisos.edit', compact('aviso'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  AvisoUpdateRequest $request
     * @param  string            $id
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
                'message' => 'Aviso deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Aviso deleted.');
    }

    public function enviarAviso () 
    {   
        $this->repository->enviarAviso();   

    }
}
