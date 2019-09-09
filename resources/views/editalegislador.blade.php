@extends('welcome')
@section('titulo','Editando legislador')
@section('Contenido')

    <h1>{{ $diputado->nombreDiputado }}</h1>
    <h2>{{ $diputado->idDiputado }}</h2>

@endsection