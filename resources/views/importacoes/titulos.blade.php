@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Títulos')

@section('contentheader_title', $importacao->empresa->nome.': '.count($titulos).' títulos importados em '.$importacao->created_at->format('d/m/Y H:i') )

@section('main-content')

@include('titulos.partials.titulos')

@endsection

