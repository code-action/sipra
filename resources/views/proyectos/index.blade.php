@php
  use App\Carrera;
@endphp
@extends('plantillas.menuc')
@section('contenidoPagina')
<div class="col-xs-9">
  <div class="content-panel">
    {!!Form::open(['route'=>'proyecto.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline','id'=>'formulario'])!!}
      <h4><i class="fa fa-credit-card"></i> Proyectos registrados </h4>
            <div id="cambio">
              {!!Form::select('busqueda',['1'=>'Título','2'=>'Año','3'=>'carrera'],null, ['placeholder' => 'Buscar por...','class'=>'form-control','onChange'=>'cambioBuscar(this.value);'])!!}
              {!! Form::text('titulo',null,['class'=>'form-control','placeholder'=>'Título o año','style'=>'width:25%; display:inline','id'=>'titulo']) !!}
              {!!Form::select('titulodos',Carrera::arrayCarrera(),null, ['placeholder' => 'Seleccione una carrera...','class'=>'form-control','style'=>'width:25%; display:none','id'=>'titulodos'])!!}
    {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
            </div>

    {!! Form::close() !!}
    <br>

    <table class="table table-hover">
      <thead>
        <tr>
          <th><a href="/sipra/public/proyecto/create"><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;">Nuevo</span></a></th>
          <th>Título</th>
          <th>Año</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <?php
        $a=1;
      ?>
      <tbody>
        @foreach ($proyectos as $proy)
          <tr>
            <td>{{$a}}</td>
            <td >{{$proy->titulo}}</td>
            <td>{{$proy->anio}}</td>
            <td style="width:25%;">@include('proyectos.formularios.eliminar')</td>
          </tr>
          <?php
            $a=$a+1;
          ?>
        @endforeach
      </tbody>
    </table>
    <div id="act">
      {!! str_replace ('/?', '?', $proyectos->appends(Request::only(['titulo']))->render ()) !!}
    </div>
  </div>
</div>
@stop
