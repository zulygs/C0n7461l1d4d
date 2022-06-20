<?php
$alert = '';

include "conexion.php";
session_start();
$result       = 0;
$editar       = 0;
$mostrar=0;
$cantot=0;
$sumtota=0;
$sumtota=0;
$total_=0;
$total2_=0;
$total3_=0;
$total4_=0;
$suma4_=0;
$suma3_=0;
$suma2_=0;

$suma_=0;
$suma5_=0;
$suma6_=0;
$suma7_=0;
$suma8_=0;
$Mostrar=0;
$total5_=0;
$total6_=0;
$total7_=0;
$total8_=0;
$userr        = $_SESSION['user'];
$fecha_actual = date("Y/m/d");

if (empty($_SESSION['idUser'])) {
    header('location: index.html');
} else {
    if (isset($_POST['inserta'])) {
        $usu_  = $_POST['Fecha'];
        $usu1_ = $_POST['Fecha1'];
        header("Location: ReporteContaPDF10.php?Fecha_=$usu_&%20Fecha1_=" . urlencode($usu1_));
    }else if (isset($_POST['inserta2'])) {
      $usu_  = $_POST['Fecha'];
        $usu1_ = $_POST['Fecha1'];
    header("Location: Resumen.php?Mostrar=1&%20Fecha_=$usu_&%20Fecha1_=" . urlencode($usu1_));

      $mostrar=1;
    }}

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
         <form  method="POST" action="Resumen.php" >
         <center>
         <div class="form-row centro">
        <div class="form-group col-md-6">
         <label>Fecha Inicial </label>
      <?php $fcha = date("Y-m-d");?>

      <input type="date" class="form-control" name="Fecha" style="width: 200px" value="<?php echo $fcha; ?>" required>
                <div class="invalid-feedback">
                      Debe ingresar Fecha
                    </div>
        </div>

      <div class="form-group col-md-6">
      <label>Fecha Final </label>
      <?php $fcha1 = date("Y-m-d");?>

      <input type="date" class="form-control" name="Fecha1" style="width: 200px" value="<?php echo $fcha1; ?>" required>
                <div class="invalid-feedback">
                      Debe ingresar Fecha
                    </div>
      </div>
      </div> <div class="form-group centro">
        <div class="form-group margen">

          <input type="submit" id="click" name="inserta" class="btn btn-primary btn-lg" style="background-color: green;" value="Excel" >
          <input type="submit" id="click" name="inserta2" class="btn btn-primary btn-lg"  value="Ver Consulta" >


        <br />
        </div>
         </div>
           <div class="panel-header panel-header-lg1 centro" id="lateral">
        
        
  <div class="container container-form-lg col-md-8 " id="div1">
 
