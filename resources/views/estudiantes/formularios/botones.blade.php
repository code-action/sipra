<?php use App\Enlace;
      $cad='/sipra/public/estudiante/';
      $ver=$cad.(string)$st->id;
      $editar=$cad.(string)$st->id."/edit";
      $id_p=$st->f_proyecto;
      $doc="/sipra/public/enlace?doc=".(string)$id_p;
?>
<a class="btn btn-success btn-sm" href="{{$ver}}">
  <span class="fa fa-info-circle" style="color: white;"></span>
</a>
&nbsp;&nbsp;
<a class="btn btn-primary btn-sm" href="{{$editar}}">
  <span class="fa fa-pencil" style="color: white;"></span>
</a>
&nbsp;&nbsp;
<a class="btn btn-info btn-sm" href="{{$doc}}">
  <span class="fa fa-list" style="color: white;"></span>
</a>
