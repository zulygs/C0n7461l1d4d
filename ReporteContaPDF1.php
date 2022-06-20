<?php

include "conexion1.php";
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}

?>
<?php

require 'fpdf/fpdf.php';
include "conexion.php";
$pdf = new FPDF();
$pdf = new FPDF('L', 'mm', 'A4');
$pdf->AddPage();
$Fecha  = $_REQUEST["Fecha_"];
$Fechaa = $_REQUEST["Fecha1_"];

$busqueda = "SELECT inm_id,dbo.alote(inm_id) as lote,(SELECT COUNT(*) from ecuenta where tra_Codigo='PAT' and cast(dia_Fecha as date) between '$Fecha' and '$Fechaa' )as no , dia_Fecha,tra_Codigo,tra_Descripcion,HABER,FHSistema,mov_NoDocto,cae
 from ecuenta where tra_Codigo='PAT' and cast(dia_Fecha as date)  between '$Fecha' and '$Fechaa' order by dia_Fecha ASC";
$total  = 0;
$total2 = 0;
$no_    = 0;
$buscar = sqlsrv_query($con, $busqueda);

$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Pagos Con Tarjeta ', 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFillColor(232, 232, 232);

$pdf->SetTextColor(17, 13, 12);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(25, 6, 'Id Inmueble', 1, 0, 'C', 1);
$pdf->Cell(27, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'Fecha', 1, 0, 'C', 1);
$pdf->Cell(26, 6, 'Tipo', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Descripcion', 1, 0, 'C', 1);
$pdf->Cell(26, 6, 'Valor', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'Fecha Sistema', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Aut. VISA', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'CREDOMATIC', 1, 1, 'C', 1);

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

    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(25, 7, $inm_id_, 1, 0, 'C');
    $pdf->Cell(27, 7, $lote_, 1, 0, 'C');
    $pdf->Cell(50, 7, $cadena_nuevo_formato, 1, 0, 'C');
    $pdf->Cell(26, 7, $tra_Codigo_, 1, 0, 'C');
    $pdf->Cell(40, 7, $tra_Descripcion_, 1, 0, 'C');
    $pdf->Cell(26, 7, 'Q.' . number_format($HABER_, 2), 1, 0, 'C');
    $pdf->Cell(35, 7, $cadena_nuevo_formato2, 1, 0, 'C');
    $pdf->Cell(20, 7, $mov_NoDocto_, 1, 0, 'C');
    $pdf->Cell(30, 7, $cae_, 1, 1, 'C');

}
$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Valor Total: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(26, 10, 'Q.' . number_format($total, 2), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(66, 10, 'Cantidad De Inmuebles: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(26, 10, $no_, 1, 1, 'C');
$pdf->Output();