<?php if (@$_REQUEST['Mostrar']==1) {?>
 

<table class="table  table-responsive table-hover table-striped">

    <center><tr align="center">
      <td >Agencia</td>
      <td>Cantidad</td>
      <td>Total</td>
      <td>Cantidad NC</td>

      <td>Total NC</td>

    </tr></center>
    <?php
      $Fecha  = $_REQUEST["Fecha_"];
      $Fechaa = $_REQUEST["Fecha1_"];
/* resumen agencia sankris mall (2)*/
            /* $Consulta = "SELECT 
               count(*) total , COALESCE(SUM(a.debe), 0) as suma
            from ecuenta a
            inner join resolucionAgSanKris b on
            a.inm_id = b.inm_id and a.rec_id=b.rec_id
          and 
          a.tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
          and cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.codAgencia=2
          group by a.codAgencia";*/
          $Consulta = "SELECT 
               count(*) total , COALESCE(SUM(totalsinsaldoant), 0) as suma
            from felectronicaServicios     
          where cast(fechaCertificacion as date) between '$Fecha' and '$Fechaa' and codAgencia=2
          group by codAgencia";
/* resumen agencia sankris mall (2)*/
/* resumen agencia MEGAFRATER (3)*/

/*$Consulta2 = "
    SELECT count(*) total, sum(a.debe) as suma
      from ecuenta a
      inner join resolucionAgMega b on
      a.inm_id = b.inm_id and a.rec_id=b.rec_id
    and 
    a.tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
    and cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.codAgencia=3
    group by a.codAgencia";*/
    $Consulta2 = "SELECT 
               count(*) total , COALESCE(SUM(totalsinsaldoant), 0) as suma
            from felectronicaServicios     
          where cast(fechaCertificacion as date) between '$Fecha' and '$Fechaa' and codAgencia=3
          group by codAgencia";
/* resumen agencia MEGAFRATER (3)*/


  $Consulta3 = "
    SELECT  count(*) total,SUM(a.debe) as suma
  
    from ecuenta a
    inner join resolucionAgPrincipal b on
    a.inm_id = b.inm_id and a.rec_id=b.rec_id
  and 
  a.tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
  and cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.codAgencia=1
  group by a.codAgencia";
    $Consulta4 = "  SELECT  count(*) total,SUM(a.debe) as suma
    from ecuenta a
  WHERE cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and tra_Codigo='LC' and USUARIO='Facturacion'";
      $Consulta5 = "
    SELECT  count(*) total,SUM(a.haber) as suma
    from ecuenta a
  WHERE cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.tra_Codigo='NC' and a.codAgencia =1
  group by a.codAgencia";
      $Consulta6 = "
    SELECT  count(*) total,SUM(a.haber) as suma
    from ecuenta a
  WHERE cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.tra_Codigo='NC' and a.codAgencia =2
  group by a.codAgencia";
      $Consulta7 = "
    SELECT  count(*) total,SUM(a.haber) as suma
    from ecuenta a
  WHERE cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.tra_Codigo='NC' and a.codAgencia =3
  group by a.codAgencia";
 



  $R = sqlsrv_query($con, $Consulta);
$R2 = sqlsrv_query($con, $Consulta2);
$R3 = sqlsrv_query($con, $Consulta3);
$R4 = sqlsrv_query($con, $Consulta4);
$R5 = sqlsrv_query($con, $Consulta5);
$R6 = sqlsrv_query($con, $Consulta6);
$R7 = sqlsrv_query($con, $Consulta7);



while ($Fila = sqlsrv_fetch_array($R)) {
 $total_=$Fila['total'];
  $suma_=$Fila['suma'];
   
  }  


   
    while ($Fila2 = sqlsrv_fetch_array($R2)) {
$total2_=$Fila2['total'];
  $suma2_=$Fila2['suma'];
    
}
   while ($Fila3 = sqlsrv_fetch_array($R3)) {
 $total3_=$Fila3['total'];
  $suma3_=$Fila3['suma'];
    }
    while ($Fila4 = sqlsrv_fetch_array($R4)) {
 $total4_=$Fila4['total'];
  $suma4_=$Fila4['suma'];
    }
      while ($Fila5 = sqlsrv_fetch_array($R5)) {
 $total5_=$Fila5['total'];
  $suma5_=$Fila5['suma'];
    }
      while ($Fila6 = sqlsrv_fetch_array($R6)) {
 $total6_=$Fila6['total'];
  $suma6_=$Fila6['suma'];
    }
      while ($Fila7 = sqlsrv_fetch_array($R7)) {
 $total7_=$Fila7['total'];
  $suma7_=$Fila7['suma'];
    }


$cantot=$total3_+$total4_;
$sumtota=$suma3_+$suma4_;
$cantotal=$total_+$total2_+$total3_+$total4_;
$sumtotal=$suma_+$suma2_+$suma3_+$suma4_;
$cantotalNC=$total5_+$total6_+$total7_;
$sumtotalNC=$suma5_+$suma6_+$suma7_;

        ?>

      <tr>
        
      <td ><?php echo("SankrisMall") ?>:</td>
    <td><?php echo number_format("$total_",0,'.',','); ?></td>
    <td><?php echo number_format("$suma_",2,'.',','); ?></td>
    <td><?php echo number_format("$total6_",0,'.',','); ?></td>
    <td><?php echo number_format("$suma6_",2,'.',','); ?></td>


    
    </tr>
     <tr>
        
      <td ><?php echo("MegaFrater") ?>:</td>
    <td><?php echo number_format("$total2_",0,'.',','); ?></td>
    <td><?php echo number_format("$suma2_",2,'.',','); ?></td>
    <td><?php echo number_format("$total7_",0,'.',','); ?></td>
    <td><?php echo "$suma7_"; ?></td>
    
    </tr>
     <tr>
        
      <td ><?php echo("Oficina Central") ?>:</td>
    <td><?php echo number_format("$total3_",0,'.',','); ?></td>
    <td><?php echo number_format("$suma3_",2,'.',','); ?></td>
    <td><?php echo number_format("$total5_",0,'.',','); ?></td>
    <td><?php echo number_format("$suma5_",2,'.',','); ?></td>
    
    </tr>
    <tr>
        
      <td ><?php echo("Oficina Central(Facturación)") ?>:</td>
    <td><?php echo number_format("$total4_",0,'.',','); ?></td>
    <td><?php echo "$suma4_"; ?></td>
    
    </tr>
    <tr>
        
      <td ><?php echo("Total Oficina Central") ?>:</td>
    <td><?php echo number_format("$cantot",0,'.',','); ?></td>
    <td><?php echo number_format("$sumtota",2,'.',','); ?></td>
    
    </tr>
     <tr>
        <td ><?php echo("Total General") ?>:</td>
    <td><?php echo number_format("$cantotal",0,'.',','); ?></td>
    <td><?php echo number_format("$sumtotal",2,'.',','); ?></td> 
     <td><?php echo number_format("$cantotalNC",0,'.',','); ?></td>
    <td><?php echo number_format("$sumtotalNC",2,'.',','); ?></td> 
     
    
    </tr>
  </table>
  <?php }  sqlsrv_close( $con );?>
  </center>
</div>
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