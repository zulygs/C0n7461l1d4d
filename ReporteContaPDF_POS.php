
<?php

require 'fpdf/fpdf.php';
include "conexion.php";
$pdf = new FPDF();
$pdf = new FPDF('L', 'mm', 'Legal');
$pdf->AddPage();
$Fecha  = $_REQUEST["Fecha_"];
//$Fechaa = $_REQUEST["Fecha1_"];

$busqueda = "SELECT a.tip_id,dbo.devuelveTipoPago(a.tip_id) as POS, 
  a.ban_id,dbo.devuelveNombreBco(a.ban_id) as banco,det_NoDocumento,det_Propietario,det_NoAutorizacion as tarjeta,
  det_FechaDocumento,a.det_MontoCancelado,b.clp_id as ID,dbo.alote(b.clp_id) as lote,dbo.recuperaNombreInmueble(b.clp_id) as nombre,
  b.rec_usuario, dbo.recuperaNombreUsuario(b.rec_usuario) as cajero, b.emp_id, dbo.devuelveCodigoAgencia(b.emp_id) as agencia
 from pdv_DetalleFormaPago a
join pdv_RecibosDeCaja b on a.rec_id = b.rec_id
where a.tip_id=4 and cast(rec_fechaHoraSistema as date) ='$Fecha' order by  a.det_NoDocumento";
$total  = 0;
$total2 = 0;
$no_    = 0;
$buscar = sqlsrv_query($con, $busqueda);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Pagos En POS ', 0, 1, 'C');

$pdf->Cell(5, 5, '', 0, 1);
$pdf->SetFillColor(232, 232, 232);

$pdf->SetTextColor(17, 13, 12);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 6, 'ID Tip', 1, 0, 'C', 1);
$pdf->Cell(37, 6, 'POS', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Banco', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'No.Doc', 1, 0, 'C', 1);
$pdf->Cell(31, 6, 'Propietario', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Tarjeta', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Fecha Doc.', 1, 0, 'C', 1);
$pdf->Cell(18, 6, 'Monto', 1, 0, 'C', 1);
$pdf->Cell(12, 6, 'ID', 1, 0, 'C', 1);

$pdf->Cell(20, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'Nombre', 1, 0, 'C', 1);
$pdf->Cell(10, 6, 'User', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Cajero', 1, 0, 'C', 1);
//$pdf->Cell(10, 6, 'Emp.ID', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Agencia', 1, 1, 'C', 1);

while ($fila = sqlsrv_fetch_array($buscar)) {
    $tip_id_               = $fila['tip_id'];
    $POS_                 = $fila['POS'];
    $banco_            = $fila['banco'];
    $det_NoDocumento_           = $fila['det_NoDocumento'];
    $det_Propietario_                = $fila['det_Propietario'];
    $tarjeta_            = $fila['tarjeta'];
    $det_FechaDocumento          = $fila['det_FechaDocumento'];
    $det_MontoCancelado_                  = $fila['det_MontoCancelado'];
    $ID_                  = $fila['ID'];
    $lote_                  = $fila['lote'];
    $nombre_                  = $fila['nombre'];
    $rec_usuario_                  = $fila['rec_usuario'];
    $cajero_                  = $fila['cajero'];
    $emp_id_                  = $fila['emp_id'];
    $agencia_                 = $fila['agencia'];
    $cadena_nuevo_formato  = date_format($det_FechaDocumento, "d/m/Y "); 
    $total += $det_MontoCancelado_;
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(10, 7, $tip_id_, 1, 0, 'C');
    $pdf->Cell(37, 7, $POS_, 1, 0, 'C');
    $pdf->Cell(40, 7, $banco_, 1, 0, 'C');
    $pdf->Cell(15, 7, $det_NoDocumento_, 1, 0, 'C');
    $pdf->Cell(31, 7, $det_Propietario_, 1, 0, 'C');
    $pdf->Cell(15, 7, $tarjeta_, 1, 0, 'C');
    $pdf->Cell(20, 7, $cadena_nuevo_formato, 1, 0, 'C');
    $pdf->Cell(18, 7, 'Q.' . number_format($det_MontoCancelado_, 2), 1, 0, 'C');
    $pdf->Cell(12, 7, $ID_, 1, 0, 'C');

    $pdf->Cell(20, 7, $lote_, 1, 0, 'C');
    $pdf->Cell(80, 7, utf8_decode($nombre_), 1, 0, 'C');
    $pdf->Cell(10, 7, $rec_usuario_, 1, 0, 'C');
    $pdf->Cell(20, 7, $cajero_, 1, 0, 'C');
   // $pdf->Cell(10, 7, $emp_id_, 1, 0, 'C');
    $pdf->Cell(30, 7, $agencia_, 1, 1, 'C');

}
$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Valor Total: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(26, 10, 'Q.' . number_format($total, 2), 1, 0, 'C');
$pdf->SetFont('Arial', 'B', 12);

$pdf->Output();
