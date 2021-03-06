@if (!Auth::check())
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

            {!!Form::open(['route'=>'loged.store','method'=>'POST','class'=>'form-login','autocomplete'=>'off'])!!}
            {{--  opacidad ,'style'=>'filter:alpha(opacity=30); opacity:0.8;'--}}
		        <h2 class="form-login-heading"><i class="fa fa-lock"></i> INICIAR SESIÓN</h2>
		        <div class="login-wrap">
		            {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre de usuario','autofocus'=>'autofocus'])!!}
		            <br>
                {!!Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña'])!!}
                <br>
                {!!Form::submit('Ingresar',['class'=>'btn btn-theme btn-block'])!!}
                <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> ¿Olvidó su contraseña?</a>

		                </span>
		            </label>
                <hr>
		            <div class="login-social-link centered">
		            <p>Otras páginas relacionadas</p>
		                <a class="btn btn-facebook btn-lg btn-block" href="https://www.facebook.com/Proyecci%C3%B3n-Socialfmp-Ues-138710453252253/?ref=br_rs" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>
                    <br>
                    <a class="btn btn-danger btn-lg btn-block" href="http://fmp.ues.edu.sv/ups/" target="_blank"><i class="fa fa-info"></i> UPS</a>
		            </div>
                <hr>
		        </div>
            {!!Form::close()!!}
          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              {!!Form::open(['url'=>'correo','method'=>'POST','autocomplete'=>'off'])!!}
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">¿Olvidó su contraseña?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Ingrese su correo para restablecer la contraseña.</p>
                          <input type="text" name="email" placeholder="Correo" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                          {!!Form::submit('Restablecer',['class'=>'btn btn-theme'])!!}
                      </div>
                  </div>
              </div>
              {!!Form::close()!!}
          </div>
          <!-- modal -->

	  	</div>

	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    {!!Html::script('assets/js/jquery.js')!!}
    {!!Html::script('assets/js/bootstrap.min.js')!!}
    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    {{-- {!!Html::script('assets/js/jquery.backstretch.min.js')!!}

    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script> --}}

  </body>
</html>
@else
  <!DOCTYPE html>
  <html>
    <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="refresh" content="0; URL=/sipra/public/inicio">
    </head>
    <body>
    </body>
  </html>
@endif
