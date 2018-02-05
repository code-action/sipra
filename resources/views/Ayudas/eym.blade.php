<!DOCTYPE html>
<html>
  <head>
    <title>Ayuda</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    {!!Html::style('assets/css/bootstrap.css')!!}
    <!-- Bootstrap core CSS -->
    {!!Html::style('assets/css/bootstrap.css')!!}

    <!--external css-->
    {!!Html::style('assets/font-awesome/css/font-awesome.css')!!}
    {!!Html::style('assets/css/zabuto_calendar.css')!!}
    {!!Html::style('assets/js/gritter/css/jquery.gritter.css')!!}
    {!!Html::style('assets/lineicons/style.css')!!}
    {!!Html::style('assets/libreriaSweetAlert/sweet-alert.css')!!}

    <!-- Custom styles for this template -->
    {!!Html::style('assets/css/style.css')!!}
    {!!Html::style('assets/css/style-responsive.css')!!}
    {!!Html::script('assets/js/chart-master/Chart.js')!!}
    {!!Html::script('assets/libreriaSweetAlert/sweet-alert.min.js')!!}
  </head>
  <body>
    <header class="header black-bg">
    <a href="#" class="logo"><b>Unidad de Proyección Social</b></a>
    <div class="top-menu">
      <ul class="nav pull-right top-menu">
            <li><a class="logout" onclick="window.close();">Cerrar</a></li>
      </ul>
    </div>
    </header>
    <center >
      <br>
      <br>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div>
    <div class="carousel-inner">
      @include('Ayudas.enlaces.a'.$n)
    </div>
  </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
</center>
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
        <script>
        $(document).ready(function(){
          $('.myCarousel').carousel()
        });
        </script>
  </body>
</html>
