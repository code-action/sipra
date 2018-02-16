@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-12">
		<div class="form-panel">

      {!! Form::model($proyecto,['route'=>['proyecto.update',$proyecto->id],'method'=>'PUT','class'=>'form-horizontal style-form','autocomplete'=>'off']) !!}
			<center><h4><a href={!! asset('/ayudar/2') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-folder-open"></i></a> Modificar proyecto </h4></center><hr>
				<?php $bandera=2;?>
				@include('proyectos.formularios.formulario')
        <input name="bandera" id="bandera" type="hidden" value="2">
<center>
      <a class="btn btn-default" href="/sipra/public/proyecto">Cancelar</a>

			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}
</center>
		</div>
	</div>
@stop
