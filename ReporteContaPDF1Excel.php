
<?php

$Fecha  = $_REQUEST["Fecha_"];
$Fechaa = $_REQUEST["Fecha1_"];
require_once 'Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel;
$objSheet    = $objPHPExcel->getActiveSheet();

$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(1, 4);
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Pago Con Tarjeta/' . $Fecha . ' al ' . $Fechaa . '.xls');
header("Content-Type: text/html;charset=utf-8");

include "conexion.php";
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}

?>
<?php

$busqueda = "SELECT inm_id,dbo.alote(inm_id) as lote,(SELECT COUNT(*) from ecuenta where tra_Codigo='PAT' and cast(dia_Fecha as date) between '$Fecha' and '$Fechaa' )as no , dia_Fecha,tra_Codigo,tra_Descripcion,HABER,FHSistema,mov_NoDocto,cae
 from ecuenta where tra_Codigo='PAT' and cast(dia_Fecha as date)  between '$Fecha' and '$Fechaa' order by dia_Fecha ASC";
$total  = 0;
$total2 = 0;
$no_    = 0;
$buscar = sqlsrv_query($con, $busqueda);

echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption back><font color='#85C1E9' size='10'>Pagos Con Tarjeta</font></caption>
    <tr>
        <td>Id Inmueble</td>
        <td>Lote</td>
        <td>Fecha</td>
        <td>Tipo</td>
        <td>Descripcion</td>
        <td>Valor</td>
        <td>Fecha Sistema</td>
        <td>Aut. VISA</td>
        <td>CREDOMATIC</td>
    </tr>
     ";

while ($fila = sqlsrv_fetch_array($buscar)) {
    $inm_id_               = $fila['inm_id'];
    $lote_                 = $fila['lote'];
    $dia_Fecha_            = $fila['dia_Fecha'];
    $tra_Codigo_           = $fila['tra_Codigo'];
    $tra_Descripcion_      = $fila['tra_Descripcion'];
    $HABER_                = $fila['HABER'];
    $FHSistema_            = $fila['FHSistema'];
    $mov_NoDocto_          = $fila['mov_NoDocto'];
    $cae_                  = $fila['cae'];
    $cadena_nuevo_formato  = date_format($dia_Fecha_, "d/m/Y H:i:s");
    $cadena_nuevo_formato2 = date_format($FHSistema_, "d/m/Y");
    $no_                   = $fila['no'];
    $total += $HABER_;

    ?>

    <tr>
        <td><?php echo $inm_id_; ?></td>
        <td style="mso-number-format:'@'"><?php echo utf8_decode($lote_); ?></td>
        <td ><?php echo $cadena_nuevo_formato; ?></td>
        <td ><?php echo $tra_Codigo_; ?></td>
        <td ><?php echo $tra_Descripcion_; ?></td>
        <td ><?php echo 'Q' . number_format($HABER_, 2); ?></td>
        <td ><?php echo $cadena_nuevo_formato2; ?></td>
        <td ><?php echo $mov_NoDocto_; ?></td>
        <td ><?php echo $cae_; ?></td>
    </tr>
    <?php
    }
    $totall = 'Q' . number_format($total, 2);
    echo "<tr></tr>
    <tr>
    <td>Cantidad De Inmuebles:</td>
    <td>$no_ </td>
    <td>Valor Total:</td>
    <td>$totall</td>
    </tr> ";

echo "
   </table>  ";
sqlsrv_close($con);

?>




