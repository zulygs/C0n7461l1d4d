<!DOCTYPE html> 

<?php 
	include("conexion.php");
	session_start();
	set_time_limit(0);
	 $userr=$_SESSION['user'];
	 if (empty($_SESSION['idUser'])) {
        header('location: index.html');
    }
    date_default_timezone_set('UTC');
?>
<meta charset="UTF-8">

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

  
</head>
<style type="text/css">
    #lateral { height: auto; }  
#div1 {
     overflow:scroll;
     height:750px;
     width:auto;
}

  </style>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
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
        
        
	<div class="container container-form-lg" id="div1">

	<table class="table  table-responsive table-hover table-striped">
		<div > <font size="25">CONSULTA DE INGRESOS</font> </div>
		<center><tr align="center">
			<td >Fecha</td>
			<td>Banrural Carga</td>
			<td>Banrural Depósitos <br>en agencias</td>
			<td>Total Banrural </td>
			<td>G y T Carga</td>
			<td>Visanet POS</td>
			<td>Web pago tarjeta </td>
			<td>Total</td>
		</tr></center>
		<?php
			$fecha01_ = $_REQUEST['fecha01'];
			$fecha02_ = $_REQUEST['fecha02'];
			$fecha1= new DateTime("$fecha01_");
			$fecha2= new DateTime("$fecha02_");
			$unDia= new DateInterval("P1D");
			$t_banrural = 0;
			$t_t_banrural = 0;
			$t_gyt = 0;
			$t_boleta = 0;
			$t_tarjeta = 0;
			$t_web = 0;
			$t_total = 0;
			while($fecha1<=$fecha2){
				$fecha_ = $fecha1->format('Y-m-d');
				
				$banrural = "SELECT sum(HABER) as banrural from ecuenta where dia_fecha between '$fecha_'  and '$fecha_' and usuario = 'Banrural'";
				$GyT = "SELECT sum(HABER) as gyt from ecuenta where dia_fecha between '$fecha_' and '$fecha_' and (USUARIO like '%GyT%' or USUARIO like '%Gyt%')";
				$boleta = "SELECT SUM(det_Importe) as boleta from pdv_DetalleFormaPago where det_FechaDocumento  between '$fecha_' and '$fecha_' and tip_id = 2";
				$tarjeta = "SELECT SUM(det_Importe) as tarjeta from pdv_DetalleFormaPago where det_FechaDocumento between '$fecha_' and '$fecha_' and tip_id = 4";
				$web = "SELECT sum(HABER) as web from ecuenta where cast(dia_fecha as date) between '$fecha_'  and '$fecha_' and usuario = 'usuarioweb'";
	
			
				$ejebanrural = sqlsrv_query($con, $banrural);
				$ejeGyT = sqlsrv_query($con, $GyT);
				$ejeboleta = sqlsrv_query($con, $boleta);
				$ejetarjeta = sqlsrv_query($con, $tarjeta);
				$eweb = sqlsrv_query($con, $web);
	
				while($fila = sqlsrv_fetch_array($ejebanrural)){
					$banrural = $fila['banrural'];				}
				while($fila = sqlsrv_fetch_array($ejeGyT)){
					$GyT = $fila['gyt'];    					}
				while($fila = sqlsrv_fetch_array($ejeboleta)){
					$boleta = $fila['boleta'];					}
				while($fila = sqlsrv_fetch_array($ejetarjeta)){
					$tarjeta = $fila['tarjeta'];}
				while($fila = sqlsrv_fetch_array($eweb)){
					$web = $fila['web'];}


			

				$banruraltot = $banrural + $boleta;
				$totaltotal = $banruraltot + $GyT + $tarjeta+$web;
				$t_banrural = $t_banrural + $banrural;
				$t_gyt = $t_gyt + $GyT;
				$t_t_banrural = $t_t_banrural + $banruraltot;
				$t_boleta = $t_boleta + $boleta;
				$t_tarjeta = $t_tarjeta + $tarjeta;
				$t_web = $t_web + $web;
				$t_total = $t_total + $totaltotal;
				?>

				<tr align="center" >
					<td><?php echo $fecha1->format('d-m-Y'); ?></td>
					<td><?php echo number_format($banrural,2); ?></td>
					<td><?php echo number_format($boleta,2); ?></td>
					<td><?php echo number_format($banruraltot,2); ?></td>
					<td><?php echo number_format($GyT,2); ?></td>
					<td><?php echo number_format($tarjeta,2); ?></td>
					<td><?php echo number_format($web,2); ?></td>
					<td><?php echo number_format($totaltotal,2); ?></td>
				</tr> 
				<?php	

				$fecha1->add($unDia);
		
			} ?>
			<tr class = "hear2" align="center">
				<td align="center"><?php echo "TOTALES"; ?></td>
				<td><?php echo number_format($t_banrural,2); ?></td>
				<td><?php echo number_format($t_boleta,2); ?></td>
				<td><?php echo number_format($t_t_banrural,2); ?></td>
				<td><?php echo number_format($t_gyt,2); ?></td>
				<td><?php echo number_format($t_tarjeta,2); ?></td>
				<td><?php echo number_format($t_web,2); ?></td>
				<td><?php echo number_format($t_total,2); ?></td>
			</tr>
			<tr class = "hear" align="center" style="background-color: white">
				<td>Fecha</td>
				<td>Banrural Carga</td>
				<td>Banrural Depósitos</td>
				<td>Total Banrural </td>
				<td>G y T Carga</td>
				<td>Visanet</td>
				<td>Web</td>
				<td>Total </td>
			</tr>
	</table>
	<div class="centrar">
        <?php $url = htmlspecialchars(@ $_SERVER['HTTP_REFERER']); ?>
    </div>
	</div>
</body>
</html>