<?php
    require 'fpdf/fpdf.php';   
    include("conexion.php");
setlocale(LC_TIME, "spanish");
 
    //$pdf = new FPDF('L','mm','letter');
    
    
    $id = $_GET["id"];
    $cae_ = $_GET["cae_"];
 
           


      $busquedaa = "SELECT  * from felectronicaServicios where inm_Id = '$id' and cae='$cae_'";
                        $buscara   = sqlsrv_query($con, $busquedaa);
        
        
 

  while ($fila = sqlsrv_fetch_array($buscara)) {
    $mes_act = $fila['mesactual'];
    $fecha1= $fila['fechafactura'];  
    $fecha = strftime("%d-%b-%Y %H:%M:%S", strtotime($fecha1));
    $fecha22=strftime("%d %b %Y ", strtotime($fecha1));
    //$fec_pag = $fila['fechapago'];
    $leyenda_ = $fila['leyenda'];
    $mes_id = $fila['mes'];
    $dte_ = $fila['dte'];
    $factura_ = $fila['factura'];
    $clp_nombre_ = $fila['clp_Nombre'];
    $vnit_ = $fila['vnit'];
    $inm_IdGe = $fila['inm_IdGenerado'];
    $coso_ = $fila['coso'];
    $tra_Descripcion_=$fila['tra_Descripcion'];
    $totalsinsaldoant_ = $fila['totalsinsaldoant'];
   
    $totalapagar_ = $fila['totalapagar'];
    $letras_ = $fila['letras'];
    $resolu_ = $fila['resolucion']; 
    $autorizacion_ = $fila['autorizacion']; 
    //$autorizacion_ = "2FAC6B80-0B5A-430A-999A-A2C8386E1FD1"; 
    //$serie_ = "2FAC6B80";
    $leyenda2_ = mb_strtoupper($leyenda_);
    $serie_ = $fila['cae'];
    $fechaCertificacionn =$fila['fechaCertificacion'];
    $fechaCertificacion_ =strftime("%d-%b-%Y %H:%M:%S", strtotime($fechaCertificacionn));
    $qwf_ = $fila['qwf'];
     //$qwf_ = "";
    
                
                }

