<?php
$alert = '';
include "conexion4.php";
session_start();
$result       = 0;
$editar       = 0;
$userr        = $_SESSION['user'];
$fecha_actual = date("Y/m/d");

if (empty($_SESSION['idUser'])) {
    header('location: index.html');
} else {
    if (isset($_POST['insertaaa'])) {
        $usu_  = $_POST['Fecha'];
        $usu1_ = $_POST['Fecha1'];
         $usu2_ = $_POST['sec'];
        header("Location: ReporteContaPDF12.php?Combo_=$usu2_&%20Fecha_=$usu_&%20Fecha1_=" . urlencode($usu1_));
    }}
date_default_timezone_set('UTC');
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
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="./assets/css/util.css">

  <style type="text/css">
    #lateral { height: 757px; }

  </style>
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
         <form  method="POST" action="Planilla.php" >
         <center>
         <div class="form-row centro">
        <div class="form-group col-md-6">
         <label>Fecha Inicial </label>
      <?php $fcha = date("Y-m-01");?>

      <input type="date" class="form-control" name="Fecha" style="width: 200px" value="<?php echo $fcha; ?>" required>
                <div class="invalid-feedback">
                      Debe ingresar Fecha
                    </div>
        </div>

      <div class="form-group col-md-6">
      <label>Fecha Final </label>
      <?php $fcha1 = date("Y-m-t");?>

      <input type="date" class="form-control" name="Fecha1" style="width: 200px" value="<?php echo $fcha1; ?>" required>
                <div class="invalid-feedback">
                      Debe ingresar Fecha
                    </div>
      </div>

      </div>
      <div class="form-group">
        <label for="fecha2">Seleccione Una Opción:</label>
        <div class="">
         
      <select name="sec" id="sec" class="form-control selectpicker" >
      <?php
      $query="select codcdc_jor,nombre_jor from [CONTA ].dbo.p11";
      $resultadoos=sqlsrv_query($con,$query);
        while($Filas=sqlsrv_fetch_array($resultadoos)) {
        echo "<option value='".$Filas['codcdc_jor']."' >".$Filas['nombre_jor']."</option>";
        } 
      ?>
      </select>
        </div>
      </div> <div class="form-group centro">
        <div class="form-group margen">

          <input type="submit" id="click" name="insertaaa" class="btn btn-primary btn-lg" style="background-color: green;" value="Excel" >

        <br />
        </div>

      </div>

                </center>
                </form>
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