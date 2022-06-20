
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
$pdf = new FPDF('L','mm','Legal');
$pdf->AddPage();
$Fecha  = $_REQUEST["Fecha_"];
$Fechaa = $_REQUEST["Fecha1_"];

$busqueda = "SELECT a.inm_id,dbo.alote(a.inm_id) as lote,
 a.dia_Fecha,a.tra_Codigo,a.tra_Descripcion,a.DEBE,a.HABER,a.USUARIO, a.usrAnulo,
dbo.recuperaNombreUsuario(a.usrAnulo) as anulo,a.fechaAnulacion,a.motDescripcion,
b.clp_NIT,b.autorizacion,a.estado
from ecuentaAnulacion a
left join felectronicaServicios b
on a.inm_id = b.inm_Id and a.id= b.id
where CAST(dia_Fecha as date) between '$Fecha' and '$Fechaa'
order by a.id";
$buscar = sqlsrv_query($con, $busqueda);

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Anulaciones '.$Fecha." A ".$Fechaa, 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFillColor(232, 232, 232);

$pdf->SetTextColor(17, 13, 8);
$pdf->SetFont('Arial', 'B', 7);
$pdf->Cell(10, 6, 'No.', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Id Inmueble', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(30, 6, 'Fecha', 1, 0, 'C', 1);
$pdf->Cell(10, 6, 'Codigo', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'Descripcion', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'DEBE', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'HABER', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Usuario', 1, 0, 'C', 1);
$pdf->Cell(10, 6, 'User A.', 1, 0, 'C', 1);
$pdf->Cell(25, 6, 'Anulo', 1, 0, 'C', 1);
$pdf->Cell(38, 6, 'Fecha Anulacion', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Mot. Descripcion', 1, 0, 'C', 1);
$pdf->Cell(55, 6, 'Autorizacion', 1, 0, 'C', 1);
$pdf->Cell(15, 6, 'Estado', 1, 1, 'C', 1);
$i=0;
while ($fila = sqlsrv_fetch_array($buscar)) {
	$i++;
    $inm_id_               = $fila['inm_id'];
    $lote_                 = $fila['lote'];
    $dia_Fecha_            = $fila['dia_Fecha'];
    $tra_Codigo_           = $fila['tra_Codigo'];
    $tra_Descripcion_      = $fila['tra_Descripcion'];
    $DEBE_                 = $fila['DEBE'];
    $HABER_                = $fila['HABER'];
    $USUARIO_            = $fila['USUARIO'];
    $usrAnulo_             = $fila['usrAnulo'];
    $cadena_nuevo_formato  = date_format($dia_Fecha_, "d/m/Y H:i:s");
    $anulo_                = $fila['anulo'];
    $fechaAnulacion_       = date_format($fila['fechaAnulacion'], "d/m/Y H:i:s");
    $motDescripcion_       = $fila['motDescripcion'];
    $autorizacion_         = $fila['autorizacion'];
    $estado_               = $fila['estado'];

    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetFont('Arial', '', 7);
    $pdf->Cell(10, 7, $i, 1, 0, 'C');
    $pdf->Cell(15, 7, $inm_id_, 1, 0, 'C');
    $pdf->Cell(20, 7, $lote_, 1, 0, 'C');
    $pdf->Cell(30, 7, $cadena_nuevo_formato, 1, 0, 'C');
    $pdf->Cell(10, 7, $tra_Codigo_, 1, 0, 'C');
    $pdf->Cell(40, 7, utf8_decode($tra_Descripcion_), 1, 0, 'C');
     $pdf->Cell(15, 7, 'Q.' . number_format($DEBE_, 2), 1, 0, 'C');
    $pdf->Cell(15, 7, 'Q.' . number_format($HABER_, 2), 1, 0, 'C');
    $pdf->Cell(25, 7, $USUARIO_, 1, 0, 'C');
    $pdf->Cell(10, 7, $usrAnulo_, 1, 0, 'C');
    $pdf->Cell(25, 7, $anulo_, 1, 0, 'C');
    $pdf->Cell(38, 7, $fechaAnulacion_, 1, 0, 'C');
    $pdf->Cell(20, 7, $motDescripcion_, 1, 0, 'C');
    $pdf->Cell(55, 7, $autorizacion_, 1, 0, 'C');
    $pdf->Cell(15, 7, $estado_, 1, 1, 'C');


}

$pdf->Output();
 ?>