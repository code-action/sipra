<?php use App\Documento;
use App\User;
use App\Constancia;
$a[1]='Plan';
$a[2]='Acuerdo de plan';
$a[3]='Memoria';
$a[4]='Acuerdo de memoria';
?>
@extends('plantillas.menuc')
@section('contenidoPagina')
  <!-- Recibe una variable $did que contiene el id de el último documento ingresado -->
  <div class="col-xs-9">
		<div class="form-panel">
      <table class="table table-hover">
        <thead>
          <th>
      <center><h4><i class="fa fa-file"></i> Documentos del proyecto: </h4></center>
          </th>
        </thead>

        <tbody>
          <tr><td>
            <div class="form-group">{{$proy->titulo}}</div>
          </td></tr>
          <!--TODOS LOS DOCUMENTOS USAN EL MISMO FRAGMENTO Y CAMBIA EL TIPO DE ARCHIVO -->
          <!--Plan de trabajo social--> <?php $t_doc= 1;?>
          <tr><td>
            @include('documentos.formularios.botones')
          </td></tr>
          <!-- Acuerdo de plan --> <?php $t_doc= 2;?>
          <tr><td>
            @include('documentos.formularios.botones')
          </td></tr>
          <!-- memoria --> <?php $t_doc= 3;?>
          <tr><td>
            @include('documentos.formularios.botones')
          </td></tr>
          <!-- Acuerdo de memoria --> <?php $t_doc= 4;?>
          <tr><td>
            @include('documentos.formularios.botones')
          </td></tr>
        </tbody>
      </table>
      <table class="table">
        <thead>
          <th colspan="2"><center><h4><i class="fa fa-graduation-cap"></i> Constancias de estudiantes: </h4></center></th>
        </thead>
        <tbody>
          @php
            $estudiantes=User::where('f_proyecto','=',$proy->id)->get();
          @endphp
            @foreach ($estudiantes as $estudiante)
              <tr><td>{{$estudiante->name.": ".$estudiante->apellido.", ".$estudiante->nombre}}
                </td>
                <td>
                  @php
                    $constancia=Constancia::where('f_estudiante','=',$estudiante->id)->get();
                    foreach ($constancia as $cons)
                      $co=$cons;
                  @endphp
                  @if(count($constancia)<1)
                  <a  class="btn btn-info btn-sm" href="/sipra/public/constancia/create?id={{$estudiante->id}}"><span class="fa fa-plus" style="color: white;"></span></a>
                @else
                  @include('documentos.formularios.botones2')
                @endif
                </td>
                </tr>
            @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop
