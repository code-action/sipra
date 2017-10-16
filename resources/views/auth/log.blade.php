<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">

            {!!Form::open(['route'=>'loged.index','method'=>'POST','class'=>'form-login','autocomplete'=>'off'])!!}
		        <h2 class="form-login-heading">ACCESO</h2>
		        <div class="login-wrap">
		            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre de usuario','autofocus'=>'autofocus'])!!}
		            <br>
                {!!Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña'])!!}
                <br>
                {!!Form::submit('Ingresar',['class'=>'btn btn-theme btn-block'])!!}
                <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> ¿Olvido su contraseña?</a>

		                </span>
		            </label>
                <hr>
		        </div>
            {!!Form::close()!!}

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-theme" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    {!!Html::script('assets/js/jquery.js')!!}
    {!!Html::script('assets/js/bootstrap.min.js')!!}

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    {!!Html::script('assets/js/jquery.backstretch.min.js')!!}

  </body>
</html>
