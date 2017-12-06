@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-12">
		<div class="form-panel">

      {!! Form::model($proyecto,['route'=>['proyecto.update',$proyecto->id],'method'=>'PUT','class'=>'form-horizontal style-form','autocomplete'=>'off']) !!}
			<center><h4><i class="fa fa-folder-open"></i> Modificar proyecto </h4></center><hr>
				<?php $bandera=2;?>
				@include('proyectos.formularios.formulario')
        <input name="bandera" id="bandera" type="hidden" value="2">

      <a class="btn btn-default" href="/sipra/public/proyecto">Cancelar</a>

			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
