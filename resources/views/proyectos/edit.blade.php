@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-9">
		<div class="form-panel">

      {!! Form::model($proyecto,['route'=>['proyecto.update',$proyecto->id],'method'=>'PUT','class'=>'form-horizontal style-form','autocomplete'=>'off']) !!}
			<center><h4><i class="fa fa-folder-open"></i> Modificar proyecto </h4></center><hr>
				<?php $bandera=2;?>
				@include('proyectos.formularios.formulario')
        <input name="bandera" type="hidden" value="2">

      <a class="btn btn-default" href="/sipra/public/proyecto">Cancelar</a>

			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
