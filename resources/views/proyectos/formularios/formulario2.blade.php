<?php use App\User;?>
@if($bandera==1)
	<input type="hidden" name="limite" id="limite" value="">
@else
	@php
	echo $limite=App\Carrera::find($proyecto->f_carrera)->horas;
	@endphp
	<input type="hidden" name="limite" id="limite" value={{$limite}}>
@endif

<div id="morris">
	<div class="row mt">
		<div class="col-lg-6">
			<div class="content-panel">
				<div class="panel-body">
					<div id="hero-graph" class="graph">
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
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="content-panel">
				<div class="panel-body">
					<div id="hero-graph" class="graph">
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
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt">
		<div class="col-lg-6">
			<div class="content-panel">
				<div class="panel-body">
					<h5><i class="fa fa-book"></i> Estudiantes</h5>

					<div id="hero-area" class="graph">
						<div class="form-group">
							{!!Form::label('lcarne','Carné: ',['class'=>'col-sm-4 control-label'])!!}
							<div class="col-sm-7">
								{!!Form::text('t_carne',null,['id'=>'t_carne','class'=>'form-control', 'placeholder'=>'Carné'])!!}
							</div>
						</div>
						<div class="form-group">
							{!!Form::label('lnombre','Nombre: ',['class'=>'col-sm-4 control-label'])!!}
							<div class="col-sm-7">
								{!!Form::text('t_nombre',null,['id'=>'t_nombre','class'=>'form-control', 'placeholder'=>'Nombre'])!!}
							</div>
						</div>
						<div class="form-group">
							{!!Form::label('lapellido','Apellido: ',['class'=>'col-sm-4 control-label'])!!}
							<div class="col-sm-7">
								{!!Form::text('t_apellido',null,['id'=>'t_apellido','class'=>'form-control', 'placeholder'=>'Apellido'])!!}
							</div>
						</div>
						<a class="btn btn-default" id="limpiar">Limpiar</a>
						<a class="btn btn-default" id="agregar">Agregar</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="content-panel">
				<div class="panel-body">
					<div id="hero-donut" class="graph">
						<table class="table table-hover" id="tablaEstudiantes">
							<tr>
								<th>Carné</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Opción</th>
							</tr>
						</table>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
