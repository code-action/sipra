
{!!Form::open(['route'=>['proyecto.destroy',$proy->id],'method'=>'DELETE','class'=>'form-inline'])!!}
@include('proyectos.formularios.botones')
&nbsp;&nbsp;
<button class="btn btn-danger btn-sm" type="button" onClick="return swal({
  title: '¿Esta seguro de eliminar?',
  text: 'Serán eliminados los documentos de este proyecto !',   type: 'warning',
  showCancelButton: true,   confirmButtonColor: '#DD6B55',
  confirmButtonText: 'Si, eliminar!',
  cancelButtonText: 'No, Cancelar!',   closeOnConfirm: true,
  closeOnCancel: false }, function(isConfirm){
  if (isConfirm) { submit();
      swal('Deleted!', 'El Registro enviado', 'success');
    } else {
  swal({   title: 'El Registro se mantiene',type:'info',
  text: 'Se Cerrará en 2 Segundos',   timer: 2000,
  showConfirmButton: false });} });"><i class="fa fa-trash-o "></i></button>
{!!Form::close()!!}
