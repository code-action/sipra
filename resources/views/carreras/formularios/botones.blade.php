<?php $cad='/sipra/public/carrera/';
      $ver=$cad.(string)$ca->id;
      $editar=$cad.(string)$ca->id."/edit";
?>
<a class="btn btn-success btn-sm" href="{{$ver}}">
  <span class="fa fa-eye" style="color: white;"></span>
</a>
&nbsp;&nbsp;
<a class="btn btn-primary btn-sm" href="{{$editar}}">
  <span class="fa fa-pencil" style="color: white;"></span>
</a>
