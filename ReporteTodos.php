
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

$pdf = new FPDF();
$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();
$fecha01_ = $_REQUEST['fecha01'];
$fecha02_ = $_REQUEST['fecha02'];


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
  'V' as estado, 'FACT' AS TIPO

  FROM 
  felectronicaHistorico  
  WHERE 
  CAST(fechaCertificacion as date) between '$fecha01_' and '$fecha02_' 
  order by fechaCertificacion

  ";
$buscar = sqlsrv_query($con, $busqueda);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Fel Por periodo (General) '.$fecha01_." A ".$fecha02_, 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFillColor(232, 232, 232);

$pdf->SetTextColor(17, 13, 8);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(10, 6, 'No.', 1, 0, 'C', 1);

$pdf->Cell(12, 6, 'Cod. Tra.', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Descripcion', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Id Inmueble', 1, 0, 'C', 1);
//$pdf->Cell(20, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(17, 6, 'NIT', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'CAE', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'DTE', 1, 0, 'C', 1);
$pdf->Cell(60, 6, 'Autorizacion', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'IVA.', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'SubTotal', 1, 0, 'C', 1);


$pdf->Cell(25, 6, 'Total a Pagar', 1, 0, 'C', 1);

//$pdf->Cell(20, 6, 'ID', 1, 0, 'C', 1);
$pdf->Cell(35, 6, 'FechaCertif', 1, 0, 'C', 1);

$pdf->Cell(30, 6, 'Agencia', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Estado', 1, 0, 'C', 1);

$pdf->Cell(15, 6, 'Tipo', 1, 1, 'C', 1);

$i=0;
$total=0.0;
$totalIVA=0;
$totalBruto=0;
$tottat=0;

while ($fila = sqlsrv_fetch_array($buscar)) {
	$i++;
    $inm_Id_               = $fila['inm_Id'];
    $clp_NIT_            = $fila['clp_NIT'];
    $trx_           = $fila['trx'];
    $descripcion_      = $fila['descripcion'];
    $cae_                 = $fila['cae'];
    $dte_                = $fila['dte'];
    $autorizacion_            = $fila['autorizacion'];
    $iva_             = $fila['iva'];
    $bruto_                = $fila['bruto'];
    
    $totalapagar_       = $fila['totalsinsaldoant'];
    $agencia_               = $fila['agencia'];
    $estado_               = $fila['estado'];
    $tipo_               = $fila['TIPO'];

    $fechaCertificacion_               = $fila['fechaCertificacion'];

  
    
    $totalIVA += $iva_;
    $totalBruto += $bruto_;
    $tottat += $totalapagar_;



    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(10, 7, $i, 1, 0, 'C');
    $pdf->Cell(12, 7, $trx_, 1, 0, 'C');
    $pdf->Cell(25, 7, utf8_decode($descripcion_), 1, 0, 'C');


    $pdf->Cell(15, 7, $inm_Id_, 1, 0, 'C');
    //$pdf->Cell(20, 7, $inm_IdGenerado_, 1, 0, 'C');
    $pdf->Cell(17, 7, $clp_NIT_, 1, 0, 'C');
     $pdf->Cell(20, 7, $cae_, 1, 0, 'C');
    $pdf->Cell(20, 7, $dte_, 1, 0, 'C');
    $pdf->Cell(60, 7, $autorizacion_, 1, 0, 'C');
    $pdf->Cell(20, 7, 'Q.' . number_format($iva_, 2), 1, 0, 'C');
    $pdf->Cell(25, 7, 'Q.' . number_format($bruto_, 2), 1, 0, 'C');

    $pdf->Cell(25, 7, 'Q.' . number_format($totalapagar_, 2), 1, 0, 'C');
    //$pdf->Cell(20, 7, $id_, 1, 0, 'C');
    $pdf->Cell(35, 7, $fechaCertificacion_, 1, 0, 'C');

    $pdf->Cell(30, 7, $agencia_, 1, 0, 'C');
    $pdf->Cell(15, 7, $estado_, 1, 0, 'C');
    $pdf->Cell(15, 7, $tipo_, 1, 1, 'C');




}
 
$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Subtotal: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Q.' . number_format($totalBruto, 2), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Total IVA: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Q.' . number_format($totalIVA, 2), 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Total: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Q.' . number_format($tottat, 2), 1, 1, 'C');



$pdf->Output();
 ?>