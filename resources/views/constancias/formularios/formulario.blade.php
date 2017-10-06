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
