{{--@if(Auth::check())--}}
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Unidad de Proyección Social</title>

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

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="#" class="logo"><b>Unidad de Proyección Social</b></a>
            <!--logo end-->
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href='/sipra/public/logout'>Salir</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="#">{!!Html::image('assets/img/ups-logo.jpg','',array('class'=>'img-circle','width'=>'60'))!!}</a></p>
              	  <h5 class="centered">SIPRA</h5>

                    @yield('menu')
                {{--  @endif--}}
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <center>
      <section id="main-content">
      	<section class="wrapper">
          <div class="row mt">
@yield('contenidoPagina')
      <!--footer start-->
    </div>
    </section>
  </section>
  </center>
      <!--footer end-->
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

	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>


  </body>
</html>
{{--@else
  <!DOCTYPE HTML>
  <html>
  <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="0;URL=/sipra/public">
  </head>
  <body>
  </body>
  </html>

@endif--}}
