@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'proyecto.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-folder-open"></i> Nuevo proyecto </h4></center><hr>
			<div class="alert alert-info"><b>Parte 1 de 3</b> Datos básicos del proyecto.</div>
				<?php $bandera=1;?>
				@include('proyectos.formularios.formulario')
				<input name="bandera" type="hidden" value="1">
				<a class="btn btn-default" href="/sipra/public/proyecto">Cancelar</a>
				{!!Form::submit('Continuar',['class'=>'btn btn-theme'])!!}
				{!!Form::close()!!}

		</div>
	</div>
@stop
