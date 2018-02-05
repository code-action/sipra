@extends('plantillas.menuc')
@section('contenidoPagina')
			<div class="col-xs-9">
        <div class="content-panel">
					{!!Form::open(['route'=>'bitacora.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}

		          <h4><a href={!! asset('/ayudar/20') !!} target="blank_"><i class="fa fa-archive"></i></a> Bitácora de usuarios </h4>

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
					<tbody>
					@if (count($bitacoras)>0)


          @foreach ($bitacoras as $b)
          <tr>
            <td>{{$a}}</td>
            <td>{{$b->nombre." ".$b->apellido}}</td>
            <td>{{$b->detalle}}</td>
						<td style="width:20%;"><?php
			$fecha=$b->created_at;
			$aux1 = explode(' ', $fecha);
			$aux = explode('-', $aux1[0]);
			$fecha=$aux[2].'/'.$aux[1].'/'.$aux[0].' '.$aux1[1];
		?>
		{{$fecha}}</td>
          </tr>
          <?php
            $a=$a+1;
          ?>
          @endforeach
				@else
					<tr>
                <td colspan="4">
                  <center>
                    No hay registros que coincidan con los términos de búsqueda indicados
                  </center>
                </td>
              </tr>
				@endif
          <tbody>
        </table>
        <div id="act">
            {!! str_replace ('/?', '?', $bitacoras->appends(Request::only(['usuario']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
