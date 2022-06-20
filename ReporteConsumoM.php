
<?php 

include "conexion.php";
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
$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();

$COmbo_ = $_REQUEST['COmboM'];

$busquedaMes = "SELECT   mes_id,mes_Nombre,year(mes_FechaInicio) as anioo   from pdv_CiclosMeses where mes_Estado=3 and mes_id='$COmbo_'";
  $buscarMes = sqlsrv_query($con, $busquedaMes);
  while ($filaM  = sqlsrv_fetch_array($buscarMes)) {
    $mes_Nombre_ = $filaM['mes_Nombre'];
    $anioo_      = $filaM['anioo'];

}
$busqueda = " SELECT  a.fechaCertificacion,factura,a.inm_IdGenerado,a.inm_Id,a.clp_NIT, a.cae,a.dte,a.autorizacion,a.iva,a.bruto, a.totalsinsaldoant,a.saldoant,a.totalapagar 
  FROM 
  felectronicaHistorico a
  WHERE mes ='$COmbo_' order by a.fechaCertificacion ";
$buscar = sqlsrv_query($con, $busqueda);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Facturas por Consumo '.$mes_Nombre_ .' '. $anioo_  , 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFillColor(232, 232, 232);

$pdf->SetTextColor(17, 13, 8);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(10, 6, 'No.', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Factura', 1, 0, 'C', 1);

$pdf->Cell(15, 6, 'Id Inmueble', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'NIT', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'CAE', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'DTE', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'Autorizacion', 1, 0, 'C', 1);
$pdf->Cell(40, 6, ' Fecha Autorizacion', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'IVA.', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'SubTotal', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Total Sin SaldAnt', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Sal Ant', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Total a Pagar', 1, 1, 'C', 1);
$i=0;
$total=0;
$totalIVA=0;
$totalBruto=0;
while ($fila = sqlsrv_fetch_array($buscar)) {
	$i++;
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


    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(10, 7, $i, 1, 0, 'C');
    $pdf->Cell(15, 7, $factura_, 1, 0, 'C');

    $pdf->Cell(15, 7, $inm_Id_, 1, 0, 'C');
    $pdf->Cell(20, 7, $inm_IdGenerado_, 1, 0, 'C');
    $pdf->Cell(30, 7, $clp_NIT_, 1, 0, 'C');
     $pdf->Cell(20, 7, $cae_, 1, 0, 'C');
    $pdf->Cell(20, 7, $dte_, 1, 0, 'C');
    $pdf->Cell(60, 7, $autorizacion_, 1, 0, 'C');
    $pdf->Cell(40, 7, $fechaCertificacion_, 1, 0, 'C');

    $pdf->Cell(15, 7, 'Q.' . number_format($iva_, 2), 1, 0, 'C');
    $pdf->Cell(25, 7, 'Q.' . number_format($bruto_, 2), 1, 0, 'C');
    $pdf->Cell(25, 7, 'Q.' . number_format($totalsinsaldoant_, 2), 1, 0, 'C');
    $pdf->Cell(25, 7, 'Q.' . number_format($saldoant_, 2), 1, 0, 'C');

    $pdf->Cell(25, 7, 'Q.' . number_format($totalapagar_, 2), 1, 1, 'C');


}

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'SubTotal: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Q.' . number_format($totalBruto, 2), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Total IVA: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Q.' . number_format($totalIVA, 2), 1, 1, 'C');

 $pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, ' Total : ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(50, 10, 'Q.' . number_format($total, 2), 1, 1, 'C');

$pdf->Output();
 ?>