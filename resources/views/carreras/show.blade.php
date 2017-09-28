@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-6">
    <div class="content-panel">

      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-graduation-cap"></i> Datos carrera: <b>{{$ca->codigo}}</b></h4>
        <tr>
          <td>Nombre:</td>
          <td><b>{{ucwords($ca->nombre)}}</b></td>
        </tr>
        <tr>
          <td>Horas requeridas:</td>
          <td><b>{{$ca->horas}}</b></td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td>
            <b>
            @if($ca->estado==1)
              Activa
            @else
              Inactiva
            @endif
          </b>
          </td>
        </tr>
        <tr>
          <td>Fecha de creación:</td>
          <td><b>{{$ca->created_at->format('d-m-Y g:i:s a')}}</b></td>
        </tr>
        <tr>
          <td>Fecha de última edición:</td>
          <td><b>{{ $ca->updated_at->format('d-m-Y g:i:s a') }}</b></td>
        </tr>
      </table>
    </div>
  </div>
@stop
