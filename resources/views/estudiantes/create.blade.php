@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'estudiante.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-book"></i> Nuevo estudiante </h4></center><hr>

				<?php $bandera=1;?>
				@include('estudiantes.formularios.formulario')
				<input name="bandera" type="hidden" value="1">
				<input name="id_proy" type="hidden" value="{{$id_proy}}">
				<a class="btn btn-default" href="/sipra/public/proyecto/{{$id_proy}}">Cancelar</a>
				{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
				{!!Form::close()!!}

		</div>
	</div>
@stop
