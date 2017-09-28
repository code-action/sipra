@extends('plantillas.menuc')
@section('contenidoPagina')
  @if($state == 1 || $state == null)
  <?php $cam = 0; ?>
@else
  <?php $cam = 1; ?>
@endif
			<div class="col-xs-9">
        <div class="content-panel">
      {!!Form::open(['route'=>'carrera.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}
        @if(!$cam)
          <h4><i class="fa fa-graduation-cap"></i> Carreras activas </h4>
        @else
          <h4><i class="fa fa-graduation-cap"></i> Carreras inactivas </h4>
          <input name="estado" type="hidden" value="0">
        @endif
      {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Carrera']) !!}
      {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
      {!! Form::close() !!}
      <br>

        <table class="table table-hover">
          <thead>
          <tr>
          @if(!$cam)
            <th><a href="/sipra/public/carrera/create"><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;">Nuevo</span></a></th>
          @else
            <th>Número</th>
          @endif
            <th>Código</th>
            <th>Carrera</th>
            <th>Opciones</th>
          </tr>
          </thead>
          <?php
            $a=1;
          ?>
          @foreach ($carreraAc as $ca)
            <tbody>
          <tr>
            <td>{{$a}}</td>
            <td>{{ucwords($ca->codigo)}}</td>
            <td>{{ucwords($ca->nombre)}}</td>
            <td>
              @if(!$cam)
                @include('carreras.formularios.baja')
              @else
                @include('carreras.formularios.alta')
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
            {!! str_replace ('/?', '?', $carreraAc->appends(Request::only(['nombre','estado']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
