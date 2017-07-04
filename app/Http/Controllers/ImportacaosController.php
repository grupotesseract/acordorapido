<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ImportacaoCreateRequest;
use App\Http\Requests\ImportacaoUpdateRequest;
use App\Repositories\ImportacaoRepository;
use App\Validators\ImportacaoValidator;


class ImportacaosController extends Controller
{

    /**
     * @var ImportacaoRepository
     */
    protected $repository;

    /**
     * @var ImportacaoValidator
     */
    protected $validator;

    public function __construct(ImportacaoRepository $repository, ImportacaoValidator $validator)
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
        $importacaos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $importacaos,
            ]);
        }

        return view('importacaos.index', compact('importacaos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ImportacaoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ImportacaoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $importacao = $this->repository->create($request->all());

            $response = [
                'message' => 'Importacao created.',
                'data'    => $importacao->toArray(),
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
        $importacao = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $importacao,
            ]);
        }

        return view('importacaos.show', compact('importacao'));
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

        $importacao = $this->repository->find($id);

        return view('importacaos.edit', compact('importacao'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ImportacaoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ImportacaoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $importacao = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Importacao updated.',
                'data'    => $importacao->toArray(),
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
                'message' => 'Importacao deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Importacao deleted.');
    }
}
