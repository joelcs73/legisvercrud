@extends('welcome')
@section('titulo','Mesa directiva')
@section('Contenido')
   
@if ($diputados!=[])

    <table class="table table-sm table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            {{--  <th scope="col">idDiputadoLegislatura</th>  --}}
            {{--  <th scope="col">idDiputado</th>  --}}
            <th scope="col">Diputado(a)</th>
            <th scope="col">Partido</th>
            <th scope="col">Distrito</th>
            <th scope="col">Tipo de elección</th>
            <th scope="col">Tipo de cargo</th>
            {{--  <th scope="col">Licencia</th>  --}}
        </tr>
        </thead>
        <tbody>
            @php $num = 1;  @endphp
            @foreach ($diputados as $diputado)
                <tr class="">
                    <th>{{ $num }}</th>
                    {{--  <th>{{ $diputado->id }}</th>  --}}
                    {{--  <th>{{ $diputado->idDiputado }}</th>  --}}
                    <th>{{ $diputado->nombreDiputado }}</th>
                    <td>{{ $diputado->nombrePartido }}</td>
                    <td>{{ $diputado->nombreDistrito }}</td>
                    <td>{{ $diputado->tipoDeEleccion }}</td>
                    <td>{{ $diputado->tipoDeCargo }}</td>
                    {{--  <td class="text-center">
                        <a class="btn btn-outline-dark" href="{{ route('diputado.licencia', ['diputado' => $diputado->idDiputado]) }}">
                            <span class="oi oi-loop-circular"></span>
                        </a>
                    </td>  --}}
                </tr>
                @php $num ++; @endphp
            @endforeach
        </tbody>
    </table>
    @else
        <h1>No hay legisladores para esta legislatura</h1>
    @endif

@endsection