if (empty($autorizacion_)) {
 header('Location:' . getenv('HTTP_REFERER'));
}else{



                $pdf = new FPDF('P', 'mm', array(216, 140));
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetAutoPageBreak(true,5);
                $pdf->SetFont('Arial','',12);

              $pdf->Image('assets/img/byn2.jpg', 1, 1, 140 );
           
                $pdf->SetFont('Arial', '', 9);
                $pdf->SetXy(34, 12);
                $pdf->Cell( 20, 3, utf8_decode("SISTEMA DE AGUA SAN CRISTOBAL "), 0, 'C', '');
                $pdf->SetXy(34, 16);
                $pdf->Cell( 30, 3, utf8_decode("INTERVENCION MUNICIPAL"), 0, 'C', '');
                $pdf->SetXy(34, 20);
                $pdf->Cell( 30, 3, utf8_decode("Nit emisor: 8338817 "), 0, 'C', '');
                $pdf->SetXy(34, 23);
                $pdf->Cell( 30, 3, utf8_decode("4ta Calle 19-68 Zona 8 de Mixco"), 0, 'C', '');
                $pdf->SetXy(34, 26);
                $pdf->Cell( 30, 3, utf8_decode("Ciudad San Cristóbal, Guatemala "), 0, 'C', '');
                $pdf->SetXy(34, 30);
                $pdf->Cell( 30, 3, utf8_decode("PBX:2376-4000 "), 0, 'C', '');

                $pdf->SetFont('Arial', 'B', 8.5);
                $pdf->SetXy(100, 12);
               // $pdf->Cell( 30, 3, utf8_decode("Ref.Bancos"), 0, 'C', '');
                $pdf->SetXy(67, 30);
                $pdf->Cell( 30, 3, utf8_decode("Número De Autorización:"), 0, 'C', '');
                $pdf->SetXy(67, 36.5);
                $pdf->Cell( 30, 3, utf8_decode("Serie:"), 0, 'C', '');
                $pdf->SetXy(67, 39.5);
                $pdf->Cell( 30, 3, utf8_decode("Número De DTE:"), 0, 'C', '');
                $pdf->SetXy(67, 42.5);
                $pdf->Cell( 30, 3, utf8_decode("Fecha y Hora De Emisión:"), 0, 'C', '');
                $pdf->SetXy(67, 49);
                $pdf->Cell( 30, 3, utf8_decode("Fecha y Hora De Certificación:"), 0, 'C', '');
                $pdf->SetXy(46, 39);
                $pdf->Cell( 30, 3, utf8_decode(""), 0, 'C', '');
                $pdf->SetXy(46, 39);
                $pdf->Cell( 30, 3, utf8_decode(""), 0, 'C', '');

                $pdf->SetFont('Arial', '', 8.5);
                $pdf->SetXy(118, 12);
                //$pdf->Cell( 30, 3, utf8_decode("$factura_"), 0, 'C', '');
                $pdf->SetXy(67, 33.5);
                $pdf->Cell( 30, 3, utf8_decode(" $autorizacion_"), 0, 'C', '');
                $pdf->SetXy(76, 36.5);
                $pdf->Cell( 30, 3, utf8_decode("  $serie_"), 0, 'C', '');
                $pdf->SetXy(93, 39.5);
                $pdf->Cell( 30, 3, utf8_decode("  $dte_"), 0, 'C', '');
                $pdf->SetXy(67, 46);
                $pdf->Cell( 30, 3, utf8_decode("$fecha1"), 0, 'C', '');
                $pdf->SetXy(67, 52);
                $pdf->Cell( 30, 3, utf8_decode("$fechaCertificacionn"), 0, 'C', '');

                $pdf->SetFont('Arial', 'B', 8);
                $pdf->SetXy(7, 36);
                $pdf->Cell( 30, 3, utf8_decode("NIT Receptor:"), 0, 'C', '');
                $pdf->SetXy(7, 40);
                $pdf->Cell( 30, 3, utf8_decode("Nombre Receptor:"), 0, 'C', '');
                $pdf->SetXy(7, 56);
                $pdf->Cell( 30, 3, utf8_decode("Dirección:"), 0, 'C', '');

                $pdf->SetFont('Arial', '', 9);
                $pdf->SetXy(29, 36);
                $pdf->Cell( 30, 3, utf8_decode("$vnit_"), 0, 'C', '');
                
                $pdf->SetXy(7, 44);
                $pdf->MultiCell(55, 3, utf8_decode("$clp_nombre_ "), 0, 'L', '');
                 $pdf->SetFont('Arial', '', 8);
                $pdf->SetXy(7, 60);
                $pdf->Cell( 30, 3, utf8_decode("$coso_ "), 0, 'C', '');
                 $pdf->SetFont('Arial', '', 9);
                $pdf->SetXy(30, 65);
                $pdf->Multicell( 40, 3, utf8_decode("$mes_act"), 0, 'C', '');
                $pdf->SetXy(92, 67);
                //$pdf->Multicell( 30, 3, utf8_decode("$fec_pag"), 0, 'C', '');


                
                 $pdf->SetFont('Arial', '', 9);
                $pdf->SetXy(7, 130);
                $pdf->Cell(30, 3, utf8_decode("Puede efectuar su pago"), 0, 'C', '');
                $pdf->SetXy(7, 133);
                $pdf->Cell(30, 3, utf8_decode("en agencias Banrural "), 0, 'C', '');
                $pdf->SetXy(7, 137);
                $pdf->Cell(30, 3, utf8_decode("ATX 249-152"), 0, 'C', '');
                $pdf->SetFont('Arial', '', 6);
                $pdf->SetXy(7, 140);
                $pdf->Cell(30, 3, utf8_decode("Excento de ISR según decreto"), 0, 'C', '');
                $pdf->SetXy(7, 142);
                $pdf->Cell(30, 3, utf8_decode("número 10-2012 Capítulo II Artículo"), 0, 'C', '');
                $pdf->SetXy(7, 144);
                $pdf->Cell(30, 3, utf8_decode("11 #1"), 0, 'C', '');
                $pdf->SetXy(7, 152);
                $pdf->Image('banrural.jpg' , 41.7 ,128, 14 , 7,'JPG');
                $pdf->Image('gyt2.png' , 32 ,131, 25 , 14,'png');
                $pdf->Image("data:image/png;base64,$qwf_",55 ,121.5, 31 , 31, "png");
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetXy(7, 148);
                $pdf->Cell(30, 3, utf8_decode("Paga en línea"), 0, 'C', '');
                $pdf->SetXy(7, 151);
                $pdf->Cell(30, 3, utf8_decode("https://sascim.com.gt"), 0, 'C', '');
                $pdf->SetXy(55, 137);
                $pdf->Image('visa.jpg' , 35 ,145, 20 , 6,'JPG');
                
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->SetXy(100, 130);
                $pdf->Cell(30, 3, utf8_decode("ID: $id"), 0, 'C', '');
                $pdf->SetFont('Arial', 'B', 9);
                $pdf->SetXy(98, 135);
                $pdf->Cell(30, 3, utf8_decode("Código de Lote:"), 0, 'C', '');
                $pdf->SetXy(100, 139);
                $pdf->Cell(30, 3, utf8_decode("$inm_IdGe"), 0, 'C', '');
                 $pdf->SetXy(50, 167);
                $pdf->Image('IconFel.jpeg' , 100.5 ,142.5, 20 , 14,'JPEG');
                $pdf->SetFont('Arial', '', 6);
                $pdf->SetXy(60, 151);
                $pdf->Cell(30, 3, utf8_decode(""), 0, 'C', '');
                $pdf->SetXy(40, 156);
                $pdf->Cell(30, 3, utf8_decode("Nit Certificador:104747498  Nombre Certificador: SIGSA"), 0, 'C', '');
                $pdf->SetFont('Arial', '', 10);
                $pdf->SetXy(100, 142);
                $pdf->Line(5, 160, 210-75, 160);
                

                      $pdf->SetXy(4, 163);
                      $pdf->Cell( 30, 3, utf8_decode("Fecha y Hora De Certificación: $fechaCertificacionn "), 0, 'C', '');
                      $pdf->SetFont('Arial', 'B', 9);
                      $pdf->SetXy(50, 168);
                      $pdf->Cell(30, 3, utf8_decode("Código de lote: $inm_IdGe ID: $id"), 0, 'C', '');
                      $pdf->SetXy(80, 167);
                      $pdf->Image('logosac.jpg' , 120 ,166, 14 , 14,'JPG');
                      $pdf->SetFont('Arial', '', 9);
                      $pdf->SetXy(4, 168);
                      //$pdf->Cell(30, 3, utf8_decode("Ref.Bancos:"), 0, 'L', '');
                      $pdf->SetXy(4, 171.5);
                     // $pdf->Cell(30, 3, utf8_decode("$factura_"), 0, 'L', '');
                      $pdf->SetXy(4, 176.5);
                      $pdf->Cell( 30, 3, utf8_decode("Nombre Receptor: "), 0, 'C', '');
                      $pdf->SetXy(4, 180); 
                      $pdf->Cell( 30, 3, utf8_decode("$clp_nombre_ "), 0, 'C', '');
                      $pdf->SetXy(4, 185);
                      $pdf->Cell( 30, 3, utf8_decode("NIT Receptor: "), 0, 'C', '');
                      $pdf->SetXy(4, 189);
                      $pdf->Cell( 30, 3, utf8_decode("$vnit_ "), 0, 'C', '');
                      $pdf->SetXy(35, 185);
                      $pdf->Cell( 30, 3, utf8_decode("Dirección: "), 0, 'C', '');
                       $pdf->SetFont('Arial', '', 8);
                      $pdf->SetXy(30, 189);
                      $pdf->Cell( 30, 3, utf8_decode("$coso_"), 0, 'C', '');
                       $pdf->SetFont('Arial', '', 9);
                     
                $pdf->SetXy(112,80);    
                $pdf->Cell(10,12 , number_format("$totalapagar_",2,'.',''), 0,'L');
                $pdf->SetFont('Arial','',6);
                $pdf->SetXy(32,115);    
                $pdf->Cell(10,10 , "$letras_", 0,0,'L');
                $pdf->SetFont('Arial','',8);
                $pdf->SetXy(20,208);    
                $pdf->Cell(0,0 , number_format("$totalapagar_",2,'.',''), 0,'L');
                $pdf->SetFont('Arial','',6.5);
                $pdf->SetXy(58,208);    
                $pdf->Cell(0,0 , "$letras_", 0,0,'L');
                $pdf->SetFont('Arial','',8);
                $pdf->SetXy(1,93);  
    $pdf->Cell(84,0 , utf8_decode("$tra_Descripcion_"), 0,0,'C');
                $pdf->Cell(60,0 , number_format("$totalapagar_",2,'.',''), 0,0,'C');
                $pdf->SetFillColor(51, 84, 215);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetXy(58,75);
                $pdf->Cell(50, 5, '', 0, 1);
                $pdf->Cell(95,7 ,utf8_decode( "                                DESCRIPCION"), 1,0,'L',1);
                $pdf->Cell(25,7 , "VALOR", 1,0,'C',1); 
                $pdf->SetTextColor(17, 13, 12);
                $pdf->SetXy(58,75);
                $pdf->Cell(50, 5, '', 0, 1);
                $pdf->Cell(95,35 , "", 1,0,'C');
                $pdf->Cell(25,35 , "", 1,0,'C');
                $pdf->SetXy(58,110);
                $pdf->Cell(50, 5, '', 0, 1);
                $pdf->SetFont('Arial','',6);
                $pdf->Cell(80,8 , "Cantidad en letras:", 1,0,'L');
                $pdf->SetFont('Arial','',8);
                $pdf->SetTextColor(255, 255, 255);
                $pdf->Cell(15,8 , "Total Q.", 1,0,'C',1);
                $pdf->SetTextColor(17, 13, 12);
                $pdf->Cell(25,8 , number_format("$totalapagar_",2,'.',''), 1,0,'C');
                $pdf->SetFillColor(51, 84, 215);
                $pdf->SetTextColor(255, 255, 255);
                
                $pdf->SetXy(58,192);
                $pdf->Cell(50, 5, '', 0, 1);
                $pdf->Cell(45,7 , "         TOTAL A PAGAR", 1,0,'L',1);
                $pdf->Cell(75,7 , "TOTAL EN LETRAS", 1,0,'C',1);
                $pdf->SetTextColor(17, 13, 12);
                $pdf->SetXy(58,199);
                $pdf->Cell(50, 5, '', 0, 1);
                $pdf->Cell(45,7 , "", 1,0,'C');
                $pdf->Cell(75,7 , "", 1,0,'C');


                $pdf->Output();}