<?php use App\Documento;
use App\User;
use App\Constancia;
$a[1]='Plan';
$a[2]='Acuerdo de plan';
$a[3]='Memoria';
$a[4]='Acuerdo de memoria';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

  <title>SIPRA - Unidad de Proyección Social</title>
  <!-- Bootstrap core CSS -->
  {!!Html::style('assets/css/bootstrap.css')!!}
  <!--external css-->
  {!!Html::style('assets/font-awesome/css/font-awesome.css')!!}

  <!-- Custom styles for this template -->
  {!!Html::style('assets/css/style.css')!!}
  {!!Html::style('assets/css/style-responsive.css')!!}
  {!!Html::style('assets/libreriaSweetAlert/sweet-alert.css')!!}

  {!!Html::script('assets/libreriaSweetAlert/sweet-alert.min.js')!!}
</head>
<body>
  @if(Session::has('mensaje'))

<?php $men=Session::pull('mensaje');
echo "<script>swal('$men', 'Click al botón!', 'success')</script>";?>
@endif

@if(Session::has('error'))

<?php $men=Session::pull('error');
echo "<script>swal('$men', 'Click al botón!', 'error')</script>";?>

@endif
  <section id="container" >
    <header class="header black-bg">
          <!--logo start-->
          <a href="#" class="logo"><b>Unidad de Proyección Social</b></a>
          <!--logo end-->
          <div class="top-menu">
            <ul class="nav pull-right top-menu">
                  <li><a class="logout" href='/sipra/public/logout'>Salir</a></li>
            </ul>
          </div>
      </header>
      <center>
        <section id="main-content" style="margin-left: 0px;">
        	<section class="wrapper">
            <div class="col-xs-9">
          		<div class="form-panel">
                <table class="table table-hover">
                  <thead>
                    <th>
                <center><h4><a href={!! asset('/ayudar2/4') !!} target="blank_" class="tooltips" data-placement="right" data-original-title="Ayuda"><i class="fa fa-file"></i></a> Documentos del proyecto: </h4></center>
                    </th>
                  </thead>

                  <tbody>
                    <tr><td>
                      <div class="form-group">{{$proy->titulo}}</div>
                    </td></tr>
                    <!--TODOS LOS DOCUMENTOS USAN EL MISMO FRAGMENTO Y CAMBIA EL TIPO DE ARCHIVO -->
                    <!--Plan de trabajo social--> <?php $t_doc= 1;?>
                    <tr><td>
                      @include('acceso.formularios.botones')
                    </td></tr>
                    <!-- Acuerdo de plan --> <?php $t_doc= 2;?>
                    <tr><td>
                      @include('acceso.formularios.botones')
                    </td></tr>
                    <!-- memoria --> <?php $t_doc= 3;?>
                    <tr><td>
                      @include('acceso.formularios.botones')
                    </td></tr>
                    <!-- Acuerdo de memoria --> <?php $t_doc= 4;?>
                    <tr><td>
                      @include('acceso.formularios.botones')
                    </td></tr>
                  </tbody>
                </table>
                @php
                $uniones=App\Union::where('f_proyecto','=',$proy->id)->get();
                @endphp
                @if(count($uniones)>0)
                <table class="table">
                  <thead>
                    <th colspan="2"><center><h4><i class="fa fa-graduation-cap"></i> Constancias de estudiantes: </h4></center></th>
                  </thead>
                  <tbody>
                      @foreach ($uniones as $union)
                        <tr><td style="width:10%;">{{$union->estudiante->name.": ".$union->estudiante->apellido.", ".$union->estudiante->nombre}}
                          </td>
                          <td style="width:10%;">
                            @php
                              $constancia=Constancia::where('f_estudiante','=',$union->estudiante->id)->get();
                              foreach ($constancia as $cons)
                                $co=$cons;
                            @endphp
                            @if(count($constancia)<1)
                            Constancia no agregada.
                          @else
                            <a  class="btn btn-success btn-sm" href="/sipra/public/ver2/{{(String)$co->id}}" target="_blank"><span class="fa fa-info-circle" style="color: white;"></a>
                          @endif
                          </td>
                          </tr>
                      @endforeach
                  </tbody>
                </table>
              @endif
              </div>
            </div>
      </section>
    </section>
      </center>
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  {!!Html::script('assets/js/jquery.js')!!}
  {!!Html::script('assets/js/bootstrap.min.js')!!}
  {!!Html::script('assets/js/jquery.dcjqaccordion.2.7.js')!!}
  {!!Html::script('assets/js/jquery.scrollTo.min.js')!!}
  {!!Html::script('assets/js/jquery.nicescroll.js')!!}
  {!!Html::script('assets/js/jquery.sparkline.js')!!}
  {!!Html::script('assets/js/funciones.js')!!}
  <!--Llamado a funciones de validación-->
  {!!Html::script('assets/js/validaciones.js')!!}

  <!--common script for all pages-->
  {!!Html::script('assets/js/common-scripts.js')!!}
  {!!Html::script('assets/js/gritter/js/jquery.gritter.js')!!}
  {!!Html::script('assets/js/gritter-conf.js')!!}

  <!--script for this page-->
  {!!Html::script('assets/js/sparkline-chart.js')!!}
  {!!Html::script('assets/js/zabuto_calendar.js')!!}
</body>
</html>
