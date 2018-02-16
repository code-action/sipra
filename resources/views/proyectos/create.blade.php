@extends('plantillas.menuc')
@section('contenidoPagina')
		<div class="form-panel">

			{!!Form::open(['route'=>'proyecto.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><a href={!! asset('/ayudar/3') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-folder-open"></i></a> Nuevo proyecto </h4></center><hr>
				<?php $bandera=1;?>
				@include('proyectos.formularios.formulario')
				<input name="bandera" id="bandera" type="hidden" value="1">
				<center>
				<a class="btn btn-default" href="/sipra/public/proyecto">Cancelar</a>
				{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
				{!!Form::close()!!}
				</center>

		</div>
@stop
