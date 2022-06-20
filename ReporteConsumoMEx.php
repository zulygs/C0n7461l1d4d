
<?php
include "conexion.php";
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}

$COmbo_ = $_REQUEST['COmboM'];
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel;
$objSheet    = $objPHPExcel->getActiveSheet();
$busquedaMes = "SELECT   mes_id,mes_Nombre,year(mes_FechaInicio) as anioo   from pdv_CiclosMeses where mes_Estado=3 and mes_id='$COmbo_'";
  $buscarMes = sqlsrv_query($con, $busquedaMes);
  while ($filaM = sqlsrv_fetch_array($buscarMes)) {
    $mes_Nombre_               = $filaM['mes_Nombre'];
    $anioo_               = $filaM['anioo'];

}
$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(1, 4);
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Facturas por Consumo/' . $mes_Nombre_ . ' de ' . $anioo_ . '.xls');
header("Content-Type: text/html;charset=utf-8");



?>
<?php


$busqueda = "SELECT a.fechaCertificacion,factura,a.inm_IdGenerado,a.inm_Id,a.clp_NIT, a.cae,a.dte,a.autorizacion,a.iva,a.bruto, a.totalsinsaldoant,a.saldoant,a.totalapagar 
  FROM 
  felectronicaHistorico a
  WHERE mes ='$COmbo_' order by a.fechaCertificacion";
$total  = 0;
$totalIVA = 0;
$no_    = 0;
$totalBruto=0;
$buscar = sqlsrv_query($con, $busqueda);

echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption back><font color='#85C1E9' size='10'>Facturas Consumo </font></caption>
    <tr>
        <td>Factura</td>

        <td>Id Inmueble</td>
        <td>Lote</td>
        <td>NIT</td>
        <td>CAE</td>
        <td>DTE</td>
        <td>Autorizacion</td>
        <td>Fecha Autorizacion</td>

        <td>IVA</td>
        <td>SubTotal</td>
        <td>Total sin Saldo ANt</td>
        <td>Saldo Ant.</td>

        <td>Total a Pagar</td>
    </tr>
     ";

while ($fila = sqlsrv_fetch_array($buscar)) {
    $factura_               = $fila['factura'];
 
    $inm_Id_               = $fila['inm_Id'];
    $inm_IdGenerado_                 = $fila['inm_IdGenerado'];
    $clp_NIT_            = $fila['clp_NIT'];
    $cae_                 = $fila['cae'];
    $dte_                = $fila['dte'];
    $autorizacion_            = $fila['autorizacion'];
    $iva_             = $fila['iva'];
    $bruto_                = $fila['bruto'];
     $totalsinsaldoant_       = $fila['totalsinsaldoant'];
    $saldoant_       = $fila['saldoant'];
    $totalapagar_       = $fila['totalapagar'];
    $fechaCertificacion_       = $fila['fechaCertificacion'];

    $total += $totalsinsaldoant_;
    $totalIVA += $iva_;
     $totalBruto += $bruto_;

    ?>

    <tr>
        <td><?php echo $factura_; ?></td>

        <td><?php echo $inm_Id_; ?></td>
        <td style="mso-number-format:'@'"><?php echo utf8_decode($inm_IdGenerado_); ?></td>
        <td ><?php echo $clp_NIT_; ?></td>
        <td ><?php echo $cae_; ?></td>
        <td ><?php echo $dte_; ?></td>
        <td ><?php echo $autorizacion_; ?></td>
        <td ><?php echo $fechaCertificacion_; ?></td>

        <td ><?php echo 'Q' . number_format($iva_, 2); ?></td>
        <td ><?php echo 'Q' . number_format($bruto_, 2); ?></td>
        <td ><?php echo 'Q' . number_format($totalsinsaldoant_, 2); ?></td>
        <td ><?php echo 'Q' . number_format($saldoant_, 2); ?></td>
        
        <td ><?php echo 'Q' . number_format($totalapagar_, 2); ?></td>

        
    </tr>
    <?php
    }
    $totall = 'Q' . number_format($total, 2);
    $totallI = 'Q' . number_format($totalIVA, 2);
    $totalBrutol = 'Q' . number_format($totalBruto, 2);


    echo "<tr></tr>
    <tr><td>SubTotal:</td>
    <td>$totalBrutol</td></tr>
    <tr>
    
    <td>Total IVA:</td>
    <td>$totallI</td></tr>
    
    <td>Total :</td>
    <td>$totall </td>
    </tr> ";

echo "
   </table>  ";
sqlsrv_close($con);

?>




