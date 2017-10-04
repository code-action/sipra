@foreach ($errors->get('codigo') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach

<div class="form-group">
	{!!Form::label('lcodigo','Código:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('codigo',null,['class'=>'form-control','onKeyPress' => 'return codC( this, event,this.value);', 'placeholder'=>'Código'])!!}
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
		{!!Form::text('nombre',null,['class'=>'form-control','onKeyPress' => 'return noNumeros( this, event,this.value);', 'placeholder'=>'Nombre de la carrera'])!!}
	</div>
</div>

@foreach ($errors->get('horas') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lhoras','Horas requeridas:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		200 {!! Form::radio('horas', '200') !!}
		300 {!! Form::radio('horas', '300') !!}
		500 {!! Form::radio('horas', '500') !!}
	</div>
</div>
