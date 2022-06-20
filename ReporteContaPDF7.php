
<?php
include 'conexion.php';

$Fecha  = $_REQUEST["Fecha_"];
$Fecha1 = $_REQUEST["Fecha1_"];
$CodAgen = $_REQUEST["Codigo"];
if ($CodAgen==2) {
    $Nombre="SankrisMall";
    $serie="SK";
}else if($CodAgen==3){
    $Nombre="Mega";
    $serie="MF";
}
else if($CodAgen==4){
    $Nombre="Panorama";
    $serie="";
}else if ($CodAgen==0) {
    $Nombre="Central";
    $serie="";
}

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=NotaCredito/'. $Nombre.' '. $Fecha . ' al ' . $Fecha1 . '.xls');
header("Content-Type: text/html;charset=utf-8");


include "conexion1.php";
$con = mysqli_connect($host, $user) or die('Error en el Servidor');
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');}

?>
        <?php

$con = sqlsrv_connect($serverName, $connectionInfo) or die('Error en el Servidor');
if ($CodAgen == 2 ||$CodAgen == 3 ||$CodAgen == 4 ) {
    $Consulta = "SELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,tra_Descripcion,mov_NoDocto,dte,debe,haber,(select SUM(haber) from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fecha1' and tra_Codigo='NC' and codAgencia='$CodAgen')as sumaT
from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fecha1' and tra_Codigo='NC' and codAgencia='$CodAgen'
order by dia_Fecha";
}else {
    $Consulta = "SELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,tra_Descripcion,mov_NoDocto,dte,debe,haber,(select SUM(haber) from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fecha1' and tra_Codigo='NC' and codAgencia NOT IN(2,3,4)) as sumaT
from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fecha1' and tra_Codigo='NC' and codAgencia NOT IN(2,3,4)
order by dia_Fecha";
}


$R = sqlsrv_query($con, $Consulta);
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption><font color='red' size='10'>Notas De Credito $serie</font></caption>
    <tr>
    
     <td>No.</td>
        <td>Fecha</td>
        <td>Lote</td>
        <td>Nombre</td>
        <td>Codigo</td>
        <td>Descripcion</td>
        <td>Numero</td>
        <td>Dte</td>
        <td>Debe</td>
        <td>Haber</td>
        

    </tr>";
    $i=0;
    $i++;
$english_format_number=0;
while ($Fila = sqlsrv_fetch_array($R)) {

    $dia_Fecha_       = $Fila['dia_Fecha'];
    $fecha_           = $dia_Fecha_->format('Y-m-d');
    $lote_            = $Fila['lote'];
    $nombre_          = $Fila['nombre'];
    $tra_Codigo_      = $Fila['tra_Codigo'];
    $tra_Descripcion_ = $Fila['tra_Descripcion'];
    $dte_             = $Fila['dte'];
    $debe_            = $Fila['debe'];
    $haber_           = $Fila['haber'];
    $mov_NoDocto_           = $Fila['mov_NoDocto'];
    $sumaT_           = $Fila['sumaT'];
    $total=$sumaT_;
    $english_format_number = number_format($total, 2, '.', '');
    ?>
    

    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $fecha_; ?></td>
        <td style="mso-number-format:'@'"><?php echo $lote_; ?></td>
        <td><?php echo utf8_decode($nombre_); ?></td>
        <td ><?php echo $tra_Codigo_; ?></td>
        <td ><?php echo utf8_decode($tra_Descripcion_); ?></td>
        <td><?php echo $mov_NoDocto_; ?></td>
        <td><?php echo $dte_; ?></td>
        <td ><?php echo $debe_; ?></td>
        <td ><?php echo $haber_; ?></td>
    </tr>
   


  <?php

}


 echo "<tr>
 <td>  </td>
 <td>  </td>
 <td>  </td>
 <td>  </td>
 <td>  </td>
 <td>  </td>
 <td>  </td>
 <td>  </td>

       
    <td> Total: </td>
        <td> Q.$english_format_number </td>
        
    </tr>";

echo "</table>  ";
sqlsrv_close($con);

?>









