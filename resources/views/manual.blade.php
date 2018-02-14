@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-6">
		<div class="form-panel">

			{!!Form::open(['route'=>'union.store','method'=>'POST','class'=>'form-horizontal style-form','files'=>true,'autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-file"></i> Manual</h4></center><hr>

				<?php $bandera=1;?>
        <div class="form-group">
        	{!!Form::label('larchivo','Subir archivo:',['class'=>'col-sm-2 control-label'])!!}
        	<div class="col-sm-9">
            {!!Form::file('archivo')!!}
        	</div>
        </div>

			{!!Form::submit('Guardar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
