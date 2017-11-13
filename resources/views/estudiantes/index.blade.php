@extends('plantillas.menuc')
@section('contenidoPagina')
			<div class="col-xs-9">
        <div class="content-panel">
      {!!Form::open(['route'=>'estudiante.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}

          <h4><i class="fa fa-book"></i> Estudiantes</h4>

      {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
      {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
      {!! Form::close() !!}
      <br>

        <table class="table table-hover">
          <thead>
          <tr>
            <th>Número</th>
            <th>Carné</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Opciones</th>
          </tr>
          </thead>
          <?php
            $a=1;
          ?>
          <tbody>
					@if(count($estudiantes)>0)
          @foreach ($estudiantes as $st)
          <tr>
            <td>{{$a}}</td>
            <td>{{$st->name}}</td>
            <td>{{$st->nombre}}</td>
            <td>{{$st->apellido}}</td>
            <td>
                @include('estudiantes.formularios.botones')
            </td>
          </tr>
          <?php
            $a=$a+1;
          ?>
          @endforeach
				@else
					<tr>
								<td colspan="5">
									<center>
										No hay registros que coincidan con los términos de búsqueda indicados
									</center>
								</td>
							</tr>
				@endif
          <tbody>
        </table>
        <div id="act">
            {!! str_replace ('/?', '?', $estudiantes->appends(Request::only(['nombre']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
