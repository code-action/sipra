@if (Auth::user()->id!=$usa->id)
{!!Form::open(['route'=>['usuario.destroy',$usa->id],'method'=>'DELETE','class'=>'form-inline'])!!}
@include('usuarios.formularios.botones')
&nbsp;&nbsp;
<button class="btn btn-danger btn-sm" type="button" onClick="return swal({
  title: '¿Esta seguro enviar a inactivos?',
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
  showConfirmButton: false });} });"><i class="fa fa-times"></i></button>
{!!Form::close()!!}
@else
  @include('usuarios.formularios.botones')
  &nbsp;&nbsp;
  <button class="btn btn-danger btn-sm" type="button" onClick="swal('No puede dar de baja a su propio usuario', 'Click al botón!', 'error')">
    <i class="fa fa-times"></i>
  </button>
@endif
