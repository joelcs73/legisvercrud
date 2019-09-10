@extends('welcome')
@section('titulo',"Editando datos de ")
@section('subtitulo',$diputado->nombreDiputado )
@section('Contenido')
<form action="/guardalegislador/{{ $diputado->idDiputado }}">
	<div class="row">
		<div class="col-auto">
			<div class="form-group">
				{{--  <label>Guardar</label>  --}}
				<button id="btnGuardar" name="btnGuardar" class="btn btn-primary"><span class="oi oi-check"></button>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="form-group col-sm-12 col-md-4">
			<label >Nombre</label>
			<input type="text" name="nombre" id="txtNombre" class="form-control input" value="{{ $diputado->nombre }}">
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label >Apellido paterno</label>
			<input type="text" name="paterno" id="txtPaterno" class="form-control input" value="{{ $diputado->paterno }}">
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label >Apellido materno</label>
			<input type="text" name="materno" id="txtMaterno" class="form-control input" value="{{ $diputado->materno }}">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="form-group col-sm-12 col-md-4">
			<label >Extensión</label>
			<input type="text" name="extension" id="txtExtension" class="form-control input" value="{{ $diputado->extension }}">
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label >Correo electrónico</label>
			<input type="text" name="correo" id="txtCorreo" class="form-control input" value="{{ $diputado->correo }}">
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label >Archivo Curriculum (pdf)</label>
			<input type="text" name="cvPdf" id="txtCvPdf" class="form-control input" value="{{ $diputado->cvPdf }}">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="form-group col-sm-12 col-md-4">
			<label >Distrito</label>
			<select class="custom-select" name="idDistrito">
					<option>Seleccione</option>
					@foreach ($distritos as $distrito)
						@if($distrito->idDistrito==$diputado->idDistrito)
							<option selected value="{{ $distrito->idDistrito }}">{{ $distrito->nombre }}</option>
						@else
							<option value="{{ $distrito->idDistrito }}">{{ $distrito->nombre }}</option>
						@endif
					@endforeach
			</select>
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label >Cargo</label>
			<input type="text" name="cargo" id="txtCargo" class="form-control input" value="{{ $diputado->cargo }}">
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label >Archivo Fotografía (jpg)</label>
			{{-- <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label> --}}
			{{-- <input type="file" class="custom-file-input" id="customFileLang" lang="es"> --}}


			<input type="text" name="foto" id="txtFoto" class="form-control input" value="{{ $diputado->foto }}">
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="form-group col-sm-12 col-md-4">
			<label>Es suplente de:</label>
			@php ($activado='')
			@if($diputado->tipoDeCargo=='Propietario')
				@php ($activado='disabled')
			@endif
			
			<select class="custom-select" name="suplenteDe">
					<option value=0>Es propietario</option>
					@foreach ($diputados as $propietario)
						@php ($seleccionado = '')
						@if($diputado->suplenteDe==$propietario->idDiputado)
							@php ($seleccionado = 'selected')
						@endif
						
							<option {{ $activado }} {{ $seleccionado }} value="{{ $propietario->idDiputado }}">{{ $propietario->nombreDiputado }}</option>
						{{-- @else --}}
							{{-- <option {{ $activado }} value="{{ $propietario->idDiputado }}">{{ $propietario->nombreDiputado }}</option> --}}
					@endforeach
			</select>
		</div>
		<div class="form-group col-sm-12 col-md-4" hidden>
			<label >OrdenNivel</label>
			<input type="text" name="ordenNivel" id="txtOrdenNivel" class="form-control input" value="{{ $diputado->ordenNivel }}">
		</div>		
	</div>
	<div class="row">
		<div class="col-auto">
			<div class="form-group">
				{{--  <label>Guardar</label>  --}}
				<button id="btnGuardar" name="btnGuardar" class="btn btn-primary"><span class="oi oi-check"></span></button>
			</div>
		</div>
	</div>
</form>
@endsection