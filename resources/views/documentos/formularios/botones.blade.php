<?php use App\Documento;
$t=$t_doc;
?>
{!!Form::label('lplan',$a[$t_doc].':',['class'=>' col-sm-5 control-label'])!!}
<?php $doc=Documento::idTipoExiste($proy->id,$t_doc);
  $cad="/sipra/public/documento/create?id=".$proy->id;
?>
@if(count($doc)==0)<!-- Agregar-->
  <?php $cad=$cad."&tipo=".(String)$t;?>
  <a  class="btn btn-info btn-sm" href="{{$cad}}"><span class="fa fa-plus" style="color: white;"></a>
@else
  @foreach($doc as $p)
    {!!Form::open(['route'=>['documento.destroy',$p->id],'method'=>'DELETE','class'=>'form-inline'])!!}

    <!-- Ver-->
    <a  class="btn btn-success btn-sm" href="/sipra/public/enlace/{{(String)$p->id}}" target="_blank"><span class="fa fa-info-circle" style="color: white;"></a>
      &nbsp;&nbsp;
        <!-- Editar-->
    <a  class="btn btn-primary btn-sm" href="/sipra/public/documento/{{(String)$p->id}}/edit"><span class="fa fa-pencil" style="color: white;"></a>
    &nbsp;&nbsp;

    <button class="btn btn-danger btn-sm" type="button" onClick="return swal({
      title: '¿Desea eliminar el documento?',
      text: 'Ya no estara disponible !',   type: 'warning',
      showCancelButton: true,   confirmButtonColor: '#DD6B55',
      confirmButtonText: 'Si, eliminar!',
      cancelButtonText: 'No, Cancelar!',   closeOnConfirm: true,
      closeOnCancel: false }, function(isConfirm){
      if (isConfirm) { submit();
          swal('Deleted!', 'El Registro fue eliminado', 'success');
        } else {
      swal({   title: 'El Registro se mantiene',type:'info',
      text: 'Se Cerrará en 2 Segundos',   timer: 2000,
      showConfirmButton: false });} });"><i class="fa fa-trash-o "></i></button>
    {!!Form::close()!!}
  @endforeach
@endif
