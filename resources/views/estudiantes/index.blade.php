@extends('plantillas.menuc')
@section('contenidoPagina')
  @if($state == 1 || $state == null)
  <?php $cam = 0; ?>
@else
  <?php $cam = 1; ?>
@endif
			<div class="col-xs-9">
        <div class="content-panel">
      {!!Form::open(['route'=>'estudiante.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}
        @if(!$cam)
          <h4><i class="fa fa-credit-card"></i> Estudiantes activos </h4>
        @else
          <h4><i class="fa fa-credit-card"></i> Estudiantes inactivos </h4>
          <input name="estado" type="hidden" value="0">
        @endif
      {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
      {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
      {!! Form::close() !!}
      <br>

        <table class="table table-hover">
          <thead>
          <tr>
          @if(!$cam)
            <!--<th><a href="/sipra/public/estudiante/create"><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;">Nuevo</span></a></th>-->
          @else
            <!--<th>Número</th>-->
          @endif
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
          @foreach ($estudiantes as $st)
          <tr>
            <td>{{$a}}</td>
            <td>{{$st->carne}}</td>
            <td>{{$st->nombre}}</td>
            <td>{{$st->apellido}}</td>
            <td>
              @if(!$cam)
                @include('estudiantes.formularios.baja')
              @else
                @include('estudiantes.formularios.alta')
              @endif
            </td>
          </tr>
          <?php
            $a=$a+1;
          ?>
          @endforeach
          <tbody>
        </table>
        <div id="act">
            {!! str_replace ('/?', '?', $estudiantes->appends(Request::only(['nombre','estado']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
