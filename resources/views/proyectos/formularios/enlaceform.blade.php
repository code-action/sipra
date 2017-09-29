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
