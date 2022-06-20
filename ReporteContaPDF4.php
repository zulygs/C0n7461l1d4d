
<?php
  include('conexion.php');

     
       $Fecha = $_REQUEST["Fecha_"];
       $Fechaa = $_REQUEST["Fecha1_"];
  
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=SerieSM/'.$Fecha.' al '.$Fechaa.'.xls');
header("Content-Type: text/html;charset=utf-8");

  include("conexion1.php");
  $con = mysqli_connect($host,$user) or die ('Error en el Servidor');
    session_start();
    $userr=$_SESSION['user'];
    if (empty($_SESSION['idUser'])) {
        header('location: index.html'); }
 ?> 
 <?php  
   $con = sqlsrv_connect( $serverName, $connectionInfo) or die ('Error en el Servidor');
   $Consulta = "SELECT dia_Fecha,dbo.alote(inm_id) as lote, dbo.recuperaNombreInmueble(inm_id) as nombre, tra_Codigo,tra_Descripcion,dte,debe,haber
    from ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fechaa' and codAgencia=2  and tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') 
    order by dia_Fecha,dte";

          

    $R=sqlsrv_query($con,$Consulta);

   $Consulta2 = "SELECT dia_Fecha,COUNT(*)as total FROM ecuenta where cast(dia_Fecha as date) between '$Fecha' and '$Fechaa' and codAgencia=2  and tra_Codigo in(select tra_Codigo from agu_TransaccionesCaja where genfesn='S') group by dia_Fecha
     ";

      $R2=sqlsrv_query($con,$Consulta2);

      echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
      <caption><font color='red' size='10'>Serie SM</font></caption>
      <tr>
        <td>Fecha</td>
        <td>Lote</td>
        <td>Nombre</td>
        <td>Codigo</td>
        <td>Descripcion</td>
        <td>Dte</td>
        <td>Debe</td>
        <td>Haber</td>
      </tr>
      ";

      while($Fila=sqlsrv_fetch_array($R)) {

            $dia_Fecha_ = $Fila['dia_Fecha']; 
             $fecha_ = $dia_Fecha_->format('Y-m-d');
            $lote_ = $Fila['lote'];
            $nombre_ = $Fila['nombre'];
            $tra_Codigo_ = $Fila['tra_Codigo']; 
            $tra_Descripcion_ = $Fila['tra_Descripcion'];
            $dte_ = $Fila['dte'];  
            $debe_ = $Fila['debe']; 
            $haber_ = $Fila['haber'];
            
            
 while ($Fila2=sqlsrv_fetch_array($R2)) {
                  $total_ = $Fila2['total'];
                  $dia_Fecha_ = $Fila2['dia_Fecha']; 
                  $fecha_ = $dia_Fecha_->format('Y-m-d');      
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
    <tr>
        <td><?php echo  $fecha_ ?></td>
        <td><?php echo  $total_ ?></td>    
    </tr>   
    </tr>

  <?php  
   }  
    }
  echo "
      </table>  ";
  sqlsrv_close($con);

      ?>
                       
                      
                      
    





