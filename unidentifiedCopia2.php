
<?php

require 'fpdf/fpdf.php';
include "conexion.php";
$pdf = new FPDF();

$pdf = new FPDF('L', 'mm', array(220,400));
$pdf->AddPage();




$busqueda = "SELECT * from cargaNoidentificados a order by fecha asc";
$buscar = sqlsrv_query($con, $busqueda);

$busqueda2 = "SELECT * from cargaNoidentificados a, ecuenta b
where tra_Codigo='CA' AND cast(a.Referencia2 as varchar) =cast(b.mov_NoDocto as varchar)
and  cast(Total2 as varchar) =cast(HABER as varchar) ";
$buscar2 = sqlsrv_query($con, $busqueda2);


$busqueda3 = "SELECT sum(CAST( REPLACE(TOTAL2,char(9),'') AS MONEY ))as Totalv2 from cargaNoidentificados";
$buscar3 = sqlsrv_query($con, $busqueda3);


$pdf->SetFont('Arial', 'B', 15);
$pdf->SetTextColor(2, 157, 116);
$pdf->Cell(0, 0, 'Reporte De Cargas De Pagos No Identificados', 0, 1, 'C');

$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetX(3);
$pdf->SetFillColor(232, 232, 232);
$pdf->SetTextColor(17, 13, 12);
$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(9, 5, 'No.', 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'Descripcion',1, 0, 'C', 1);
$pdf->Cell(16, 5, 'Agencia', 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'Fecha/Hora', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'Boleta', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'Terminal', 1, 0, 'C', 1);
$pdf->Cell(10, 5, 'trx', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'Factura', 1, 0, 'C', 1);
$pdf->Cell(35, 5, 'Lote', 1, 0, 'C', 1);
$pdf->Cell(20, 5, 'Fecha Corte', 1, 0, 'C', 1);
$pdf->Cell(10, 5, 'valor', 1, 0, 'C', 1);
$pdf->Cell(27, 5, 'Nombre Usuario', 1, 0, 'C', 1);
$pdf->Cell(30, 5, 'Referencia', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'Efectivo', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'CH.Propios', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'CH.Locales', 1, 0, 'C', 1);
$pdf->Cell(14, 5, 'Total', 1, 0, 'C', 1);
$pdf->Cell(13, 5, 'Valor 1', 1, 0, 'C', 1);
$pdf->Cell(13, 5, 'Valor 2', 1, 0, 'C', 1);
$pdf->Cell(14, 5, 'Valor 3', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'Total valor 2', 1, 0, 'C', 1);
$pdf->Cell(16, 5, 'Referencia 2', 1,1, 'C', 1);



$i = 0;

