<?php use App\Enlace;?>
@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

      {!! Form::model($constancia,['route'=>['constancia.update',$constancia->id],'method'=>'PUT','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form']) !!}
			<center><h4><i class="fa fa-graduation-cap"></i> Modificar constancia </h4></center><hr>
				<?php $bandera=2;?>
				@include('constancias.formularios.formulario')
        <input name="bandera" type="hidden" value="2">
        <?php $id_p=Enlace::idEsProy($constancia->f_estudiante);?>
      <a class="btn btn-default" href="/sipra/public/enlace?doc={{$id_p}}">Cancelar</a>
			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
