@extends('plantillas.menuc')
@section('contenidoPagina')
  @if($state == 1 || $state == null)
  <?php $cam = 0; ?>
@else
  <?php $cam = 1; ?>
@endif
			<div class="col-xs-9">
        <div class="content-panel">
      {!!Form::open(['route'=>'usuario.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}
        @if(!$cam)
          <h4><i class="fa fa-user"></i> Usuarios activos </h4>
        @else
          <h4><i class="fa fa-user"></i> Usuarios inactivos </h4>
        @endif
      {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
      {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
      {!! Form::close() !!}
      <br>

        <table class="table table-hover">
          <thead>
          <tr>
          @if(!$cam)
            <th><a href="/sipra/public/usuario/create"><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;">Nuevo</span></a></th>
          @else
            <th>Número</th>
          @endif
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Opciones</th>
          </tr>
          </thead>
          <?php
            $a=1;
          ?>
          @foreach ($usuarioAc as $usa)
            <tbody>
          <tr>
            <td>{{$a}}</td>
            <td>{{ucwords($usa->nombre)}}</td>
            <td>{{ucwords($usa->apellido)}}</td>
            <td>
              @if(!$cam)
                @include('usuarios.formularios.baja')
              @else
                @include('usuarios.formularios.alta')
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
            {!! str_replace ('/?', '?', $usuarioAc->appends(Request::only(['name','estado']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
