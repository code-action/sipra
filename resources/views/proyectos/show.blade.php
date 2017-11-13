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
          <?php use App\User;
                use App\Carrera;
          $estudiantes=User::where('f_proyecto','=',$proy->id)->get();
          $conteo=count($estudiantes);
           ?>
          <td><b>N° de estudiantes:{{$proy->cantidad}}</b>
            @if($conteo!=0)
            <br>
            <a href="/sipra/public/estudiante/create?id={{$proy->id}}" class="btn btn-info"><i class="fa fa-plus"></i></a>
            @endif
          </td>

          <td>
            @if($conteo==0)
              <a href="/sipra/public/enlace/create?id={{$proy->id}}">Agregar datos de estudiante/s</a>
            @endif
            @foreach ($estudiantes as $est)
              <?php $nombre=$est->apellido.", ".$est->nombre;?>
                  @if($conteo>1)
                  {!!Form::open(['route'=>['enlace.destroy',$est->id],'method'=>'DELETE','class'=>'form-inline'])!!}
                  <div class="col-sm-9"><p>{{$est->name.":  "}}
                    &nbsp;&nbsp;
                  {{$nombre}}</div>
                  <button class="btn btn-danger btn-sm" type="button" onClick="return swal({
                    title: '¿Desea eliminar el documento?',
                    text: 'Ya no estara disponible !',   type: 'warning',
                    showCancelButton: true,   confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Si, enviar!',
                    cancelButtonText: 'No, Cancelar!',   closeOnConfirm: true,
                    closeOnCancel: false }, function(isConfirm){
                    if (isConfirm) { submit();
                        swal('Deleted!', 'El Registro enviado', 'success');
                      } else {
                    swal({   title: 'El Registro se mantiene',type:'info',
                    text: 'Se Cerrará en 2 Segundos',   timer: 2000,
                    showConfirmButton: false });} });"><i class="fa fa-minus-circle "></i></button>
                    {!!Form::close()!!}
                  @else
                    {{$nombre}}
                  @endif
              </p>
            @endforeach

          </td>
        </tr>
        <tr>
          <td><b>Carrera:</b></td>
          <td>{{Carrera::nombreCarrera($proy->f_carrera)}}
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
