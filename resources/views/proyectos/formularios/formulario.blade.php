<?php use App\Enlace;?>
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
@if($bandera!=1)
<?php $enlaces=Enlace::where('f_proyecto','=',$proyecto->id)->get();
			$cantidad=count($enlaces);?>
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
				@if($proyecto->f_carrera==$c->id)
					<option value='{{$c->id}}' selected>{{$c->nombre}}</option>
				@else
				<option value='{{$c->id}}'>{{$c->nombre}}</option>
			@endif

			@endforeach
		@endif
		</select>
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
			@endif
				<option value='{{$a}}'>{{$a}}</option>
			@endfor
		@endif
		</select>
		</div>
</div>
