@extends('plantillas.menuc')
@section('contenidoPagina')
			<div class="col-xs-9">
        <div class="content-panel">
					<div id="ocultar">
					{!!Form::open(['route'=>'bitacora.create','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}
		          <h4><i class="fa fa-eye"></i> Flitrar bitácora para impresión</h4>

		      {!! Form::text('usuario',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
		      {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
					<a onclick="
              var o = document.querySelector('#ocultar');
							var o2 = document.querySelector('#sidebar');
							var o3 = document.querySelector('#ocultar3');
              o.setAttribute('style','display:none');
							o2.setAttribute('style','display:none');
							o3.setAttribute('style','display:none');
              window.print();
              o.setAttribute('style','display:inline');
							o2.setAttribute('style','display:inline');
							o3.setAttribute('style','display:inline');
              " class="btn btn-primary btn-md" style="display:inline">
                <i class="fa fa-print"></i> Imprimir</a>
		      {!! Form::close() !!}
		      <br>

				</div>
				<table class="table table-hover">
				<thead>
				<tr>
					<th>#</th>
					<th>Usuario</th>
					<th>Actividad</th>
					<th>Fecha</th>
				</tr>
				</thead>
			</table>
        <table class="table table-hover">
          <?php
            $a=1;
          ?>
          @foreach ($bitacoras as $b)
            <tbody>
          <tr>
            <td>{{$a}}</td>
            <td>{{$b->name}}</td>
            <td>{{ucwords($b->detalle)}}</td>
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
          <tbody>
        </table>
        </div>
      </div>
@stop
