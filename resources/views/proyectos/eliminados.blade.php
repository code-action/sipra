@extends('plantillas.menuc')
@section('contenidoPagina')
	<div class="col-xs-9">
		<div class="form-panel">

      {!!Form::open(['url'=>'proyecto/eliminar','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
			<center><h4><i class="fa fa-folder-open"></i> Eliminar estudiantes </h4></center><hr>
				<?php $bandera=3;?>
        <input name="idProy" type="hidden" value={{$idProy}}>
        <input name="bandera" id="bandera" type="hidden" value="3">
        <table class="table table-hover" id="borrador">
          <tr><th>Carné</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Comentario de eliminación</th>
          <th>Opción</th></tr>
          @foreach ($eliminados as $eliminado)
            @php
              $e=App\User::find($eliminado);
            @endphp
            <tr>
              <td>{{$e->name}}</td>
              <td>{{$e->nombre}}</td>
              <td>{{$e->apellido}}</td>
              <input type="hidden" name="id[]" value={{$e->id}}>
              <td style="width:50%"><input type="text" name="comentario[]" class="form-control"></td>
              <td>
                <div class="tooltips" data-placement="right" data-original-title="No eliminar">
                <button type='button' name='button' class='btn btn-xs btn-theme' id='salvar_estudiante'>
              <i class='fa fa-check'>
              </i>
                </div>
              </button></td>
            </tr>
          @endforeach
        </table>


      <a class="btn btn-default" href="/sipra/public/proyecto">Cancelar</a>

			{!!Form::submit('Eliminar',['class'=>'btn btn-theme'])!!}
			{!!Form::close()!!}

		</div>
	</div>
@stop
