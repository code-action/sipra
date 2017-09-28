@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

      {!! Form::model($ca,['route'=>['carrera.update',$ca->id],'method'=>'PUT','class'=>'form-horizontal style-form','autocomplete'=>'off']) !!}
			<center><h4><i class="fa fa-graduation-cap"></i> Modificar carrera </h4></center><hr>
				<?php $bandera=2;?>
				@include('carreras.formularios.formulario')
        <input name="bandera" type="hidden" value="2">

				@if($ca->estado==1)
      <a class="btn btn-default" href="/sipra/public/carrera?estado=1">Cancelar</a>
        @else
      <a class="btn btn-default" href="/sipra/public/carrera?estado=0">Cancelar</a>
        @endif
			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
