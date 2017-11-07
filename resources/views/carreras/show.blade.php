@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
    <div class="content-panel">

      <table class="table table-hover">
        <h4><i class="fa fa-graduation-cap"></i> Datos carrera: <b>{{$ca->codigo}}</b></h4>
        <tr>
          <td><b>Nombre:</b></td>
          <td>{{ucwords($ca->nombre)}}</td>
        </tr>
        <tr>
          <td><b>Horas requeridas:</b></td>
          <td>{{$ca->horas}}</td>
        </tr>
        <tr>
          <td><b>Estado:</b></td>
          <td>
            @if($ca->estado==1)
              Activa
            @else
              Inactiva
            @endif
          </td>
        </tr>
        <tr>
          <td><b>Fecha de creación:</b></td>
          <td>{{$ca->created_at->format('d-m-Y g:i:s a')}}</td>
        </tr>
        <tr>
          <td><b>Fecha de última edición:</b></td>
          <td>{{ $ca->updated_at->format('d-m-Y g:i:s a') }}</td>
        </tr>
      </table>
    </div>
  </div>
@stop
