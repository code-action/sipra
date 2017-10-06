@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'constancia.store','method'=>'POST','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-file-pdf-o"></i> Constancia:
				<?php use App\Estudiante;
				$est=Estudiante::find($id_estudiante); ?>
				<b>
					{{$est->carne}}
				</b>
			 </h4></center><hr>

				<?php $bandera=1;
				?>
				@include('constancias.formularios.formulario')
				<input name="f_estudiante" type="hidden" value='{{$id_estudiante}}'>
				<a class="btn btn-default" href="#"> Cancelar</a>
			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
	<!--<?php //echo round(memory_get_usage()/1048576,2) ?>MB.</p>// memoria que usa la página en MB-->
@stop
