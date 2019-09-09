@extends('welcome')
@section('titulo','Legisladores')
@section('Contenido')
   
@if ($diputados!=[])

    <table class="table table-sm table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Diputado(a)</th>
            <th scope="col">Partido</th>
            <th scope="col">Distrito</th>
            <th scope="col">Tipo de elección</th>
            <th scope="col">Tipo de cargo</th>
            <th scope="col">Licencia</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($diputados as $diputado)
                <tr class="">
                    <th>{{ $diputado->nombreDiputado }}</th>
                    <td>{{ $diputado->nombrePartido }}</td>
                    <td>{{ $diputado->nombreDistrito }}</td>
                    <td>{{ $diputado->tipoDeEleccion }}</td>
                    <td>{{ $diputado->tipoDeCargo }}</td>
                    <td class="text-center">
                        <a class="btn btn-outline-dark" href="{{ route('diputado.licencia', ['diputado' => $diputado->idDiputado]) }}">
                            <span class="oi oi-loop-circular"></span>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h1>No hay legisladores para esta legislatura</h1>
    @endif

@endsection

