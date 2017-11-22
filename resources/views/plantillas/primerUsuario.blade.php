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
  <section id="container" >
    <header class="header black-bg">
          <!--logo start-->
          <a href="#" class="logo"><b>Unidad de Proyección Social</b></a>
          <!--logo end-->
      </header>
      <center>
        <section id="main-content" style="margin-left: 0px;">
        	<section class="wrapper">
            <div class="row mt">
              <div class="col-xs-6">
            		<div class="form-panel">

            			{!!Form::open(['route'=>'auxiliar.store','method'=>'POST','class'=>'form-horizontal style-form','autocomplete'=>'off', 'role'=>'form'])!!}
            			<center><h4><i class="fa fa-user"></i> Primer usuario administrador</h4></center><hr>

            				<?php $bandera=1;
                          $primero=1;?>
            				@include('usuarios.formularios.formulario')
            				<input name="bandera" type="hidden" value="1">
                    <a class="btn btn-default" href="/sipra/public/usuario?estado=1">Cancelar</a>
            			{!!Form::submit('Registrar',['class'=>'btn btn-theme'])!!}
            			{!!Form::close()!!}

            		</div>
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
