
<?php

$fecha01_ = $_REQUEST['fecha01'];
$fecha02_ = $_REQUEST['fecha02'];

require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel;
$objSheet    = $objPHPExcel->getActiveSheet();

$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(1, 4);
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Fel Periodo (General)/' . $fecha01_ . ' al ' . $fecha02_ . '.xls');
header("Content-Type: text/html;charset=utf-8");

include "conexion.php";
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}

?>
<?php

$busqueda = "SELECT tra_Codigo as trx , tra_Descripcion as descripcion,
  inm_Id,clp_NIT,cae,dte,autorizacion,iva,bruto, totalsinsaldoant,FORMAT(CAST(fechaCertificacion as date),'dd-MM-yyyy') AS fechaCertificacion,codAgencia,
  dbo.obtieneNombreAgencia(codAgencia) as agencia,estado, TIPO
  FROM 
  felectronicaServicios  
  WHERE 
  CAST(fechaCertificacion as date) between '$fecha01_' and '$fecha02_' 
   UNION 
  SELECT 'FCM' as trx, 'Factura Consumo Mensual' as descripcion,  
  inm_Id,clp_NIT,cae,dte,autorizacion,iva,bruto, totalsinsaldoant,FORMAT(CAST(fechaCertificacion as date),'dd-MM-yyyy')  AS fechaCertificacion, 1 as codAgencia, 'Central' as agencia,
  'V' as estado, 'FAC' AS TIPO

  FROM 
  felectronicaHistorico  
  WHERE 
  CAST(fechaCertificacion as date) between '$fecha01_' and '$fecha02_' 
  order by fechaCertificacion ";
$total  = 0;
$totalIVA = 0;
$no_    = 0;
$totalBruto=0;
$totallI=0;
$tottat=0;

$buscar = sqlsrv_query($con, $busqueda);

echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption back><font color='#85C1E9' size='10'>Fel Periodo (General)</font></caption>
    <tr>
        <td>Cod. Tra.</td>
        <td>Descripcion</td>
        <td>Id Inmueble</td>
        <td>NIT</td>
        
        <td>CAE</td>
        <td>DTE</td>
        <td>Autorizacion</td>
        <td>IVA</td>
        <td>SubTotal</td>
        <td>Total a Pagar</td>
        <td>Fecha Certificacion</td>
        <td>Agencia</td>

        <td>Estado</td>
        <td>Tipo</td>

        
    </tr>
     ";

while ($fila = sqlsrv_fetch_array($buscar)) {
 
   $inm_Id_               = $fila['inm_Id'];
    $clp_NIT_            = $fila['clp_NIT'];
    $trx_           = $fila['trx'];
    $descripcion_      = $fila['descripcion'];
    $cae_                 = $fila['cae'];
    $dte_                = $fila['dte'];
    $totalapagar_                = $fila['totalsinsaldoant'];

    $autorizacion_            = $fila['autorizacion'];
    $iva_             = $fila['iva'];
    $bruto_                = $fila['bruto'];
    
    $agencia_               = $fila['agencia'];
    $estado_               = $fila['estado'];
    $tipo_               = $fila['TIPO'];

    $fechaCertificacion_               = $fila['fechaCertificacion'];

  
    
    $totalIVA += $iva_;
    $totalBruto += $bruto_;
    $tottat += $totalapagar_;

    ?>

    <tr>
        <td ><?php echo $trx_; ?></td>
        <td ><?php echo utf8_decode($descripcion_); ?></td>
        <td><?php echo $inm_Id_; ?></td>
        <td ><?php echo $clp_NIT_; ?></td>
        
        <td ><?php echo $cae_; ?></td>
        <td ><?php echo $dte_; ?></td>
        <td ><?php echo $autorizacion_; ?></td>
        <td ><?php echo 'Q' . number_format($iva_, 2); ?></td>
        <td ><?php echo 'Q' . number_format($bruto_, 2); ?></td>

        <td ><?php echo 'Q' . number_format($totalapagar_, 2); ?></td>
        <td ><?php echo $fechaCertificacion_; ?></td>
        <td ><?php echo $agencia_; ?></td>
        <td ><?php echo $estado_; ?></td>
        <td ><?php echo $tipo_; ?></td>



        
    </tr>
    <?php
    }
    $totallI = 'Q' . number_format($totalIVA, 2);
    $totalBrutol = 'Q' . number_format($totalBruto, 2);
    $tott = 'Q' . number_format($tottat, 2);



    echo "<tr></tr>
    <tr> <td>SubTotal:</td>
    <td>$totalBrutol</td></tr>
    <tr>
    
    <td>Total IVA:</td>
    <td>$totallI</td></tr> 
    <tr>
    
    <td>Total:</td>
    <td>$tott</td></tr> 
     ";

echo "
   </table>  ";
sqlsrv_close($con);

?>




