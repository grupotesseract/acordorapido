@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Títulos')

@section('contentheader_title', 'Títulos')

@section('main-content')
<div class="col-xs-2 panel">
    <small>Total Avisos</small>
    <b style="font-size:5em;" class="col-xs-12 text-center">{{ $totalAvisos }}</b>
</div>
<div class="col-xs-2 panel">
    <small>Total SMSs</small>
    <b style="font-size:5em;" class="col-xs-12 text-center">{{ $totalSMSs }}</b>
</div>
<div class="col-xs-2 panel">
    <small>Total Ligações</small>
    <b style="font-size:5em;" class="col-xs-12 text-center">{{ $totalLigacoes }}</b>
</div>
@include('titulos.partials.titulos')




@endsection
