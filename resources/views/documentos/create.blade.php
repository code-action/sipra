@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">
			@if(Auth::user()->tipo!=3)
			{!!Form::open(['route'=>'documento.store','method'=>'POST','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form'])!!}
		@else
			{!!Form::open(['route'=>'accesoEstudiante.store','method'=>'POST','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form'])!!}
		@endif
			<center><h4><a href={!! asset('/ayudar/8') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-file-pdf-o"></i></a> Documento nuevo para:
				<?php use App\Tipo;
							use App\Proyecto;
				$ti=Tipo::nombreTipo($t); ?>
				<b>
					{{$ti}}
				</b>
			 </h4></center><hr>

				<?php $bandera=1;
					$cad='/sipra/public/enlace?doc=';
					$dir=$cad.(String)$id;
				?>
				<p>{{Proyecto::find($id)->titulo}}</p>
				@include('documentos.formularios.formulario')
				<input name="f_proyecto" type="hidden" value='{{$id}}'>
				<input name="f_tipo" type="hidden" value='{{$t}}'>
				<a class="btn btn-default" href={{$dir}}>Cancelar</a>
			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
	<!--<?php //echo round(memory_get_usage()/1048576,2) ?>MB.</p>// memoria que usa la página en MB-->
@stop
