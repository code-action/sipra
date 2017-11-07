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
          <?php use App\Enlace;
                use App\Estudiante;
                use App\Carrera;
          $carnes=Enlace::proyCarnes($proy->id);
          $conteo=count($carnes);
           ?>
          <td><b>N° de estudiantes:</b> {{$proy->cantidad}}
            @if($conteo!=0)
            <a href="/sipra/public/estudiante/create?id={{$proy->id}}">Agregar</a>
            @endif
          </td>

          <td>
            @if($conteo==0)
              <a href="/sipra/public/enlace/create?id={{$proy->id}}">Agregar</a>
            @endif
            @foreach ($carnes as $c)
              <?php $est=Estudiante::nombreEstudiante($c->nf_carne);?>
                @if($est!="NE")
                  {!!Form::open(['route'=>['enlace.destroy',$c->nf_carne],'method'=>'DELETE','class'=>'form-inline'])!!}
                  <div class="col-sm-9"><p>{{$c->nf_carne.":  "}}
                    &nbsp;&nbsp;
                  {{$est}}</div>
                  @if(count($carnes)>1)
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
                  @endif
                @else
                  <?php $cad='/sipra/public/estudiante/create?carne='.$c->nf_carne?>
                  <a href="{{$cad}}">Agregar estudiante</a>
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
