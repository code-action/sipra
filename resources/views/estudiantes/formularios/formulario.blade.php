@foreach ($errors->get('carne') as $error)
	<div class="alert-d">
		{{$error}}
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
		{{$error}}
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
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lapellido','Apellido:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('apellido',null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Apellido'])!!}
	</div>
</div>
