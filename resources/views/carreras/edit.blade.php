@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

      {!! Form::model($ca,['route'=>['carrera.update',$ca->id],'method'=>'PUT','class'=>'form-horizontal style-form','autocomplete'=>'off']) !!}
			<center><h4><a href={!! asset('/ayudar/13') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-graduation-cap"></i></a> Modificar carrera </h4></center><hr>
				<?php $bandera=2;?>
				@include('carreras.formularios.formulario')
        <input name="bandera" type="hidden" value="2">

				@if($ca->estado==1)
      <a class="btn btn-default" href="/sipra/public/carrera?estado=1">Cancelar</a>
        @else
      <a class="btn btn-default" href="/sipra/public/carrera?estado=0">Cancelar</a>
        @endif
			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
