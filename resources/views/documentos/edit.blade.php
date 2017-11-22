@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">
		@if(Auth::user()->tipo!=3)
      {!! Form::model($doc,['route'=>['documento.update',$doc->id],'method'=>'PUT','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form']) !!}
		@else
			{!! Form::model($doc,['route'=>['accesoEstudiante.update',$doc->id],'method'=>'PUT','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data','files'=>true,'autocomplete'=>'off', 'role'=>'form']) !!}
		@endif
			<center><h4><i class="fa fa-file-pdf-o"></i> Edición para:
				<?php use App\Tipo;
							use App\Proyecto;
				$ti=Tipo::nombreTipo($doc->f_tipo); ?>
				<b>
					{{$ti}}
				</b>
			 </h4></center><hr>

				<?php $bandera=1;
					$cad='/sipra/public/enlace?doc=';
					$dir=$cad.(String)$doc->f_proyecto;
          $t=$doc->f_tipo;
				?>
				<p>{{Proyecto::find($doc->f_proyecto)->titulo}}</p>
				@include('documentos.formularios.formulario')
				<a class="btn btn-default" href={{$dir}}>Cancelar</a>
			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
