
<?php
include('conexion4.php');
$Fecha = $_REQUEST["Fecha_"];
$Fechaa = $_REQUEST["Fecha1_"];
$combo = $_REQUEST["Combo_"];
  
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=Planilla/'.$Fecha.' al '.$Fechaa.'.xls');
header("Content-Type: text/html;charset=utf-8");

 

   $Consulta = "SELECT distinct modcpl_dpl,codemp_dpl,nomemp_dpl as NombreDelTrabajador,subase_dpl as SalarioEnQuetzales,
diatra_dpl as DiasTrabajados,horaor_dpl as Ordinarias, horaex_dpl as ExtraOrdinarias,
sldord_dpl as Ordinario, slexor_dpl as ExtraOrdinario, devtot_dpl AS SalarioTotal,
devtot_dpl as SalarioNeto, igss_dpl as IGSS,otrdes_dpl as Descuentos,presta_dpl as Prestamos,
antqui_dpl as AnticipoQuincenal, totdes_dpl as TotalDeduciones, bonifi_dpl as Bonificacion,
sliqui_dpl as LiquidoArecibir,perini_dpl,peffin_dpl
 from [CONTA ].dbo.p10 where modcpl_dpl='P' and codjor_dpl=$combo AND
 cast(perini_dpl as date)>='$Fecha'
and cast(peffin_dpl as date)<='$Fechaa'
order by codemp_dpl,PERINI_DPL,PEFFIN_DPL";


      $R=sqlsrv_query($con,$Consulta);
      echo "<table border='1' cellpadding='2' cellspacing='0' width='100%'>
   <caption><font color='red' size='10'>Planilla</font></caption>
    <tr>
        <td>codemp_dpl</td>
        <td>NombreDelTrabajador</td>
        <td>SalarioEnQuetzales</td>
        <td>DiasTrabajados</td>
        <td>Ordinarias</td>
        <td>ExtraOrdinarias</td>
        <td>Ordinario</td>
        <td>ExtraOrdinario</td>
         <td>SalarioTotal</td>
        <td>SalarioNeto</td>
        <td>IGSS</td>
        <td>Descuentos</td>
         <td>Prestamos</td>
        <td>AnticipoQuincenal</td>
        <td>TotalDeduciones</td>
    
        <td>Bonificacion</td>
        <td>LiquidoArecibir</td>
        <td>perini_dpl</td>
        <td>peffin_dpl</td>
     
    </tr>";

      while($Fila=sqlsrv_fetch_array($R)) {
        

            $codemp_dpl_ = $Fila['codemp_dpl']; 
         
            $NombreDelTrabajador_ = $Fila['NombreDelTrabajador'];
         
            $SalarioEnQuetzales_ = $Fila['SalarioEnQuetzales']; 
            $DiasTrabajados_ = $Fila['DiasTrabajados'];
            $Ordinarias = $Fila['Ordinarias']; 
      
            $ExtraOrdinarias_ = $Fila['ExtraOrdinarias'];
            $Ordinario_ = $Fila['Ordinario'];
            $ExtraOrdinario_ = $Fila['ExtraOrdinario']; 
            $SalarioTotal_ = $Fila['SalarioTotal'];
            $SalarioNeto_ = $Fila['SalarioNeto']; 
      
            $IGSS_ = $Fila['IGSS'];
            $Descuentos_ = $Fila['Descuentos'];
            $Prestamos_ = $Fila['Prestamos']; 
            $AnticipoQuincenal_ = $Fila['AnticipoQuincenal'];
            $TotalDeduciones_ = $Fila['TotalDeduciones']; 
            $Bonificacion_ = $Fila['Bonificacion'];
            $LiquidoArecibir_ = $Fila['LiquidoArecibir'];
            $perini_dpl_ = $Fila['perini_dpl']->format("Y-m-d"); 
            $peffin_dpl_ = $Fila['peffin_dpl']->format("Y-m-d");
           
      ?>      

    <tr>
        <td><?php echo $codemp_dpl_ ; ?></td>
        <td><?php echo $NombreDelTrabajador_ ; ?></td>
        <td><?php echo $SalarioEnQuetzales_ ; ?></td>
        <td><?php echo $DiasTrabajados_ ; ?></td>
        <td><?php echo $Ordinarias ; ?></td>
        <td><?php echo $ExtraOrdinarias_ ; ?></td>
        <td><?php echo $Ordinario_ ; ?></td>
        <td><?php echo $ExtraOrdinario_ ; ?></td>
        <td><?php echo $SalarioTotal_ ; ?></td>
        <td><?php echo $SalarioNeto_ ; ?></td>
        <td><?php echo $IGSS_ ; ?></td>
        <td><?php echo $Descuentos_ ; ?></td>
        <td><?php echo $Prestamos_ ; ?></td>
        <td><?php echo $AnticipoQuincenal_ ; ?></td>
        <td><?php echo $TotalDeduciones_ ; ?></td>
        <td><?php echo $Bonificacion_ ; ?></td>
        <td><?php echo $LiquidoArecibir_ ; ?></td>
        <td><?php echo $perini_dpl_ ; ?></td>
        <td><?php echo $peffin_dpl_ ; ?></td>
        
    </tr>


  <?php  
   }
   echo "</table>  ";
      sqlsrv_close($con);

      ?>
                       
                      
                      
    





