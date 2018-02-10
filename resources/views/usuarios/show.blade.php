@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
    <div class="content-panel">

      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-user"></i> Datos usuario: <b>{{$usuario->name}}</b></h4>
        <tr>
          <td>Nombre:</td>
          <td><b>{{ucwords($usuario->nombre)}}</b></td>
        </tr>
        <tr>
          <td>Apellido:</td>
          <td><b>{{ucwords($usuario->apellido)}}</b></td>
        </tr>
        <tr>
          <td>Tipo de usuario:</td>
          <td>
            <b>
            @if($usuario->tipo==1)
              Administrador
            @else
              Editor
            @endif
          </b>
          </td>
        </tr>
        <tr>
          <td>Correo:</td>
          <td><b>{{$usuario->email}}</b></td>
        </tr>
        <tr>
          <td>Estado:</td>
          <td>
            <b>
            @if($usuario->estado==1)
              Activo
            @else
              Inactivo
            @endif
          </b>
          </td>
        </tr>
        <tr>
          <td>Fecha de creación:</td>
          <td><b>{{$usuario->created_at->format('d-m-Y g:i:s a')}}</b></td>
        </tr>
        <tr>
          <td>Fecha de última edición:</td>
          <td><b>{{ $usuario->updated_at->format('d-m-Y g:i:s a') }}</b></td>
        </tr>
      </table>
      <a href={!! asset('/usuario?estado='.$usuario->estado) !!}><i class="fa fa-arrow-circle-left"></i> Usuarios</a>
    </div>
  </div>
@stop
