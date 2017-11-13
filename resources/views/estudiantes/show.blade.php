@php
  use App\Estudiante;
@endphp
@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
    <div class="content-panel">

      <table class="table table-hover">
        <h4><i class="fa fa-book"></i> Datos estudiante carné: <b>{{$est->name}}</b></h4>
        <tr>
          <td>Nombre:</td>
          <td><b>{{$est->nombre}}</b></td>
        </tr>
        <tr>
          <td>Apellido:</td>
          <td><b>{{$est->apellido}}</b></td>
        </tr>
        <tr>
          <td>Carrera:</td>
          <td><b>{{App\User::carreraEstudiante($est->id)}}</b></td>
        </tr>
        <tr>
          <td>Fecha de creación:</td>
          <td><b>{{$est->created_at->format('d-m-Y g:i:s a')}}</b></td>
        </tr>
        <tr>
          <td>Fecha de última edición:</td>
          <td><b>{{ $est->updated_at->format('d-m-Y g:i:s a') }}</b></td>
        </tr>
      </table>
    </div>
  </div>
@stop
