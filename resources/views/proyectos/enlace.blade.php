@extends('plantillas.menuc')
@section('contenidoPagina')
  <!-- Recibe una variable $did que contiene el id de el último documento ingresado -->
  <div class="col-xs-6">
		<div class="form-panel">

  {!!Form::open(['route'=>'enlace.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
  <div id='otroB'>
  <div class="form-group">
    {!!Form::label('lcarne','Nombre del proyecto:',['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-9">
      {{$tit['titulo']}}
    </div>
  </div>

  <input name="cantidad" type="hidden" value='{{$tit['cantidad']}}'>
  <input name="id" type="hidden" value='{{$tit['id']}}'>

  @for($a=0;$a<$tit['cantidad'];$a++)
    <?php $valor='carne'.(String)$a;
          $valorn='nombre'.(String)$a;
          $valora='apellido'.(String)$a;
    ?>
      @include('proyectos.formularios.enlaceform')
@endfor
</div>
    <a class="btn btn-default" href="/sipra/public/proyecto">Registrar en otro momento</a>
  {!!Form::submit('Continuar',['class'=>'btn btn-theme'])!!}
  {!!Form::close()!!}

</div>
</div>
@stop
