@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'constancia.store','method'=>'POST','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-file-pdf-o"></i> Constancia:
				<?php use App\Estudiante;
				$est=App\User::find($id_estudiante); ?>
				<b>
					{{$est->name}}
				</b>
			 </h4></center><hr>
				<?php $bandera=1;
				?>
				@include('constancias.formularios.formulario')
				<input name="f_estudiante" type="hidden" value='{{$id_estudiante}}'>
				<input name="bandera" type="hidden" value='{{$bandera}}'>
				<?php $id_p=$est->f_proyecto;?>
      <a class="btn btn-default" href="/sipra/public/enlace?doc={{$id_p}}">Cancelar</a>
			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
	<!--<?php //echo round(memory_get_usage()/1048576,2) ?>MB.</p>// memoria que usa la página en MB-->
@stop
