@extends('index')
@section('titulo',"Gestionando licencia")
{{-- @section('subtitulo',$diputadoSale->nombreDiputado ) --}}
@section('Contenido')

<form action="/guardalicencia">
	@if($diputadoSale->tipoDeCargo=='Propietario') @php ($tituloEntra='El suplente es: ') @else @php ($tituloEntra = 'El propietario es: ') @endif
	@if($diputadoSale->tipoDeCargo=='Propietario') @php ($tituloCheckBox='El suplente tomará su lugar') @else @php ($tituloCheckBox = 'El propietario tomará su lugar') @endif
	@if($diputadoEntraYaHaOcupadoCurul) @php ($nombreDipEntra = $diputadoEntra->nombreDiputado) @else @php ($nombreDipEntra = $diputadoEntra->nombre." ".$diputadoEntra->paterno." ".$diputadoEntra->materno) @endif

	<div class="row">
		<div class="col-sm-12 col-md-6">
			<div class="card text-white bg-danger mb-3" style="max-width: 100%;">
				<div class="card-header"><h4>{{ $diputadoSale->nombreDiputado }}</h4></div>
				<div class="card-body">
				  <h4 class="card-title">Tipo de cargo: {{ $diputadoSale->tipoDeCargo }}</h4>
				  {{-- <p class="card-text">{{ $diputadoSale->tipoDeCargo }}</p> --}}
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-md-6">
			<div class="card text-white bg-success mb-3" style="max-width: 100%;">
				<div class="card-header"><h4>{{ $tituloEntra }}</h4></div>
				<div class="card-body">
				  <h4 class="card-title">{{ $nombreDipEntra }}</h4>
				  {{-- <p class="card-text">{{ $nombreDipEntra }}</p> --}}
				</div>
			</div>
		</div>
	</div>




	<div class="form-group" hidden>
		<div class="form-group col-sm-12 col-md-4">
			<label>idSale</label>
			<input type="text" class="form-control input" name="idSale" value="{{ $diputadoSale->idDiputado }}">
		</div>
		<div class="form-group col-sm-12 col-md-4">
			<label>idEntra</label>
			<input type="text" class="form-control input" name="idEntra" value="{{ $diputadoEntra->idDiputado }}">
		</div>
	</div>

		<div class="form-group form-check">
				<h4><input type="checkbox" class="form-check-input" name="esIntercambio" id="chkEsIntercambio" checked></h4>
				<h4><label class="form-check-label" for="chkEsIntercambio">{{ $tituloCheckBox }}</label></h4>
		</div>

		<button class="btn btn-primary" name="">Aceptar</button>
	</form>


@endsection