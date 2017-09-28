<?php $cad='/sipra/public/proyecto/';
      $cad2='/sipra/public/enlace?doc=';
      $ver=$cad.(string)$proy->id;
      $editar=$cad.(string)$proy->id."/edit";
      $doc=$cad2.(string)$proy->id;

?>
<a class="btn btn-success btn-sm" href="{{$ver}}">
  <span class="fa fa-eye" style="color: white;"></span>
</a>
&nbsp;&nbsp;
<a class="btn btn-primary btn-sm" href="{{$editar}}">
  <span class="fa fa-pencil" style="color: white;"></span>
</a>
&nbsp;&nbsp;
<a class="btn btn-info btn-sm" href="{{$doc}}">
  <span class="fa fa-list" style="color: white;"></span>
</a>
