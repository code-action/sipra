@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
		<div class="form-panel">
      <table class="table table-hover">
        <thead>
          <th>
      <center><h4><a href={!! asset('/ayudar2/10') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-file"></i></a> Estudiante:{{" ".$est->nombre." ".$est->apellido}} </h4></center>
          </th>
        </thead>
        <tbody>
@foreach ($uniones as $union)
        <tr>
          <td>
            <a href="/sipra/public/accesoEstudiante/{{$union->proyecto->id}}">{{$union->proyecto->titulo}}</a>
          </td>
        </tr>
  @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop
