<?php
$alert = '';
include "conexion.php";
session_start();
$result       = 0;
$editar       = 0;
$userr        = $_SESSION['user'];
$fecha_actual = date("Y/m/d");
date_default_timezone_set('UTC');
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
} else{


      $fecha01_ = $_REQUEST['fecha01'];
      $fecha02_ = $_REQUEST['fecha02'];
      $fecha1= new DateTime("$fecha01_");
      $fecha2= new DateTime("$fecha02_");
      $t_banrural = 0;
      $t_t_banrural = 0;
      $t_gyt = 0;
      $t_boleta = 0;
      $t_tarjeta = 0;
      $t_web = 0;
      $t_total = 0;
      $fechaa_ = $fecha1->format('d-m-Y');
        $fechaa2_ = $fecha2->format('d-m-Y');
      
        $fecha_ = $fecha1->format('Y-m-d');
        $fecha2_ = $fecha2->format('Y-m-d');
        $banrural = "SELECT sum(HABER) as banrural from ecuenta where dia_fecha between '$fecha_'  and '$fecha2_' and usuario = 'Banrural'";
        $GyT = "SELECT sum(HABER) as gyt from ecuenta where dia_fecha between '$fecha_' and '$fecha2_' and (USUARIO like '%GyT%' or USUARIO like '%Gyt%')";
        $boleta = "SELECT SUM(det_Importe) as boleta from pdv_DetalleFormaPago where det_FechaDocumento  between '$fecha_' and '$fecha2_' and tip_id = 2";
        $tarjeta = "SELECT SUM(det_Importe) as tarjeta from pdv_DetalleFormaPago where det_FechaDocumento between '$fecha_' and '$fecha2_' and tip_id = 4";
        $web = "SELECT sum(HABER) as web from ecuenta where cast(dia_fecha as date) between '$fecha_'  and '$fecha2_' and usuario = 'usuarioweb'";

        $ejebanrural = sqlsrv_query($con, $banrural);
        $ejeGyT = sqlsrv_query($con, $GyT);
        $ejeboleta = sqlsrv_query($con, $boleta);
        $ejetarjeta = sqlsrv_query($con, $tarjeta);
        $eweb = sqlsrv_query($con, $web);
       
        while($fila = sqlsrv_fetch_array($ejebanrural)){
          $banrural = $fila['banrural'];        }
        while($fila = sqlsrv_fetch_array($ejeGyT)){
          $GyT = $fila['gyt'];              }
        while($fila = sqlsrv_fetch_array($ejeboleta)){
          $boleta = $fila['boleta'];          }
        while($fila = sqlsrv_fetch_array($ejetarjeta)){
          $tarjeta = $fila['tarjeta'];        }
        while($fila = sqlsrv_fetch_array($eweb)){
          $web = $fila['web'];        } 
        $banruraltot = $banrural + $boleta;
        $totaltotal = $banruraltot + $GyT + $tarjeta + $web;
        $t_banrural = $t_banrural + $banrural;
        $t_gyt = $t_gyt + $GyT;
        $t_t_banrural = $t_t_banrural + $banruraltot;
        $t_boleta = $t_boleta + $boleta;
        $t_tarjeta = $t_tarjeta + $tarjeta;
        $t_web = $t_web + $web;
        $t_total = $t_total + $totaltotal;

        //$t_web_=str_replace(',', '', $t_web);
      
      $porcdentaje1=($t_banrural*100)/$t_total;
      $porcdentaje2=($t_boleta*100)/$t_total;
      $porcdentaje3=($t_gyt*100)/$t_total;
      $porcdentaje4=($t_tarjeta*100)/$t_total;
      $porcdentaje5=($t_web*100)/$t_total; 
 


}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logoo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>
    Contabilidad Sascim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <style type="text/css">
    #lateral { height: 750px; }  


  </style>
  <style type="text/css">
     * {
        margin:0px;
        padding:0px;
      }
      ul, ol {
        list-style:none;
      }
      .nav li a {
        background-color:gray;
        color:#fff;
        text-decoration:none;
        padding:10px 12px;
        display:block;
      }
      .nav li a:hover {
        background-color:#434343;
      }
      .nav li ul {
        display:none;
        min-width:140px;
      }
      .nav li:hover > ul {
        display:block;
      }
    </style>
     <style type="text/css">
      #lateral { height: auto; }
    </style>
 <!--**********************************************************************************************-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      $var=10;
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Banrural Carga',<?php echo $t_banrural; ?>],
          ['Banrural Depósitos',<?php echo $t_boleta; ?>],
          ['G y T Carga',  <?php echo $t_gyt; ?>],
          ['Visanet', <?php echo $t_tarjeta; ?>],
          ['Web',    <?php echo $t_web; ?>]
        ]);

        var options = {
         // title: 'Ingresos Por Dia',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  
  <!--*************************************************************************************************-->

<!-- Styles -->
<style>
#chartdiv2 {
  width: 100%;
  height: 500px;
}

</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv2", am4charts.XYChart3D);

// Add data
chart.data = [{
  "country": "Banrural Carga \n <?php echo(number_format($porcdentaje1,2)) ?>%",
 "visits": <?php echo $t_banrural;?>
}, {
 "country": "Banrural Depósitos \n <?php echo(number_format($porcdentaje2,2)) ?>%",
 "visits": <?php echo $t_boleta; ?>
}, {
 "country": "GyT \n <?php echo(number_format($porcdentaje3,2)) ?>%",
 "visits": <?php echo $t_gyt; ?>
}, {
 "country": "Visanet \n <?php echo(number_format($porcdentaje4,2)) ?>%",
 "visits": <?php echo $t_tarjeta; ?>
}, {
 
 "country": "Web \n <?php echo(number_format($porcdentaje5,2)) ?>%",
 "visits": <?php echo $t_web;?>
}];

// Create axes
let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.renderer.labels.template.rotation = 270;
categoryAxis.renderer.labels.template.hideOversized = false;
categoryAxis.renderer.minGridDistance = 20;
categoryAxis.renderer.labels.template.horizontalCenter = "right";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.tooltip.label.rotation = 270;
categoryAxis.tooltip.label.horizontalCenter = "right";
categoryAxis.tooltip.label.verticalCenter = "middle";

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "<?php echo $fecha_.'  A  '.$fecha2_; ?>";
valueAxis.title.fontWeight = "bold";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries3D());
series.dataFields.valueY = "visits";
series.dataFields.categoryX = "country";
series.name = "Visits";
series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
series.columns.template.fillOpacity = .8;

var columnTemplate = series.columns.template;
columnTemplate.strokeWidth = 2;
columnTemplate.strokeOpacity = 1;
columnTemplate.stroke = am4core.color("#FFFFFF");

columnTemplate.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

columnTemplate.adapter.add("stroke", function(stroke, target) {
  return chart.colors.getIndex(target.dataItem.index);
})

chart.cursor = new am4charts.XYCursor();
chart.cursor.lineX.strokeOpacity = 0;
chart.cursor.lineY.strokeOpacity = 0;

}); // end am4core.ready()
</script>
<!--*************************************************************************************************-->
<script language="Javascript">
  function imprSelec(nombre) {
    var ficha = document.getElementById(nombre);
    
    var ventimp = window.open('', 'popimpr');
    
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
  }
  </script>
    <script> 
        function printDiv() { 
            var divContents = document.getElementById("chartdiv2").innerHTML; 
            var a = window.open('', 'popimpr'); 
            a.document.write('<html>'); 
            a.document.write('<body > <h1>Div contents are <br>'); 
            a.document.write(divContents); 
            a.document.write('</body></html>'); 
            a.document.close(); 
            a.print(); 
        } 
    </script>

<!--*************************************************************************************************-->

</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <i><img src="assets/img/logoo.png"></i>

        </a>
        <a href="#" class="simple-text logo-normal">
          Sascim
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">

        <ul class="nav">
          <?php

include "ListadoMenu.php";

?>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="Principal.php">Principal</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>

            </form>
            <ul class="navbar-nav">


              <li class="nav-item">
                <a class="nav-link" href="">
                  <span><img src="assets/img/usuario.ico"></span>
                  <?php echo $userr ?>
                  <p>
                    <span class="d-lg-none d-md-block">Perfil</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
        <div class="panel-header panel-header-lg1" id="lateral">
    <div class="container container-form-lg">
         <center>
        <div style="background-color: white">
        <h1>Graficas De Ingresos Por Dia</h1>
        <h3><?php echo $fechaa_.'  A  '.$fechaa2_; ?></h3>
        <div id="tema">
        <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
        <label><?php echo $fechaa_.'  A  '.$fechaa2_; ?></label><br></div>
        <a href="javascript:imprSelec('tema')" >Imprimir Grafica</a>
      
      <div id="chartdiv2"></div>
      <a href="javascript:imprSelec('chartdiv2')" >Imprimir Grafica</a>
       <!--<a href="javascript:printDiv()" >Imprimir Grafica2</a>
      <div id="chartdiv"></div>--></div>
      </center>
      </div>



    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
   <script src="./assets/js/main.js"></script>
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/tilt/tilt.jquery.min.js"></script>

  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>


  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>