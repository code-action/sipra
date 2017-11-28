@php
  $sin=0;
  $medio=0;
  $completo=0;
@endphp
@extends('plantillas.menuc')
@section('contenidoPagina')
  <div class="col-xs-9">
    <div class="content-panel">
      {!!Html::image('assets/img/ups-logo.jpg','',array('class'=>'img-circle'))!!}
      <br>
    </div>

      <div class="showback">
      @php
        $proyectos=App\Proyecto::get(['id']);

      foreach ($proyectos as $proyecto){
          $conteo=App\Documento::contador($proyecto->id);
        if ($conteo==0){
          $sin=$sin+1;
          //echo "<a href='#'><div class='alert alert-danger'><b>No se encontró ningún documento en proyecto: </b>".$proyecto->titulo."</div></a>";
        }elseif($conteo<4){
          $medio=$medio+1;
          //echo "<a href='/sipra/public/enlace?doc=".$proyecto->id."'><div class='alert alert-warning'><b>No cuenta con todos los archivos completos: </b>".$proyecto->titulo."</div></a>";
        }elseif($conteo==4){
          $completo=$completo+1;
        }
      }
      @endphp
      <center><h3 style='color:green;'><i class="fa fa-file-pdf-o"></i> SIPRA-UPS</H3></center>
    @php
      if($sin>0){
        echo "<a href='/sipra/public/proyecto'><div class='alert alert-danger'>No se encontró ningún documento en <b>".$sin."</b> proyecto/s. </div></a>";
      }
      if($medio>0){
        echo "<a href='/sipra/public/proyecto'><div class='alert alert-warning'>Hay <b>".$medio."</b> proyecto/s que no tiene/n los documentos completos. </div></a>";
      }
      if($completo>0){
        echo "<a href='/sipra/public/proyecto'><div class='alert alert-success'>Hay <b>".$completo."</b> proyecto/s con los documentos completos. </div></a>";
      }
      @endphp
</div>
  </div>
@endsection
