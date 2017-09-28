@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

      {!! Form::model($usuario,['route'=>['usuario.update',$usuario->id],'method'=>'PUT','class'=>'form-horizontal style-form','autocomplete'=>'off']) !!}
			<center><h4><i class="fa fa-user"></i> Modificar usuario </h4></center><hr>
				<?php $bandera=2;?>
				@include('usuarios.formularios.formulario')
        <input name="bandera" type="hidden" value="2">
        @if($usuario->estado==1)
      <a class="btn btn-default" href="/sipra/public/usuario?estado=1">Cancelar</a>
        @else
      <a class="btn btn-default" href="/sipra/public/usuario?estado=0">Cancelar</a>
        @endif
			{!!Form::submit('Registrar',['class'=>'btn btn-info'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
