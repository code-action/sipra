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
          <td><b>Nombre:</b></td>
          <td>{{$est->nombre}}</td>
        </tr>
        <tr>
          <td><b>Apellido:</b></td>
          <td>{{$est->apellido}}</td>
        </tr>
        <tr>
          <td><b>Carrera:</b></td>
          <td>{{App\User::carreraEstudiante($est->id)}}</td>
        </tr>
        <tr>
          <td><b>Fecha de creación:</b></td>
          <td>{{$est->created_at->format('d-m-Y g:i:s a')}}</td>
        </tr>
        <tr>
          <td><b>Fecha de última edición:</b></td>
          <td>{{ $est->updated_at->format('d-m-Y g:i:s a') }}</td>
        </tr>
      </table>
      <a href={!! asset('/estudiante') !!}><i class="fa fa-arrow-circle-left"></i> Estdudiantes</a>
    </div>
  </div>
@stop
