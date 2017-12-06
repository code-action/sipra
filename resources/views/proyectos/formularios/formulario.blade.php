<?php use App\User;?>
@if($bandera==1)
	<input type="hidden" name="limite" id="limite" value="">
@else
	@php
	$limite=App\Carrera::find($proyecto->f_carrera)->horas;
	@endphp
	<input type="hidden" name="limite" id="limite" value={{$limite}}>
@endif
<div id="morris">
	<div class="row mt">
		<div class="col-lg-6">
			<div class="content-panel">
				<div class="panel-body">
					<div id="hero-graph" class="graph">
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
						<div class="form-group">
							{!!Form::label('lacuerdo','N° de acuerdo del plan:',['class'=>'col-sm-4 control-label'])!!}
							<div class="col-sm-7">
								{!!Form::text('n_acuerdo',null,['id'=>'mayuscula','class'=>'form-control', 'placeholder'=>'N° de acuerdo'])!!}
							</div>
						</div>
						<div class="form-group">
							{!!Form::label('lcarrera','Carrera:',['class'=>'col-sm-4 control-label'])!!}
							<div class="col-sm-7">
								{!!Form::select('f_carrera',
						          App\Carrera::arrayCarrera()
						          ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left','id'=>'carrera'])!!}
							</div>
						</div>
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
						<div class="form-group">
							{!!Form::label('lanio','Año:',['class'=>'col-sm-4 control-label'])!!}
							<div class="col-sm-7">
								{!!Form::select('anio',
						          App\Proyecto::arrayAnio()
						          ,null, ['placeholder' => 'Seleccione una opción','class'=>'form-control has-feedback-left','id'=>'carrera'])!!}
							</div>
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
					<input type="hidden" id='auxiliar' value=""/>
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
						<a class="btn btn-info" id="limpiar">Limpiar</a>
						<a class="btn btn-info" id="agregar">Agregar</a>
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
							@if(isset($carne))
								@for ($i=0; $i < count($carne); $i++)
									<tr>
										<td>{{$carne[$i]}}</td>
										<td>{{$nombre[$i]}}</td>
										<td>{{$apellido[$i]}}</td>
										<td><input type='hidden' name='id[]' value={{$id[$i]}}>
				            <input type='hidden' name='carne[]' value={{$carne[$i]}}>
				            <input type='hidden' name='nombre[]' value={{$nombre[$i]}}>
				            <input type='hidden' name='apellido[]' value={{$apellido[$i]}}>
				            <button type='button' name='button' class='btn btn-xs btn-danger' id='eliminar_estudiante'>
				            <i class='fa fa-trash-o'></i>
				            </button>
				            </td>
									</tr>
									<input type='hidden' id={{"ya_agregados".$i}} value ={{$carne[$i]}}>
              		@php
                		$conteo=$i;
              		@endphp
								@endfor
								<input type='hidden' id='contador' value ={{$conteo}}>
							@endif
							{{-- Editado y no errores --}}
							@if (isset($proyecto))
								@php
									$uniones = $proyecto->uniones;
									$i=0;
									$conteo=0;
								@endphp
								@foreach ($uniones as $key => $union)
									<tr><td>{{$union->estudiante->name}}</td>
											<td>{{$union->estudiante->nombre}}</td>
											<td>{{$union->estudiante->apellido}}</td>
											<td><input type='hidden' name='id[]' value={{$union->estudiante->id}}>
					            <input type='hidden' name='carne[]' value={{$union->estudiante->name}}>
					            <input type='hidden' name='nombre[]' value={{$union->estudiante->nombre}}>
					            <input type='hidden' name='apellido[]' value={{$union->estudiante->apellido}}>
					            <button type='button' name='button' class='btn btn-xs btn-danger' id='eliminar_estudiante'>
					            <i class='fa fa-trash-o'></i>
					            </button>
					            </td>
								</tr>
								<input type='hidden' id={{"ya_agregados".$i}} value ={{$union->estudiante->name}}>
								@php
									$conteo=$i;
									$i++;
								@endphp
								@endforeach
								<input type='hidden' id='contador' value ={{$conteo}}>
							@endif
						</table>
						<div id="eliminados"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
