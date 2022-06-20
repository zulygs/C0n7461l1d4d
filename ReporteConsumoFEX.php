
<?php

$fecha01_ = $_REQUEST['fecha01'];
$fecha02_ = $_REQUEST['fecha02'];
$COmbo_ = $_REQUEST['COmbo'];
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel;
$objSheet    = $objPHPExcel->getActiveSheet();

$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(1, 4);
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=FacturasFel/' . $fecha01_ . ' al ' . $fecha02_ . '.xls');
header("Content-Type: text/html;charset=utf-8");

include "conexion.php";
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}

?>
<?php

$busqueda = "SELECT a.fechaCertificacion,a.inm_IdGenerado,a.inm_Id,a.clp_NIT,a.tra_Codigo,a.tra_Descripcion,a.cae,a.dte,a.autorizacion,a.iva,a.bruto,a.totalsinsaldoant,a.totalapagar ,a.id,b.codAgencia,dbo.devuelveCodigoAgencia(b.codAgencia) as c FROM  felectronicaServicios a, ecuenta b WHERE 
  a.id = b.id and
  CAST(a.fechaCertificacion as date) between '$fecha01_' and '$fecha02_' and b.codAgencia='$COmbo_' order by a.fechaCertificacion";
$total  = 0;
$totalIVA = 0;
$no_    = 0;
$totalBruto=0;
$buscar = sqlsrv_query($con, $busqueda);

echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption back><font color='#85C1E9' size='10'>Facturas FEl</font></caption>
    <tr>

        <td>Id Inmueble</td>
        <td>Lote</td>
        <td>NIT</td>
        <td>Cod. Tra.</td>
        <td>Descripcion</td>
        <td>CAE</td>
        <td>DTE</td>
        <td>Autorizacion</td>
        <td>IVA</td>
        <td>SubTotal</td>
        <td>Total Sin saldo Anterior</td>
        <td>Total a Pagar</td>
        <td>ID</td>
        <td>Fecha Certificacion</td>
        <td>Cod Agencia</td>
        <td>Agencia</td>
    </tr>
     ";

while ($fila = sqlsrv_fetch_array($buscar)) {
 
    $inm_Id_               = $fila['inm_Id'];
    $inm_IdGenerado_                 = $fila['inm_IdGenerado'];
    $clp_NIT_            = $fila['clp_NIT'];
    $tra_Codigo_           = $fila['tra_Codigo'];
    $tra_Descripcion_      = $fila['tra_Descripcion'];
    $cae_                 = $fila['cae'];
    $dte_                = $fila['dte'];
    $autorizacion_            = $fila['autorizacion'];
    $iva_             = $fila['iva'];
    $bruto_                = $fila['bruto'];
    $totalsinsaldoant_       = $fila['totalsinsaldoant'];
    $totalapagar_       = $fila['totalapagar'];
    $id_         = $fila['id'];
    $codAgencia               = $fila['codAgencia'];
    $fechaCertificacion_               = $fila['fechaCertificacion'];
    $c_               = $fila['c'];
    $total += $totalsinsaldoant_;
    $totalIVA += $iva_;
    $totalBruto += $bruto_;

    ?>

    <tr>
        <td><?php echo $inm_Id_; ?></td>
        <td style="mso-number-format:'@'"><?php echo utf8_decode($inm_IdGenerado_); ?></td>
        <td ><?php echo $clp_NIT_; ?></td>
        <td ><?php echo $tra_Codigo_; ?></td>
        <td ><?php echo utf8_decode($tra_Descripcion_); ?></td>
        <td ><?php echo $cae_; ?></td>
        <td ><?php echo $dte_; ?></td>
        <td ><?php echo $autorizacion_; ?></td>
        <td ><?php echo 'Q' . number_format($iva_, 2); ?></td>
        <td ><?php echo 'Q' . number_format($bruto_, 2); ?></td>
        <td ><?php echo 'Q' . number_format($totalsinsaldoant_, 2); ?></td>

        <td ><?php echo 'Q' . number_format($totalapagar_, 2); ?></td>
        <td ><?php echo $fechaCertificacion_; ?></td>

        <td ><?php echo $id_; ?></td>
        <td ><?php echo $codAgencia; ?></td>
        <td ><?php echo $c_; ?></td>

        
    </tr>
    <?php
    }
    $totall = 'Q' . number_format($total, 2);
    $totallI = 'Q' . number_format($totalIVA, 2);
    $totalBrutol = 'Q' . number_format($totalBruto, 2);


    echo "<tr></tr>
    <tr> <td>SubTotal:</td>
    <td>$totalBrutol</td></tr>
    <tr>
    
    <td>Total IVA:</td>
    <td>$totallI</td></tr> 
    
    <tr><td>Total :</td>
    <td>$totall </td>
    </tr> ";

echo "
   </table>  ";
sqlsrv_close($con);

?>




