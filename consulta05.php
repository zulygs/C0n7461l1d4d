<!DOCTYPE html> 

<?php 
	include("conexion.php");
	set_time_limit(0);
?>
<meta charset="UTF-8">
<html> 	
	<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Consulta Ingresos Mensuales</title>
    <!-- Bootstrap core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet"> 
	<link rel="stylesheet" href="css/estilos.css">		
	<style>
      .table-striped>tbody>tr:nth-child(odd)>td, 
      .table-striped>tbody>tr:nth-child(odd)>th {
       background-color: #72F751;
      }
      .table-striped>tbody>tr:nth-child(even)>td, 
      .table-striped>tbody>tr:nth-child(even)>th {
       background-color: #6BB6F9;
      }
      .table-striped>thead>tr>th {
         background-color: #eee;
      }
    </style>
	</head>
<body>
	<div class="container wrapper ">
	<table class="table table-bordered table-responsive table-hover table-striped">
		<div class = "centrar"> CONSULTA DE INGRESOS </div>
		<tr class = "hear" >
			<td>Fecha</td>
			<td>Banrural Carga</td>
			<td>Banrural Depósitos</td>
			<td>Total Banrural </td>
			<td>G y T Carga</td>
			<td>Visanet</td>
			<td>Web</td>
			<td>Total </td>
		</tr>
		<?php
			$fecha01_ = $_POST['fecha01'];
			$fecha02_ = $_POST['fecha02'];
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
					$tarjeta = $fila['tarjeta'];				}
				while($fila = sqlsrv_fetch_array($eweb)){
					$web = $fila['web'];				}	
				$banruraltot = $banrural + $boleta;
				$totaltotal = $banruraltot + $GyT + $tarjeta + $web;
				$t_banrural = $t_banrural + $banrural;
				$t_gyt = $t_gyt + $GyT;
				$t_t_banrural = $t_t_banrural + $banruraltot;
				$t_boleta = $t_boleta + $boleta;
				$t_tarjeta = $t_tarjeta + $tarjeta;
				$t_web = $t_web + $web;
				$t_total = $t_total + $totaltotal;
			?>

				<tr align="right">
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
			<tr class = "hear2">
				<td><?php echo "TOTALES"; ?></td>
				<td><?php echo number_format($t_banrural,2); ?></td>
				<td><?php echo number_format($t_boleta,2); ?></td>
				<td><?php echo number_format($t_t_banrural,2); ?></td>
				<td><?php echo number_format($t_gyt,2); ?></td>
				<td><?php echo number_format($t_tarjeta,2); ?></td>
				<td><?php echo number_format($t_web,2); ?></td>
				<td><?php echo number_format($t_total,2); ?></td>
			</tr>
			<tr class = "hear" >
				<td>Fecha   </td>
				<td>Banrural Carga</td>
				<td>Banrural Depósitos</td>
				<td>Total Banrural </td>
				<td>G y T Carga</td>
				<td>Visanet</td>
				<td>web</td>
				<td>Total </td>
			</tr>
	</table>
	<div class="centrar">
        <?php $url = htmlspecialchars(@ $_SERVER['HTTP_REFERER']); ?>
        <tr><a class="btn btn-primary" href="<?php echo "$url" ; ?>">Menu Anterior</a></tr>
    </div>
	</div>
</body>
</html>