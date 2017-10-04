<?php
use App\Documento;
?>
@extends('plantillas.menuc')
@section('contenidoPagina')

  <div class="col-xs-9">
    <div class="content-panel">
  {!!Form::open(['route'=>'documento.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}

      <h4><i class="fa fa-credit-card"></i>
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
        <th>Año</th>
        <th>Opciones</th>
      </tr>
      </thead>
      <?php
        $a=1;
      ?>
      <tbody>
      @foreach ($proyectos as $proc)
        <?php
          $docs=Documento::idTipoExiste($proc->id,$tipo);
        ?>
        @if(count($docs)>0)
          @foreach ($docs as $doc)
      <tr>
        <td>{{$a}}</td>
        <td>{{$proc->titulo}}</td>
        <td>{{$proc->anio}}</td>
        <td><a  class="btn btn-success btn-sm" href="/sipra/public/enlace/{{(String)$doc->id}}" target="_blank"><span class="fa fa-eye" style="color: white;"></a></td>

      </tr>
      <?php
        $a=$a+1;
      ?>
      @endforeach
        @endif
      @endforeach
      <tbody>
    </table>
    <div id="act">
        {!! str_replace ('/?', '?', $proyectos->appends(Request::only(['titulo','tipo']))->render ()) !!}
    </div>
    </div>
  </div>
@stop
