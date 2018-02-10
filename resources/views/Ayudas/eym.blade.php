<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Ejemplo jQuery slider de imágenes - EjemploCodigo</title>
{!!Html::style('assets/css/bootstrap.css')!!}
<!-- Bootstrap core CSS -->
{!!Html::style('assets/css/bootstrap.css')!!}

<!--external css-->
{!!Html::style('assets/font-awesome/css/font-awesome.css')!!}
{!!Html::style('assets/css/zabuto_calendar.css')!!}
{!!Html::style('assets/js/gritter/css/jquery.gritter.css')!!}
{!!Html::style('assets/lineicons/style.css')!!}

<!-- Custom styles for this template -->
{!!Html::style('assets/css/style.css')!!}
{!!Html::style('assets/css/style-responsive.css')!!}
{!!Html::script('assets/js/chart-master/Chart.js')!!}
{!!Html::style('assets/css/flexslider.css')!!}

</head>
<body>
        <!-- Cabecera -->
        <header class="header black-bg">
        <a href="#" class="logo"><b>Unidad de Proyección Social</b></a>
        <div class="top-menu">
          <ul class="nav pull-right top-menu">
                <li><a class="logout" onclick="window.close();">Cerrar</a></li>
          </ul>
        </div>
        </header>

        <!-- Contenido -->
        <section>
          <div style="min-height:50px;"></div>

          <center>
			<div class="flexslider">
			  <ul class="slides">
				@include('Ayudas.enlaces.a'.$n)
			  </ul>
			</div>
    </center>


        </section>

		<!-- jQuery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>


		<!-- FlexSlider -->
	{!!Html::script('assets/css/jquery.flexslider.js')!!}

		<script>
		$(window).load(function() {
		  $('.flexslider').flexslider({
			animation: "slide",
		  });
		});
		</script>
</body>
</html>
