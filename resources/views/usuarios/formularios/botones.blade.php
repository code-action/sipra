
<?php $cad='/sipra/public/usuario/';
      $ver=$cad.(string)$usa->id;
      $editar=$cad.(string)$usa->id."/edit";
?>
<a class="btn btn-success btn-sm" href="{{$ver}}">
  <span class="fa fa-info-circle" style="color: white;"></span>
</a>
&nbsp;&nbsp;
<a class="btn btn-primary btn-sm" href="{{$editar}}">
  <span class="fa fa-pencil" style="color: white;"></span>
</a>
