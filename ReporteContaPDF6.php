
<?php
  include('conexion.php');

     
       $Fecha = $_REQUEST["Fecha_"];

  $dte_Factura='Dte';
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=SerieCT/'.$Fecha.'.xls');
header("Content-Type: text/html;charset=utf-8");

 include("conexion1.php");
  $con = mysqli_connect($host,$user) or die ('Error en el Servidor');
    session_start();
    $userr=$_SESSION['user'];
    if (empty($_SESSION['idUser'])) {
        header('location: index.html'); 
    }

   $con = sqlsrv_connect( $serverName, $connectionInfo) or die ('Error en el Servidor');
   $Consulta = "SELECT CONVERT(VARCHAR(10), dia_Fecha, 103) as fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,tra_Descripcion,dte,mov_NoDocto,debe 
from ecuenta where cast(dia_Fecha as date) = '$Fecha'    and tra_Codigo='LC'  order by dte";


      $R=sqlsrv_query($con,$Consulta);
      $busqueda2 = "SELECT sum(debe) as total 
from ecuenta where cast(dia_Fecha as date) = '$Fecha'   and tra_Codigo='LC'";
$buscar2 = sqlsrv_query($con, $busqueda2);
if ($Fecha >= '2020-09-11') {
  $dte_Factura='Factura';
}
      echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption><font color='red' size='10'>Serie CT</font></caption>
    <tr>
        <td>Fecha</td>
        <td>Lote</td>
        <td>Nombre</td>
        <td>Codigo</td>
        <td>Descripcion</td>
        <td>$dte_Factura</td>
        <td>Valor</td>
       
     
    </tr>";

      while($Fila=sqlsrv_fetch_array($R)) {

            $dia_Fecha_ = $Fila['fecha']; 
             
            $lote_ = $Fila['lote'];
            $nombre_ = $Fila['nombre'];
            $tra_Codigo_ = $Fila['tra_Codigo']; 
            $tra_Descripcion_ = $Fila['tra_Descripcion'];
             if ($Fecha >= '2020-09-11') {
              $dte_ = $Fila['mov_NoDocto']; 
            }else{
              $dte_ = $Fila['dte']; 
            }
             
            $debe_ = $Fila['debe']; 
       
 $String = '=""&B:B';


 

# See http://www.php.net/manual/en/language.types.string.php
# $String{} is deprecated as of PHP 6.


 

        
        ?>    


    <tr>
        <td><?php echo $dia_Fecha_; ?></td>
        <td style="mso-number-format:'@'"><?php echo  "$lote_"; ?></td><!--para quitar notacion cientifica-->
        <td><?php echo utf8_decode($nombre_); ?></td>
        <td ><?php echo $tra_Codigo_; ?></td>
        <td ><?php echo utf8_decode($tra_Descripcion_); ?></td>
         <td><?php echo $dte_; ?></td>
        <td ><?php echo $debe_; ?></td>
        
    </tr>


  <?php  
   }
   while ($Fila2=sqlsrv_fetch_array($buscar2)) {
    $t=$Fila2['total'];
     $total_ = number_format($t,2,'.',','); 
   }
   echo "
    <tr>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td ></td>
    <td >Total:</td>

    <td >$total_</td>
    </tr>


   </table>  ";
      sqlsrv_close($con);

      ?>
                       
                      
                      
    





