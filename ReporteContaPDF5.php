
<?php
include 'conexion.php';

$Fecha  = $_REQUEST["Fecha_"];
$Fechaa = $_REQUEST["Fecha1_"];

header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=SerieMF/' . $Fecha . ' al ' . $Fechaa . '.xls');
header("Content-Type: text/html;charset=utf-8");

include "conexion1.php";
$con = mysqli_connect($host, $user) or die('Error en el Servidor');
session_start();
$userr = $_SESSION['user'];
if (empty($_SESSION['idUser'])) {
    header('location: index.html');
}


$con = sqlsrv_connect($serverName, $connectionInfo) or die('Error en el Servidor');

$Consulta = "SELECT a.dia_Fecha,dbo.alote(a.inm_id) as lote, dbo.recuperaNombreInmueble(a.inm_id) as nombre,
    a.tra_Codigo,a.tra_Descripcion,b.ser_corr,a.debe,a.haber
    from ecuenta a
    inner join resolucionAgMega b on
    a.inm_id = b.inm_id and a.rec_id = b.rec_id
    where 
    a.tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
    and cast(a.dia_Fecha as date) between '$Fecha' and '$Fechaa' and  a.codAgencia=3
    order by a.dia_Fecha,b.ser_corr";/*SELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,
tra_Descripcion,cae,debe,haber
    from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fechaa'  and codAgencia=3
    and 
    tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
    and cae in(select ser_corr from resolucionAgMega where resolucionAgMega.inm_id = ecuenta.inm_id 
    and cast(dia_Fecha as date) between '$Fecha' and '$Fechaa')
    order by dia_Fecha,caeSELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,tra_Descripcion,cae,debe,haber
from ecuenta where cast(dia_Fecha as date) between  '$Fecha' and '$Fechaa'
and codAgencia=3  and tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S')
    and dte in(select ser_corr from resolucionAgMega) 
order by dia_Fecha,cae*/

$R = sqlsrv_query($con, $Consulta);
echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption><font color='red' size='10'>Serie MF</font></caption>
    <tr>
        <td>Fecha</td>
        <td>Lote</td>
        <td>Nombre</td>
        <td>Codigo</td>
        <td>Descripcion</td>
        <td>Correlativo</td>
        <td>Debe</td>
        <td>Haber</td>

    </tr>";

while ($Fila = sqlsrv_fetch_array($R)) {

    $dia_Fecha_       = $Fila['dia_Fecha'];
    $fecha_           = $dia_Fecha_->format('Y-m-d');
    $lote_            = $Fila['lote'];
    $nombre_          = $Fila['nombre'];
    $tra_Codigo_      = $Fila['tra_Codigo'];
    $tra_Descripcion_ = $Fila['tra_Descripcion'];
    $dte_             = $Fila['ser_corr'];
    $debe_            = $Fila['debe'];
    $haber_           = $Fila['haber'];

    ?>

    <tr>
        <td><?php echo $fecha_; ?></td>
        <td style="mso-number-format:'@'"><?php echo $lote_; ?></td>
        <td><?php echo utf8_decode($nombre_); ?></td>
        <td ><?php echo $tra_Codigo_; ?></td>
        <td ><?php echo utf8_decode($tra_Descripcion_); ?></td>
         <td><?php echo $dte_; ?></td>
        <td ><?php echo $debe_; ?></td>
        <td ><?php echo $haber_; ?></td>
    </tr>


  <?php
}
echo "</table>  ";
sqlsrv_close($con);

?>









