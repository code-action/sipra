@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
    <div class="content-panel">

      <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-user"></i> Datos de proyecto de servicio social:</h4>
        <tr>
          <td>Nombre:</td>
          <td><b>{{$proy->titulo}}</b></td>
        </tr>
        <tr>
          <td>N° de estudiantes: {{$proy->cantidad}}</td>
          <?php use App\Enlace;
                use App\Estudiante;
          $carnes=Enlace::proyCarnes($proy->id);
           ?>
          <td>
            @if(count($carnes)==0)
              <a href="/sipra/public/enlace/create?id={{$proy->id}}"><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;">Agregar</span></a>
            @endif
            @foreach ($carnes as $c)
              <?php $est=Estudiante::nombreEstudiante($c->nf_carne);?>
              <p><b>{{$c->nf_carne.":  "}}
                &nbsp;&nbsp;
                @if($est!="NE")
                  {!!Form::open(['route'=>['enlace.destroy',$c->nf_carne],'method'=>'DELETE','class'=>'form-inline'])!!}
                  {{$est}}
                  &nbsp;&nbsp;
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
                  <a href="{{$cad}}"><span class="glyphicon glyphicon-plus" style="color: #37b6de; margin: 0px 5px 0px 0px;"> Agregar estudiante</span></a>
                @endif
              </b></p>
            @endforeach

          </td>
        </tr>
        <tr>
          <td>Año:</td>
          <td><b>{{$proy->anio}}</b>
      </td>
        </tr>
        <tr>
          <td>Fecha de creación:</td>
          <td><b>{{$proy->created_at->format('d-m-Y g:i:s a')}}</b></td>
        </tr>
        <tr>
          <td>Fecha de última edición:</td>
          <td><b>{{ $proy->updated_at->format('d-m-Y g:i:s a') }}</b></td>
        </tr>
      </table>
    </div>
  </div>
@stop
