<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.3/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Aviso as Aviso;
use App\Titulo as Titulo;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        $u = Auth::user();
        if ($u->hasRole('aluno')) {
            $cliente = $u->cliente;
            if (!$cliente) {
                dd('aluno não encontrado');
            }
            $titulos = Titulo::where('cliente_id', $cliente->id);
            $avisos = Aviso::where('cliente_id', $cliente->id);
        }
        if ($u->hasRole('escola')) {
            $empresa = $u->empresa;
            if (!$empresa) {
                dd('empresa não encontrado');
            }
            $titulos = Titulo::where('empresa_id', $empresa->id);
            $avisos = Aviso::where('empresa_id', $empresa->id);
        }
        if ($u->hasRole('admin')) {
            $titulos = Titulo::all();
            $avisos = Aviso::all();
        }

        return view('home')->with(['avisos' => $avisos, 'titulos' => $titulos]);
    }
}
