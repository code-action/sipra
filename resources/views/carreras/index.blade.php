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
          <h4><a href={!! asset('/ayudar/11') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-graduation-cap"></i></a> Carreras activas </h4>
        @else
          <h4><a href={!! asset('/ayudar/12') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-graduation-cap"></i></a> Carreras inactivas </h4>
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
            <th><a href="/sipra/public/carrera/create">Nuevo</a></th>
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
          <tbody>
            @if(count($carreraAc)>0)
          @foreach ($carreraAc as $ca)
          <tr>
            <td>{{$a}}</td>
            <td>{{ucwords($ca->codigo)}}</td>
            <td>{{ucwords($ca->nombre)}}</td>
            <td style="width:25%;">
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
            {!! str_replace ('/?', '?', $carreraAc->appends(Request::only(['nombre','estado']))->render ()) !!}
        </div>
        </div>
      </div>
@stop
