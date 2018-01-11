@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
    <div class="content-panel">

      <table class="table table-hover">
        <h4><i class="fa fa-user"></i> Datos de proyecto de servicio social:</h4>
        <tr>
          <td><b>Nombre:</b></td>
          <td>{{$proy->titulo}}</td>
        </tr>
        <tr>
          <td><b>N° de acuerdo del plan:</b></td>
          <td>{{$proy->n_acuerdo}}
      </td>
        </tr>
        <tr>
          <td><b>Estudiantes: {{$proy->cantidad}}</b></td>
          @php
            $uniones=App\Union::where('f_proyecto','=',$proy->id)->get();
          @endphp
          <td>
            @if(count($uniones)>0)
            @foreach ($uniones as $union)
              {{$union->estudiante->name.": ".$union->estudiante->nombre." ".$union->estudiante->apellido}}<br>
            @endforeach
          @else
            No se ha registrado ningún estudiante
          @endif
          </td>
        </tr>
        @php
          $comentarios=App\Comentario::where('f_proyecto',$proy->id)->get();
        @endphp
        @if (count($comentarios)>0)
        <tr>
          <td><b>Estudiantes eliminados:</b></td>
          <td>
            @foreach ($comentarios as $comentario)
              {{$comentario->estudiante." ".$comentario->comentario}}<br>
            @endforeach
          </td>
        </tr>
        @endif
        <tr>
          <td><b>Horas del proyecto por estudiante:</b></td>
          <td>{{$proy->horas}}
          </td>
        </tr>
        <tr>
          <td><b>Carrera:</b></td>
          <td>{{App\Carrera::nombreCarrera($proy->f_carrera)}}
      </td>
        </tr>
        <tr>
          <td><b>Año:</b></td>
          <td>{{$proy->anio}}
      </td>
        </tr>
        <tr>
          <td><b>Fecha de creación:</b></td>
          <td>{{$proy->created_at->format('d-m-Y g:i:s a')}}</td>
        </tr>
        <tr>
          <td><b>Fecha de última edición:</b></td>
          <td>{{ $proy->updated_at->format('d-m-Y g:i:s a') }}</td>
        </tr>
      </table>
    </div>
  </div>
@stop
