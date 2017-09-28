@extends('plantillas.menuc')
@section('contenidoPagina')
  <!-- Recibe una variable $did que contiene el id de el último documento ingresado -->
  <div class="col-xs-6">
		<div class="form-panel">

  {!!Form::open(['route'=>'enlace.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
  <div id='otroB'>
  <center><h4><i class="fa fa-graduation-cap"></i> Carné de estudiantes que participan en el proyecto </h4></center><hr>
  <div class="form-group">
    {!!Form::label('lcarne','Nombre del proyecto:',['class'=>'col-sm-2 control-label'])!!}
    <div class="col-sm-9">
      {!!Form::textarea('titulo',$tit['titulo'],['class'=>'form-control','readonly' => 'readonly'])!!}
    </div>
  </div>

  <input name="cantidad" type="hidden" value='{{$tit['cantidad']}}'>
  <input name="id" type="hidden" value='{{$tit['id']}}'>
  @for($a=0;$a<$tit['cantidad'];$a++)
    <?php $valor='carne'.(String)$a;?>
    @foreach ($errors->get($valor) as $error)
    	<div class="alert-d">
    		<br>{{$error}}
    	</div>
    @endforeach
  <div class="form-group">
  	{!!Form::label('lcarne','Carné:',['class'=>'col-sm-2 control-label'])!!}
  	<div class="col-sm-9">
  		{!!Form::text('carne'.(String)$a,null,['class'=>'form-control','onKeyPress' => 'return cValido( this, event,this.value);', 'placeholder'=>'Número de carné'])!!}
  	</div>
  </div>
@endfor
</div>
    <a class="btn btn-default" href="/sipra/public/proyecto">Registrar en otro momento</a>
  {!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
  {!!Form::close()!!}

</div>
</div>
@stop
