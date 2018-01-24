@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
		<div class="form-panel">
      <table class="table table-hover">
        <thead>
          <th>
      <center><h4><i class="fa fa-file"></i> Estudiante:{{" ".$est->nombre." ".$est->apellido}} </h4></center>
          </th>
        </thead>
        <tbody>
@foreach ($uniones as $union)
        <tr>
          <td>
            <a href="/sipra/public/enlace?doc={{$union->proyecto->id}}">{{$union->proyecto->titulo}}</a>
          </td>
        </tr>
  @endforeach
        </tbody>
      </table>
    </div>
  </div>
@stop
