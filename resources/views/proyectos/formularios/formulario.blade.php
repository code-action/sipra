<?php use App\User;?>
@if($bandera==1)
<input type="hidden" name="limite" id="limite" value="">
@else
	@php
		echo $limite=App\Carrera::find($proyecto->f_carrera)->horas;
	@endphp
	<input type="hidden" name="limite" id="limite" value={{$limite}}>
@endif
@foreach ($errors->get('titulo') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('ltitulo','Título:',['class'=>'col-sm-2 control-label'])!!}
	<div class="col-sm-9">
		{!!Form::textarea('titulo',null,['class'=>'form-control', 'placeholder'=>'Título del proyecto'])!!}
	</div>
</div>
@foreach ($errors->get('n_acuerdo') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lacuerdo','N° de acuerdo del plan:',['class'=>'col-sm-4 control-label'])!!}
	<div class="col-sm-7">
		{!!Form::text('n_acuerdo',null,['id'=>'mayuscula','class'=>'form-control', 'placeholder'=>'N° de acuerdo'])!!}
	</div>
</div>
@if($bandera!=1)
<?php $estudiantes=User::where('f_proyecto','=',$proyecto->id)->get();
			$cantidad=count($estudiantes);?>
@else
	<?php $cantidad=0;?>
@endif
			@if($cantidad==0)
@foreach ($errors->get('cantidad') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lCantidad','N° de estudiantes:',['class'=>'col-sm-4 control-label'])!!}
	<div class="col-sm-7">
		{!!Form::text('cantidad',null,['class'=>'form-control','onKeyPress' => 'return siNumeros( this, event,this.value);', 'placeholder'=>'#'])!!}
	</div>
</div>
	<input type="hidden" name="vc" value="si">
@else
	<input type="hidden" name="vc" value="no">
@endif
@foreach ($errors->get('f_carrera') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lcarrera','Carrera:',['class'=>'col-sm-4 control-label'])!!}
	<div class="col-sm-7">
		{!!Form::select('f_carrera',
          App\Carrera::arrayCarrera()
          ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left','id'=>'carrera'])!!}
	</div>
</div>
@foreach ($errors->get('horas') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lhoras','Horas del proyecto por estudiante:',['class'=>'col-sm-4 control-label'])!!}
	<div class="col-sm-7">
		@if(count($errors)>0 || $bandera==2)
		{!!Form::number('horas',null,['id'=>'horas','class'=>'form-control'])!!}
	@else
		{!!Form::number('horas',null,['id'=>'horas','class'=>'form-control', 'readonly'=>'readonly'])!!}
	@endif
	</div>
</div>
@foreach ($errors->get('anio') as $error)
	<div class="alert-d">
		{{$error}}
	</div>
@endforeach
<div class="form-group">
	{!!Form::label('lanio','Año:',['class'=>'col-sm-4 control-label'])!!}
	<div class="col-sm-7">
		<select class="form-control" name="anio">
			<option value='0'>[Seleccione una opción]</option>
			@if($bandera==1)
			@for($a=1991;$a<=date("Y");$a++)
				<option value='{{$a}}'>{{$a}}</option>
			@endfor
		@else
			@for($a=1991;$a<=date("Y");$a++)
				@if($proyecto->anio==$a)
				<option value='{{$a}}' selected>{{$a}}</option>
			@else
				<option value='{{$a}}'>{{$a}}</option>
			@endif

			@endfor
		@endif
		</select>
		</div>
</div>
