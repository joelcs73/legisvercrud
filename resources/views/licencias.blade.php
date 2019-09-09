@extends('welcome')
@section('titulo','Licencias')
@section('Contenido')
<form class="form-horizontal">
        <fieldset>
       
        <!-- Select Basic -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="cboDiputado">Propietario</label>
          <div class="col-md-6">
            <select id="cboDiputado" name="cboDiputado" class="form-control">
              <option value="0">Seleccione</option>
              @foreach ($diputados as $diputado)
                <option value="{{ $diputado->idDiputado }}">{{ $diputado->nombreDiputado }}</option>
              @endforeach
            </select>
          </div>
        </div>
        
        <!-- Button -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="btnAceptar"></label>
          <div class="col-md-4">
            <button id="btnAceptar" name="btnAceptar" class="btn btn-success">Aceptar</button>
          </div>
        </div>
        
        </fieldset>
        </form>

        @endsection