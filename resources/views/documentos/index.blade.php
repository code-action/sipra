<?php
use App\Documento;
?>
@extends('plantillas.menuc')
@section('contenidoPagina')

  <div class="col-xs-9">
    <div class="content-panel">
  {!!Form::open(['route'=>'documento.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}

      <h4><a href={!! asset('/ayudar/5') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-file"></i></a>
        <?php use App\Tipo;
          $nomb=Tipo::nombreTipo($tipo);
         ?>
         Documentos:  <b>{{$nomb}}</b>
       </h4>

  {!! Form::text('titulo',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
  <input type="hidden" name="tipo" value="{{$tipo}}">
  {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
  {!! Form::close() !!}
  <br>
  <?php
    $cad='/sipra/public/documento/create?tipo=';
    $tip=(String)$tipo;
    $dir=$cad.$tip;
  ?>
    <table class="table table-hover">
      <thead>
      <tr>
        <th>N°</th>
        <th>Nombre</th>
        @if ($tipo==4)
          <th>N° de acuerdo</th>
        @endif
        <th>Año</th>
        <th>Opciones</th>
      </tr>
      </thead>
      <?php
        $a=1;
      ?>
      <tbody>
      @if(count($proyectos)>0)
      @foreach ($proyectos as $proc)
      <tr>
        <td>{{$a}}</td>
        <td>{{$proc->titulo}}</td>
        @if ($tipo==4)
          <td style="width:20%;">{{$proc->n_acuerdo}}</td>
        @endif
        <td>{{$proc->anio}}</td>
        <td><a  class="btn btn-success btn-sm" href="/sipra/public/enlace/{{(String)$proc->id}}" target="_blank"><span class="fa fa-info-circle" style="color: white;"></a></td>

      </tr>
      <?php
        $a=$a+1;
      ?>
      @endforeach
    @else
      <tr>
        @if ($tipo==4)
          <td colspan="5">
          @else
            <td colspan="4">
        @endif
              <center>
                No hay registros que coincidan con los términos de búsqueda indicados
              </center>
            </td>
          </tr>
    @endif
      <tbody>
    </table>
    <div id="act">
        {!! str_replace ('/?', '?', $proyectos->appends(Request::only(['titulo','tipo']))->render ()) !!}
    </div>
    </div>
  </div>
@stop
