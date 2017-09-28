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
              <p><b>{{$c->nf_carne.":"}}
                @if($est!="NE")
                  {{$est}}
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
