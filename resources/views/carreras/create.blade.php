@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'carrera.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><a href={!! asset('/ayudar/14') !!} target="blank_"><i class="fa fa-graduation-cap"></i></a> Crear carrera </h4></center><hr>

				<?php $bandera=1;?>
				@include('carreras.formularios.formulario')
				<input name="bandera" type="hidden" value="1">
        <a class="btn btn-default" href="/sipra/public/carrera?estado=1">Cancelar</a>
			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
