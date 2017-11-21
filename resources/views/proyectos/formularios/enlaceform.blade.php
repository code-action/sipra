Datos estudiante: {{$a+1}}
@foreach ($errors->get($valor) as $error)
  <div class="alert-d">
    <br>{{$error}}
  </div>
@endforeach
<div class="form-group">
{!!Form::label('lcarne','Carné:',['class'=>'col-sm-2 control-label'])!!}
<div class="col-sm-9">
  {!!Form::text('carne'.(String)$a,null,['id'=>'mayuscula','class'=>'form-control','onKeyPress' => 'return cValido( this, event,this.value);', 'placeholder'=>'Número de carné'])!!}
</div>
  </div>

@foreach ($errors->get($valorn) as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lnombre','Nombre:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('nombre'.(String)$a,null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Nombre'])!!}
	</div>
</div>

@foreach ($errors->get($valora) as $error)
	<div class="alert-d">
		<br>{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lapellido','Apellido:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('apellido'.(String)$a,null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Apellido'])!!}
	</div>
</div>
