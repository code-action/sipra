@extends('plantillas.menuc')
@section('contenidoPagina')

  <div class="col-xs-9">
    <div class="content-panel">
  {!!Form::open(['route'=>'documento.index','method'=>'GET','role'=>'search','autocomplete'=>'off','class'=>'form-inline'])!!}

      <h4><i class="fa fa-credit-card"></i>
        <?php use App\Tipo;
          $nomb=Tipo::nombreTipo($t);
         ?>
         Documentos:  <b>{{$nomb}}</b>
       </h4>

  {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre']) !!}
  {!! Form::submit('Buscar',['class'=>'btn btn-theme']) !!}
  {!! Form::close() !!}
  <br>
  <?php
    $cad='/sipra/public/documento/create?tipo=';
    $tip=(String)$t;
    $dir=$cad.$tip;
  ?>

    <table class="table table-hover">
      <thead>
      <tr>
        <th><a href='{{$dir}}'><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;">Nuevo</span></a></th>
        <th>Nombre</th>
        <th>Año</th>
        <th>Opciones</th>
      </tr>
      </thead>
      <?php
        $a=1;
      ?>
      @foreach ($documentos as $doc)
        <tbody>
      <tr>
        <td>{{$a}}</td>
        <td>{{$doc->nombre}}</td>
        <td>{{$doc->anio}}</td>
        <td>varias opciones</td>

      </tr>
      <?php
        $a=$a+1;
      ?>
      @endforeach
      <tbody>
    </table>
    <div id="act">
        {!! str_replace ('/?', '?', $documentos->appends(Request::only(['nombre']))->render ()) !!}
    </div>
    </div>
  </div>
@stop