while ($fila = sqlsrv_fetch_array($buscar)) {
 //print_r($fila);
  
    $DESCRIPCION_ = $fila['DESCRIPCION'];
    $AGENCIA_    = $fila['AGENCIA'];
    $fecha_    = $fila['fecha'];
    $hora_       = $fila['hora'];
    $BOLETA_     = $fila['BOLETA'];
    $Terminal_   = $fila['Terminal'];
    $trx_        = $fila['trx'];
    $FACTURA_    = $fila['FACTURA '];
    $lote_       = $fila['lote'];
    $FECHADECORTE_  = $fila['FECHA DE CORTE'];
    $Valor_         = $fila['Valor'];
    $NOMBREUSUARIO_ = $fila['NOMBRE USUARIO'];
    $Referencia_    = $fila['Referencia'];
    $EFECTIVO_      = $fila['EFECTIVO'];
    $CH_PROPIOS     = $fila['CH.PROPIOS'];
    $CHLOCALES_     = $fila['CH.LOCALES'];
    $Total_     = $fila['Total'];
    $Valor1_    = $fila['Valor1'];
    $Valor2_    = $fila['Valor2'];
    $Valor3_    = $fila['Valor3'];
    $Referencia2_ = $fila['Referencia2'];
    $Total2_    = $fila['Total2'];
    
     while ($fila3 = sqlsrv_fetch_array($buscar3)) {
    $TotalV2_ = $fila3['Totalv2'];
    } 
  /* $busqueda4 = "SELECT * from ecuenta where tra_Codigo='CA' and USUARIO in('Banrural','Gyt') and mov_NoDocto=$Referencia2_ and haber=$Total2_";
$buscar4 = sqlsrv_query($con, $busqueda4);
   while ($fila4 = sqlsrv_fetch_array($buscar4)) {
   print_r($fila4);
    } */
  $i++;
  if(sqlsrv_query( $con, "SELECT * from ecuenta where tra_Codigo='CA' and USUARIO in('Banrural','Gyt') and mov_NoDocto='$Referencia2_' and haber=$Total2_") == true){
     
    $pdf->SetX(3);
    $pdf->SetFillColor(231, 251, 255);
    $pdf->SetDrawColor(11, 11, 11);
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->Cell(9, 10, $i, 1, 0, 'C','true');
    $pdf->Cell(20, 10, $DESCRIPCION_, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $AGENCIA_, 1, 0, 'C','true');
    $pdf->Cell(20, 10, $fecha_." ".$hora_, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $BOLETA_, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $Terminal_  ,1,0,'C','true');
    $pdf->Cell(10, 10, $trx_, 1, 0, 'C','true');
    $pdf->Cell(30, 10, $FACTURA_, 1, 0, 'C','true');
    $pdf->Cell(35, 10, $lote_, 1, 0, 'C','true');
    $pdf->Cell(20, 10, $FECHADECORTE_, 1, 0, 'C','true');
    $pdf->Cell(10, 10, $Valor_, 1, 0, 'C','true');
    $pdf->Cell(27, 10, $NOMBREUSUARIO_, 1, 0, 'C','true');
    $pdf->Cell(30, 10, $Referencia_  ,1,0,'C','true');
    $pdf->Cell(16, 10, $EFECTIVO_, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $CH_PROPIOS, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $CHLOCALES_, 1, 0, 'C','true');
    $pdf->Cell(14, 10, $Total_, 1, 0, 'C','true');
    $pdf->Cell(13, 10, $Valor1_, 1, 0, 'C','true');
    $pdf->Cell(13, 10, $Valor2_  ,1,0,'C','true');
    $pdf->Cell(14, 10, $Valor3_, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $Total2_, 1, 0, 'C','true');
    $pdf->Cell(16, 10, $Referencia2_, 1, 1, 'C','true');
      # code...
   }else{
    $pdf->SetX(3);
    $pdf->SetFont('Arial', '', 5);
    $pdf->Cell(9,  10, $i, 1, 0, 'C');
    $pdf->Cell(20, 10, $DESCRIPCION_, 1, 0, 'C');
    $pdf->Cell(16, 10, $AGENCIA_, 1, 0, 'C');
    $pdf->Cell(20, 10, $fecha_." ".$hora_, 1, 0, 'C'); 
    $pdf->Cell(16, 10, $BOLETA_, 1, 0, 'C');
    $pdf->Cell(16, 10, $Terminal_,1,0,'C');
    $pdf->Cell(10, 10, $trx_, 1, 0, 'C');
    $pdf->Cell(30, 10, $FACTURA_, 1, 0, 'C');
    $pdf->Cell(35, 10, $lote_, 1, 0, 'C');
    $pdf->Cell(20, 10, $FECHADECORTE_, 1, 0, 'C');
    $pdf->Cell(10, 10, $Valor_, 1, 0, 'C');
    $pdf->Cell(27, 10, $NOMBREUSUARIO_, 1, 0, 'C');
    $pdf->Cell(30, 10, $Referencia_  ,1,0,'C');
    $pdf->Cell(16, 10, $EFECTIVO_, 1, 0, 'C');
    $pdf->Cell(16, 10, $CH_PROPIOS, 1, 0, 'C');
    $pdf->Cell(16, 10, $CHLOCALES_, 1, 0, 'C');
    $pdf->Cell(14, 10, $Total_, 1, 0, 'C');
    $pdf->Cell(13, 10, $Valor1_, 1, 0, 'C');
    $pdf->Cell(13, 10, $Valor2_,1,0,'C');
    $pdf->Cell(14, 10, $Valor3_, 1, 0, 'C');
    $pdf->Cell(16, 10, $Total2_, 1, 0, 'C');
    $pdf->Cell(16, 10, $Referencia2_, 1, 1, 'C');
    }
   

 }   




    //$Total2_    = $fila2['Total2'];
    //$Referencia2_ = $fila['Referencia2'];
     
  
     

  




$pdf->Cell(50, 5, '', 0, 1);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(52, 10, 'Valor Total: ', 1, 0, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(26, 10, 'Q.' . number_format($TotalV2_, 2), 1, 0, 'C');


//$pdf->Cell(26, 10, $TotalV2_, 1, 1, 'C');


$pdf->Output();
?>

