
<?php
include 'conexion.php';
error_reporting(E_ALL ^ E_NOTICE);
$Fecha  = $_REQUEST["Fecha_"];
$Fechaa = $_REQUEST["Fecha1_"];
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

$suma_=0;
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Resumen/' . $Fecha . ' al ' . $Fechaa . '.xls');
header("Content-Type: text/html;charset=utf-8");

include "conexion1.php";
$con = mysqli_connect($host, $user) or die('Error en el Servidor');
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}


$con = sqlsrv_connect($serverName, $connectionInfo) or die('Error en el Servidor');

$Consulta = "SELECT 
       count(*) total , COALESCE(SUM(a.debe), 0) as suma
    from ecuenta a
    inner join resolucionAgSanKris b on
    a.inm_id = b.inm_id and a.rec_id=b.rec_id
  and 
  a.tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
  and cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.codAgencia=2
  group by a.codAgencia";
  $Consulta2 = "
  SELECT count(*) total, sum(a.debe) as suma
    from ecuenta a
    inner join resolucionAgMega b on
    a.inm_id = b.inm_id and a.rec_id=b.rec_id
  and 
  a.tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
  and cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.codAgencia=3
  group by a.codAgencia";
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
      $Consulta8 = "
    SELECT  count(*) total,SUM(a.haber) as suma
    from ecuenta a
  WHERE cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and a.tra_Codigo='NC' and a.codAgencia =4
  group by a.codAgencia";
  /*SELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,
tra_Descripcion,cae,debe,haber
    from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fechaa'  and codAgencia=1
    and 
    tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
    and cae in(select ser_corr from resolucionAgMega where resolucionAgMega.inm_id = ecuenta.inm_id 
    and cast(dia_Fecha as date) between '$Fecha' and '$Fechaa')
    order by dia_Fecha,cae SELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,tra_Descripcion,cae,debe,haber
from ecuenta where cast(dia_Fecha as date) between  '$Fecha' and '$Fechaa'
and codAgencia=3  and tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S')
    and dte in(select ser_corr from resolucionAgMega) 
order by dia_Fecha,cae*/

$R = sqlsrv_query($con, $Consulta);
$R2 = sqlsrv_query($con, $Consulta2);
$R3 = sqlsrv_query($con, $Consulta3);
$R4 = sqlsrv_query($con, $Consulta4);
$R4 = sqlsrv_query($con, $Consulta4);
$R5 = sqlsrv_query($con, $Consulta5);
$R6 = sqlsrv_query($con, $Consulta6);
$R7 = sqlsrv_query($con, $Consulta7);
$R8 = sqlsrv_query($con, $Consulta8);
echo "<table border='1' cellpadding='1' cellspacing='0' width='100%'>
   <caption><font color='red' size='10'>Resumen</font></caption>
    <tr>
        <td></td>
        <td>Cantidad</td>
        <td>Total</td>
        <td>Cantidad NC</td>

      <td>Total NC</td>
        

    </tr>";

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
      while ($Fila8 = sqlsrv_fetch_array($R8)) {
 $total8_=$Fila8['total'];
  $suma8_=$Fila8['suma'];
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
        
      <td ><?php echo("Oficina Central(Facturacion)") ?>:</td>
    <td><?php echo number_format("$total4_",0,'.',','); ?></td>
    <td><?php echo "$suma4_"; ?></td>
    
    </tr>
    <tr>
        
      <td ><?php echo("Total Oficina Central") ?>:</td>
    <td><?php echo number_format("$cantot",0,'.',',');?></td>
    <td><?php echo number_format("$sumtota",2,'.',','); ?></td>
    
    </tr>
    <tr>
     <td ><?php echo("Total General") ?>:</td>
    <td><?php echo number_format("$cantotal",0,'.',','); ?></td>
    <td><?php echo number_format("$sumtotal",2,'.',','); ?></td> 
    
     <td><?php echo number_format("$cantotalNC",0,'.',','); ?></td>
    <td><?php echo number_format("$sumtotalNC",2,'.',','); ?></td> 
</tr>

  <?php

echo "</table>  ";
sqlsrv_close($con);

?>









