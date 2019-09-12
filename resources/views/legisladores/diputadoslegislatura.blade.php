@extends('index')
@section('titulo','Legisladores')
@section('Contenido')
   
@if ($diputados!=[])
    {{-- @if(count($diputados)<50)
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <button id="btnAgregar" name="btnAgregar" class="btn btn-success"><span class="oi oi-plus"></span></button>
            </div>
        </div>
    </div>
    @endif --}}
    <table class="table table-sm table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            {{--  <th scope="col">idDiputadoLegislatura</th>  --}}
            {{--  <th scope="col">idDiputado</th>  --}}
            <th scope="col">Distrito</th>
            <th scope="col">Tipo de cargo</th>
            <th scope="col">Partido</th>
            <th scope="col">Diputado(a)</th>
            {{-- <th scope="col">Tipo de elección</th> --}}
            <th scope="col">Editar</th>
            <th scope="col">Licencia</th>
        </tr>
        </thead>
        <tbody>
            @php ($num = 1)
            @foreach ($diputados as $diputado)
                <tr class="">
                    <th>{{ $num }}</th>
                    {{--  <th>{{ $diputado->id }}</th>  --}}
                    {{--  <th>{{ $diputado->idDiputado }}</th>  --}}
                    <th>{{ $diputado->nombreDistrito }}</th>
                    <td>{{ $diputado->tipoDeCargo }}</td>
                    <td>{{ $diputado->nombrePartido }}</td>
                    <td>{{ $diputado->nombreDiputado }}</td>
                    {{-- <td>{{ $diputado->tipoDeEleccion }}</td> --}}
                    <td class="text-center">
                            <a class="btn btn-outline-dark" href="{{ route('diputado.edita', ['diputado' => $diputado->idDiputado]) }}">
                                <span class="oi oi-pencil"></span>
                            </a>
                        </td>
                    <td class="text-center">
                        <a class="btn btn-outline-dark" href="{{ route('diputado.licencia', ['diputado' => $diputado->idDiputado]) }}">
                            <span class="oi oi-loop-circular"></span>
                        </a>
                    </td>
                </tr>
                @php ($num ++)
            @endforeach
        </tbody>
    </table>
    {{-- @if(count($diputados)<50)
    <div class="row">
        <div class="col-auto">
            <div class="form-group">
                <button id="btnAgregar" name="btnAgregar" class="btn btn-success"><span class="oi oi-plus"></span></button>
            </div>
        </div>
    </div>
    @endif --}}
    @else
        <h1>No hay legisladores para esta legislatura</h1>
    @endif

@endsection

