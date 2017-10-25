@extends('plantillas.menuc')
@section('contenidoPagina')
			<div class="col-xs-9">
        <div class="content-panel">
					{!!Form::open(['route'=>'bitacora.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}

		          <h4><i class="fa fa-eye"></i> Bitácora de usuarios </h4>

		      {!! Form::text('usuario',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
		      {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
		      {!! Form::close() !!}
		      <br>
        <table class="table table-hover">
          <thead>
          <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Actividad</th>
            <th>Fecha</th>
          </tr>
          </thead>
          <?php
            $a=1;
          ?>
          @foreach ($bitacoras as $b)
            <tbody>
          <tr>
            <td>{{$a}}</td>
            <td>{{$usr->nombreUser($b->id_usuario)}}</td>
            <td>{{ucwords($b->detalle)}}</td>
            <td>{{$b->created_at->format('d-m-Y g:i:s a')}}</td>
          </tr>
          <?php
            $a=$a+1;
          ?>
          @endforeach
          <tbody>
        </table>
        <div id="act">
            {!! str_replace ('/?', '?', $bitacoras->appends(Request::only(['created_at']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
