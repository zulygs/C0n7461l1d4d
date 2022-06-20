<?php
$alert = '';
$alert2 = '';
$valor = 0;
//$vappp=0;
include "conexion.php";
session_start();
$userr = $_SESSION['user'];
if(!isset($_SESSION['idUser'])){
  header('location: index.html');
} else {
  $alert = '';
  if (isset($_POST['detalle'])){
    if (empty($_POST['fecha1'])&&empty($_POST['fecha2'])) {
      $alert = 'Seleccione las Fechas';
    }else{
      $valor=1;
      $fecha1=$_POST['fecha1'];
       $fecha2=$_POST['fecha2'];
      }
    }
  }
   header("Cache-Control: no-cache, must-revalidate");
   ?>
  <!DOCTYPE html>
<meta charset="UTF-8">
<html lang="es">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logoo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Contabilidad Sascim
  </title>
 <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="assets/css/util.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <?php include "includes/scriptes.php";?>
  <?php include "includes/functions.php"?>








  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>







  <style type="text/css">
    * {
      margin:0px;
      padding:0px;
    }
    ul, ol {
      list-style:none;
    }
    .nav li a {
      background-color:gray;
      color:#fff;
      text-decoration:none;
      padding:10px 12px;
      display:block;
    }
    .nav li a:hover {
      background-color:#434343;
    }
    .nav li ul {
      display:none;
      min-width:140px;
    }
    .nav li:hover > ul {
        display:block;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      setTimeout(function() {
        $(".content123").fadeOut(1500);
      },3000);
    });
  </script>
  <style type="text/css">
    #lateral { height: 1765px; }
  </style>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          <i><img src="assets/img/logoo.png"></i>
        </a>
        <a href="#" class="simple-text logo-normal">
          Sascim
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <?php include("ListadoMenu.php"); ?>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel" >
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="principal.php">Principal</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span><img src="assets/img/usuario.ico"></span>
                  <?php echo $userr ?>
                  <p>
                    <span class="d-lg-none d-md-block">Perfil</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="panel-header panel-header-lg1" id="lateral">
      <div class="container wrapper">
        <center>
          <div class="col-md-10 " style="background-color: white;border-radius: 10px;">
            <br>
            <br>
          
            <h3 class="titulo">Verificar Anulaciones</h3>
            <form  id="formulario" validate method="POST" action="Re_SolicitudesU.php"  >
              <center>
                <div class="col form-group col-md-4">
                  <label for="id_">Fecha Inicial</label>
                  <input type="date" name="fecha1" class="form-control">
                </div>
                <div class="col form-group col-md-4">
                  <label for="id_">Fecha Final</label>
                  <input type="date" name="fecha2" class="form-control">
                </div>
              </center>
              <div class="content123"> <?php echo isset($alert) ? $alert : ''; ?></div>
              <div class="form-group " >
                <div class="content123"> <font color="blue"><b><?php echo isset($alert2) ? $alert2 : ''; ?></b></font></div>
              </div>
              
              <button type="submit" id="detalle" name="detalle" class="btn btn-primary btn-lg"  value="Ver Detalle">Ver Detalle</button>

         
            </form>
       
      </div>
<br>
      


 <?php
if ($valor == 1) {
    ?>
 <div class="col-md-10 " style="background-color: white;border-radius: 10px;" >
    <div class="container container-form-lg-g" id="divid" >
<style>
body {font-family: Arial;}
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}
.tab button:hover {
  background-color: #ddd;
} 
.tab button.active {
  background-color: #ccc;
}
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>


<?php 
$busqueda3="SELECT tra_codigo,tra_Descripcion, dia_Fecha as FechaEmision, cae,dte,
  dbo.recuperaNombreInmueble(inm_id) AS NOMBRE, dbo.recuperaNitInmueble(inm_id) as nit,inm_id as id,
  dbo.alote(inm_id) as lote ,dbo.recuperaDireccionInmueble(inm_id) AS DIRECCION,debe,dbo.CantidadConLetra(debe)
  AS VALOR_LETRAS, haber
  from ecuentaAnulacion where dia_Fecha between '$fecha1' and '$fecha2' and tra_Codigo  = (select tra_Codigo from agu_TransaccionesCaja where 
  tra_Codigo = ecuentaAnulacion.tra_Codigo and reps='S')  and cae <>'0'  ORDER BY FechaEmision  DESC ";
  $buscar3=sqlsrv_query($con,$busqueda3);
if (!empty($buscar3)) { ?>
 

<body>

  <h3 class="titulo">Facturas Anuladas </h3>
        <h3 class="titulo">Anulaciones del : <?php echo "$fecha1 al $fecha2"; ?> </h3>
        <div class="form-row ">
          

         </div>

        <table class="table table-hover table-sm table-striped table-responsive "  >
           
            <tr>
                <center><td > No.</td></center>
              
                <td>Codigo</td>
                <td>Descripción</td>
                <td>Fecha De Emisión</td>
                <td>Cae</td>
                <td>Dte</td>
                <td>Nombre</td>
                
                <td>DEBE</td>
                <td>HABER</td>
                
               
                
            
                           
            </tr> 
            <?php
            $i = 0;     
            while($fila = sqlsrv_fetch_array($buscar3)){
                $tra_codigo_ = $fila['tra_codigo'];
                $tra_Descripcion_ = $fila['tra_Descripcion'];
                $FechaEmision_= $fila['FechaEmision'];
                $cae_ = $fila['cae'];//factura
                $dte_ = $fila['dte'];
                $recuperaNombreInmueble_ = $fila['NOMBRE'];
                $recuperaNitInmueble_ = $fila['nit'];
                $alote_ = $fila['lote'];
                $recuperaDireccionInmueble_ = $fila['DIRECCION'];
                $debe_ = $fila['debe'];
                $haber_ = $fila['haber'];
                $total=+$debe_;
                $CantidadConLetra_ = $fila['VALOR_LETRAS'];
                $inm_id_ = $fila['id'];
               
                $i++;
                 ?>
                <tr align="left">
                    <td><?php echo $i; ?></td>
                   
                    <td><?php echo $tra_codigo_; ?></td>
                    <td><?php echo $tra_Descripcion_; ?></td>
                    <td><?php echo date_format ($FechaEmision_, 'd/m/Y'); ?></td>
                   
    
 
 
                   <td> <a id="bbb" class="check"  validate name="bbb" 
                      href="PdfVerificAnulaciones.php?id=<?php echo $fila['id']; ?>&cae_=<?php echo $fila['cae']; ?>" onclick="location.href=this.href+'?id=<?php echo $fila['inm_id_']; ?>&cae_=<?php echo $fila['cae']; ?>'return false;"><?php echo $cae_; ?></a></td>
                 
                <td><?php echo $dte_; ?></td>
                <td><?php echo $recuperaNombreInmueble_; ?></td>
                
                <td><?php echo number_format($debe_,'2','.',','); ?></td>
                 <td><?php echo number_format($haber_,'2','.',','); ?></td>
                
                
              </tr>
              <?php
            }
            ?>
            </table>
         
</body>

<?php  
}else{

  echo "Registros No Encontrados";
}?>
</div>
</div>
<?php }
?>
</center>
</div>
</div>
        </div>



<script>
$("#bbb").click(function(event) {
   $("#con").prop("checked", true);
                      $("#H").prop("checked", true);
});
</script>

 

  
    <!--   Core JS Files   -->
    <?php include('includes/ScriptPrincipal.php'); ?>
     <script src="assets/js/jquery.min.js"></script>
<script src="assets/js/funciones.js"></script>
  </body>

  </html>