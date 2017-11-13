@foreach ($errors->get('name') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach

<div class="form-group">
	{!!Form::label('lusuario','Usuario:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('name',null,['class'=>'form-control', 'placeholder'=>'Usuario'])!!}
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
		{!!Form::text('nombre',null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Nombre del usuario'])!!}
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
		{!!Form::text('apellido',null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Apellido del usuario'])!!}
	</div>
</div>
@foreach ($errors->get('tipo') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
{!!Form::label('Ltipo','Tipo de usuario:',['class'=>'col-sm-2 control-label'])!!}
<div class="col-sm-9">
		<select name="tipo" class='form-control'>
		@if($bandera==1)
			<option value="">[Seleccione un tipo]</option>
			@if(Auth::check())
			@if (Auth::user()->tipo==1)
			<option value="1">Administrador</option>
			@endif
		@else
			<option value="1">Administrador</option>
		@endif
			@if(!isset($primero))
			<option value="2">Editor</option>
			@else
			<input type="hidden" name="primero" value="1">
			@endif
		@else
			<option value="">[Seleccione un tipo]</option>
				@if($usuario->tipo==1)
			<option value="1" selected="true">Administrador</option>
			<option value="2" >Editor</option>
				@else
				@if (Auth::user()->tipo==1)
				<option value="1">Administrador</option>
				@endif
				<option value="2" selected="true">Editor</option>
				@endif

		@endif
		</select>
	</div>
</div>

@foreach ($errors->get('email') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach

<div class="form-group">
	{!!Form::label('lcorreo','Correo:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::email('email',null,['class'=>'form-control', 'placeholder'=>'Ingrese su correo'])!!}
	</div>
</div>

@foreach ($errors->get('password') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach

<div class="form-group">
	{!!Form::label('lpasswprd','Contraseña:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::password('password',['class'=>'form-control', 'placeholder'=>'Password'])!!}
	</div>
</div>

@foreach ($errors->get('password_confirmation') as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach

<div class="form-group">
	{!!Form::label('lpasswprd','Confirmar contraseña:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::password('password_confirmation',['class'=>'form-control', 'placeholder'=>'Confirmación'])!!}
	</div>
</div>
