@foreach ($errors->get('n_acuerdo') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
@if($t==4)
<div class="form-group">
	{!!Form::label('lacuerdo','N° de acuerdo:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::text('n_acuerdo',null,['class'=>'form-control', 'placeholder'=>'Título o número de acuerdo'])!!}
	</div>
</div>
@endif

@foreach ($errors->get('archivo') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('larchivo','Subir archivo:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
    {!!Form::file('archivo')!!}
	</div>
</div>
