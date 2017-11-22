@extends('plantillas.menuc')

@section('contenidoPagina')
  <div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'usuario.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-user"></i> Crear usuario </h4></center><hr>

				<?php $bandera=1;?>
				@include('usuarios.formularios.formulario')
				<input name="bandera" type="hidden" value="1">
        <a class="btn btn-default" href="/sipra/public/usuario?estado=1">Cancelar</a>
			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>

@stop
