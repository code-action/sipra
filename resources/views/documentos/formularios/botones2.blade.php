{!!Form::open(['route'=>['constancia.destroy',$constancia->id],'method'=>'DELETE','class'=>'form-inline'])!!}

<!-- Ver-->
<a  class="btn btn-success btn-sm" href="/sipra/public/constancia/{{(String)$constancia->id}}" target="_blank"><span class="fa fa-info-circle" style="color: white;"></a>
  &nbsp;&nbsp;
    <!-- Editar-->
<a  class="btn btn-primary btn-sm" href="/sipra/public/constancia/{{(String)$constancia->id}}-{{$proy->id}}/edit"><span class="fa fa-pencil" style="color: white;"></a>
&nbsp;&nbsp;

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
  showConfirmButton: false });} });"><i class="fa fa-trash-o "></i></button>
{!!Form::close()!!}
