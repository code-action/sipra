<?php use App\Tipo;
Tipo::llenarTabla();
 ?>
@extends('plantillas.marco')
@section('menu')
  <li class="sub-menu">
      <a href="/sipra/public/proyecto" >
          <i class="fa fa-folder-open"></i>
          <span>Proyectos</span>
      </a>
  </li>
  <li class="sub-menu">
      <a href="javascript:;" >
          <i class="fa fa-file-pdf-o"></i>
          <span>Documentos</span>
      </a>
      <?php
      $tipos=Tipo::orderBy('id')->get();
      $cad='/sipra/public/documento?tipo=';

      foreach ($tipos as  $tipo){
        $enlace=$cad.(String)$tipo['id'];
        ?>
        <ul class="sub">
          <li>
            <a  href="{{$enlace}}">
              <span>{{$tipo['nombre']}}</span>
            </a>
            </li>
        </ul>
        <?php
      }
     ?>
  </li>

  <li class="sub-menu">
      <a href="/sipra/public/estudiante" >
          <i class="fa fa-credit-card"></i>
          <span>Estudiantes</span>
      </a>
  </li>
  <li class="sub-menu">
      <a href="javascript:;" >
          <i class="fa fa-graduation-cap"></i>
          <span>Carreras</span>
      </a>
      <ul class="sub">
          <li><a  href="/sipra/public/carrera?estado=1">Activas</a></li>
      </ul>
      <ul class="sub">
          <li><a  href="/sipra/public/carrera?estado=0">Inactivas</a></li>
      </ul>
  </li>
<li class="sub-menu">
    <a href="javascript:;" >
        <i class="fa fa-user"></i>
        <span>Usuarios</span>
    </a>
    <ul class="sub">
        <li><a  href="/sipra/public/usuario?estado=1">Activos</a></li>
    </ul>
    <ul class="sub">
        <li><a  href="/sipra/public/usuario?estado=0">Inactivos</a></li>
    </ul>
</li>

<li class="sub-menu">
    <a href="/sipra/public/bitacora" >
        <i class="fa fa-eye"></i>
        <span>Bitacora</span>
    </a>
</li>
@endsection
