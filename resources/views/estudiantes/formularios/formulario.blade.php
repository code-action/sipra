@foreach ($errors->get('carne') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lcarne','Carné:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('carne',null,['class'=>'form-control','onKeyPress' => 'return cValido( this, event,this.value);', 'placeholder'=>'Número de carné'])!!}
	</div>
</div>

@foreach ($errors->get('nombre') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lnombre','Nombre:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('nombre',null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Nombre'])!!}
	</div>
</div>

@foreach ($errors->get('apellido') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lapellido','Apellido:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('apellido',null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Apellido'])!!}
	</div>
</div>

@foreach ($errors->get('f_carrera') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lcarrera','Carrera:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		<select class="form-control" name="f_carrera">
			<option value='0'>[Seleccione una opción]</option>
		  <?php use App\Carrera;
			$carr=Carrera::Buscar(null,'1');?>
			@if($bandera==1)
			@foreach ($carr as $c)
				<option value='{{$c->id}}'>{{$c->nombre}}</option>
			@endforeach
		@else
			@foreach ($carr as $c)
				@if($estudiante->f_carrera==$c->id)
					<option value='{{$c->id}}' selected>{{$c->nombre}}</option>
				@else
				<option value='{{$c->id}}'>{{$c->nombre}}</option>
			@endif

			@endforeach
		@endif
		</select>
	</div>
</div>
