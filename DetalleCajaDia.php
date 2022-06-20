<?php
    $alert = '';
    session_start();
  
    $userr=$_SESSION['user'];
    $fecha_actual=date("Y/m/d");
    $nombre = $_REQUEST['nombre'];
    $idc = $_REQUEST['idc'];
    $fecha01_ = $_REQUEST['fechaI'];
    $fecha02_ = $_REQUEST['FechaF'];
    $combo_ = $_REQUEST['combo_'];
   
    if (empty($_SESSION['idUser'])) {
        header('location: index.html');
    }  
   if ($combo_ == 2) {
      include("conexion3.php");
    }else{
      include("conexion.php"); 
    }
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
  <!--  Bootstrap v2.3.2 -->
  <link rel="stylesheet" media="all" href="https://s3.amazonaws.com/dynatable-docs-assets/css/bootstrap-2.3.2.min.css" />
  <!-- Plugin styles -->
  <link rel="stylesheet" media="all" href="https://s3.amazonaws.com/dynatable-docs-assets/css/jquery.dynatable.css" />
  <!--  jQuery v3.0.0-beta1 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js"></script>
  <!-- JS Pluging -->
  <script type='text/javascript' src='https://s3.amazonaws.com/dynatable-docs-assets/js/jquery.dynatable.js'></script>
  <style type="text/css">
    #lateral { height: auto; }  
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
    
    include("ListadoMenu.php");
?>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel" id="lateral">
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
            <a class="navbar-brand" href="principal.php">Principal</a>
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
        <div class="col form-row">
      <div class="container container-form-lg" style="width: auto">
        <center>
          <div class="form-row" >
            <div class="col form-group" id="">
         <div class="card" >
                <div class="card-header " >&nbsp;&nbsp;
                  <center><h2><?php echo " $nombre"; ?> Caja <?php if ($combo_ == 1) { echo "Sascim";}else{ echo "Panorama";}  echo "
                  <html>
                  <br>
                  </html> $fecha01_ a $fecha02_"; ?></h2></center>
                </div>
                <hr>
                <div class="table-responsive" style="width: auto">
                  <table class="table">
                    <thead class=" text-primary2" align="center" >
                      <th ><font color="white">No.</font></th>
                      <th><font color="white">Id Tipo</font></th>
                      <th><font color="white">Tipo</font></th>
                      <th><font color="white">Banco</font></th>
                      <th><font color="white">Documento</font></th>
                      <th><font color="white">Importe</font></th>
                      <th><font color="white">Fecha Doc.</font></th>
                      <th><font color="white">Rec. Id</font></th>
                      <th><font color="white">Clp. Id</font></th>
					  <th><font color="white">Lote</font></th>
                       <th><font color="white">Id Transacción</font></th>
                       <th><font color="white">Transacción</font></th>
                    </thead>
                    <tbody>
                      <?php
                      $busqueda2 = "SELECT a.tip_id,dbo.devuelveTipoPago(a.tip_id) as tipo, ban_id,dbo.devuelveNombreBco(a.ban_id) as banco,
  a.det_NoDocumento,a.det_Importe, a.det_FechaDocumento, a.rec_id, b.clp_id, dbo.alote(b.clp_id) as lote, b.tra_id, 
  dbo.devuelveNombreTransaccionCaja(b.tra_id) as transaccion
  from pdv_DetalleFormaPago a
  left join pdv_RecibosDeCaja b
  on a.rec_id = b.rec_id   and b.rec_FechaContable >0 
  where b.rec_usuario='$idc' and cast( b.rec_FechaHoraSistema as date) between '$fecha01_' and '$fecha02_'";
			$total  = 0;
            $i         = 0;
            
                $buscar2=sqlsrv_query($con,$busqueda2);
              while ($Fila =sqlsrv_fetch_array($buscar2)) {
                $tip_id   = $Fila['tip_id'];
                $tipo        = $Fila['tipo'];
                $ban_id      = $Fila['ban_id'];
                $banco        = $Fila['banco'];
                $det_NoDocumento        = $Fila['det_NoDocumento'];
                $det_Importe= $Fila['det_Importe'];
				$det_FechaDocumento = $Fila['det_FechaDocumento'];
                $rec_id          = $Fila['rec_id'];
                $clp_id          = $Fila['clp_id'];
                $lote          = $Fila['lote'];
                $tra_id          = $Fila['tra_id'];
                $transaccion          = $Fila['transaccion'];
                $i++;
                ?>
                <tr class="" align="center">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $tip_id; ?></td>
                  <td nowrap><?php echo $tipo; ?></td>
                  <!--<td nowrap><?php //echo $ban_id; ?></td>-->
                  <td nowrap><?php echo $banco; ?></td>
                  <td nowrap><?php echo $det_NoDocumento; ?></td>
                  <td nowrap><?php echo $det_Importe; ?></td>
                  <td nowrap><?php echo date_format($det_FechaDocumento,'Y-m-d'); ?></td>
                  <td nowrap><?php echo $rec_id; ?></td>
                  <td nowrap><?php echo $clp_id; ?></td>
                  <td nowrap><?php echo $lote; ?></td>
                  <td nowrap><?php echo $tra_id; ?></td>
                  <td nowrap><?php echo $transaccion; ?></td>


                </tr>
             <?php  
            }
              
                ?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </center>
</div>
            </div>
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