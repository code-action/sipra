@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

      {!! Form::model($estudiante,['route'=>['estudiante.update',$estudiante->id],'method'=>'PUT','autocomplete'=>'off','class'=>'form-horizontal style-form']) !!}
      <center><h4><i class="fa fa-credit-card"></i> Modificar Estudiante </h4></center><hr>
				<?php $bandera=2;?>
				@include('estudiantes.formularios.formulario')
        <input name="bandera" type="hidden" value="2">
				@if($estudiante->estado==1)
      <a class="btn btn-default" href="/sipra/public/estudiante?estado=1">Cancelar</a>
        @else
      <a class="btn btn-default" href="/sipra/public/estudiante?estado=0">Cancelar</a>
        @endif

			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
