<?php 
	include("conexion.php");
	session_start();
	set_time_limit(0);
  $valor = 0;
	 $userr=$_SESSION['user'];
   if (empty($_SESSION['idUser'])) {
        header('location: index.html');
    }else{
      $alert = '';
  if (isset($_POST['inserta'])) {
    $idinm_ = $_POST['idinm'];
    $idgen_ = $_POST['idgen'];
    $nom_   = $_POST['nom_'];
    $dir_   = $_POST['dir_'];
    $est_   = $_POST['est_'];
    $nit_   = $_POST['nit_'];
    $tel_   = $_POST['tel_'];
    $sal_   = $_POST['sal_'];
    $busquedar = "SELECT top 1 * from felectronicaTest where inm_Id = '$idinm_' order by mes desc";
          $buscarr = sqlsrv_query($con, $busquedar);
          if ($row=sqlsrv_fetch_array($buscarr)) {
            $alert    = '';
            $valor=1;
          }else{
             $valor=0;
            $alert    = 'No Se Encontraron Datos De Factura'; 
          }
   /* if (empty($_POST['idgen'])) {
      $alert = 'Lote No Encontrado';
    } else {
      $alert = '';
      $valor = 1;
    }*/
  }
}
    date_default_timezone_set('UTC');
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
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="./assets/css/util.css">

   <?php include "includes/scriptes.php";?>

    
</head>
<style type="text/css">
  #lateral { height: 1565px; }
</style>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
      <script type="text/javascript">
        $(document).ready(function() {
          setTimeout(function() {
            $(".content123").fadeOut(1500);
          },3000);
        });
      </script>
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
          <?php
          include("ListadoMenu.php");
          ?>
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
      <!-- End Navbar -->
    <div class="panel-header panel-header-lg1" id="lateral">
      <div class="container wrapper">
        <center>
          <div class="col-md-10 " style="background-color: white;border-radius: 10px;">
            <br>
            <br>
            <h3 class="titulo">NOTA DE CRÉDITO</h3>
            <form class="needs-validation" novalidate method="POST" action="NotaCA.php" >
              <div class="form-row">
                <div class="col form-group col-md-6">
                  <label for="codlot">Código de Lote:</label>
                  <input type="text" name="codlot" class="form-control" id="codlot" onclick="ocultar('aaaa'),ocultar('bbbb')" placeholder="" style="width: 290px" value="<?php echo isset($idgen_) ? $idgen_ : ''; ?>"  required>
                  <div class="invalid-feedback">
                    Debe ingresar Código del Cliente
                  </div>
                </div>
                <input type="hidden" id="idgen" name="idgen" value= "" required>
                <input type="hidden" id="idinm" name="idinm" value= "" required>
                <input type="hidden" id="nom_" name="nom_" value= "" required>
                <input type="hidden" id="dir_" name="dir_" value= "" required>
                <input type="hidden" id="est_" name="est_" va lue= "" required>
                <input type="hidden" id="nit_" name="nit_" value= "" required>
                <input type="hidden" id="tel_" name="tel_" value= "" required>
                <input type="hidden" id="sal_" name="sal_" value= "" required>
                <input type="hidden" id="mesb" name="mesb" value= "" required>
                <div class="col form-group col-md-6">
                  <label for="id_">ID Inmueble:</label>
                  <input type="text" name="id_" class="form-control" id="id_" onclick="ocultar('aaaa'),ocultar('bbbb')" style="width: 290px" value="<?php echo isset($idinm_) ? $idinm_ : ''; ?>"  >
                </div>
              </div>
              <div class="form-row">
                <div class="col form-group">
                  <label for="nombre">Titular Propietario:</label>
                  <input type="text" name="nombre" class="form-control" id="nombre"  style="width: 400px" value="<?php echo isset($nom_) ? $nom_ : ''; ?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="direccion">Dirección:</label>
                  <input type="text" name="direccion" class="form-control" id="direccion"  style="width: 400px" value="<?php echo isset($dir_) ? $dir_ : ''; ?>" disabled>
                </div>
              </div>
              <div class="form-row">
                <div class="col form-group">
                  <label for="estado">Estado Usuario:</label>
                  <input type="text" name="estado" class="form-control" id="estado" style="width: 177px" value="<?php echo isset($est_) ? $est_ : ''; ?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="nit">Nit:</label>
                  <input type="text" name="nit" class="form-control" id="nit" style="width: 177px"  value="<?php echo isset($nit_) ? $nit_ : ''; ?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="tel">Telefono:</label>
                  <input type="text" name="tel" class="form-control" id="tel" style="width: 177px" value="<?php echo isset($tel_) ? $tel_ : ''; ?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="saldo">Saldo al día:</label>
                  <input type="numbre" name="saldo" class="form-control" id="saldo" style="width: 177px" value="<?php echo isset($sal_) ? $sal_ : ''; ?>" disabled>
                </div>
              </div>
              <div class="content123"> <?php echo isset($alert) ? $alert : ''; ?></div>
              <br>
              <br>
              <br>
              <input type="submit" id="inserta" name="inserta" class="btn btn-primary btn-lg" style="background-color: green;" value="Cargar Datos" >
            </form>
          </div>
        </center>
        <br>
       <?php
        $vart=0;
        if ($valor == 1) {

          /*$busqueda2 = "SELECT fechafactura as fechahoraEmision,clp_Nombre as receptor,vnit as nit_receptor,
          correoe as correo_receptor, bruto as MontoGravable,  iva as impuesto, totalapagar,
          cae as serie, dte as NumeroDocumento, autorizacion, fechaCertificacion
          from felectronicaHistorico where inm_Id='$idinm_' ";
          $buscar2 = sqlsrv_query($con, $busqueda2);
          while ($Fila = sqlsrv_fetch_array($buscar2)) {
            $fechahoraEmision_ = $Fila['fechahoraEmision'];
            $receptor_ = $Fila['receptor'];
            $nit_receptor_ = $Fila['nit_receptor'];
            $correo_receptor_ = $Fila['correo_receptor'];
            $MontoGravable_ = $Fila['MontoGravable'];
            $impuesto_ = $Fila['impuesto'];
            $totalapagar__ = $Fila['totalapagar'];
            $serie_ = $Fila['serie'];
            $NumeroDocumento_ = $Fila['NumeroDocumento'];
            $autorizacion_ = $Fila['autorizacion'];
            $fechaCertificacion__ = $Fila['fechaCertificacion'];
          }*/
          ?>
          <center>
          
            <br>
          <div style="background-color: white;border-radius: 20px;"  id="bbbb">
  <br>
            <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
            <table class="table table-hover table-sm table-striped table-responsive" id="tab">
              <tr>
                <td>No.</td>
                <td>Fecha Emisión</td>
                <td>Fecha Certificación</td>
                <td>Serie</td>
                <td>Autorización</td>
                <td>Nombre</td>
                <td>Acción</td>
                
              </tr>
              <?php
              $inm_id_b     = $idinm_;
              
                  //$busqueda = "SELECT top 2  * from felectronicatest where inm_Id = '$idinm_' order by mes desc";
                  $busqueda = "SELECT top 2 * from felectronicaHistorico where inm_Id = '$idinm_' order by mes desc";
            $buscar = sqlsrv_query($con, $busqueda);
        
 setlocale(LC_TIME, "spanish");
 date_default_timezone_set('UTC');
    

$i=0;


while($fila = sqlsrv_fetch_array($buscar)){
    $mes_act = $fila['mesactual'];
    $fecha1= $fila['fechafactura'];  
    $fecha = strftime("%d-%b-%Y %H:%M:%S", strtotime($fecha1));
    $fecha22=strftime("%d %b %Y ", strtotime($fecha1));
    $fec_pag = $fila['fechapago'];
    $leyenda_ = $fila['leyenda'];
    $mes_id = $fila['mes'];
    $dte_ = $fila['dte'];
    $factura_ = $fila['factura'];
    $clp_nombre_ = $fila['clp_Nombre'];
    $vnit_ = $fila['vnit'];
    $inm_IdGe = $fila['inm_IdGenerado'];
    $coso_ = $fila['coso'];
    $totalsinsaldoant_ = $fila['totalsinsaldoant'];
    $totalapagar_ = $fila['totalapagar'];
    $letras_ = $fila['letras'];
    $resolu_ = $fila['resolucion']; 
    $autorizacion_ = $fila['autorizacion']; 
    $serie___ = $fila['cae'];
    $fechaCertificacionn =$fila['fechaCertificacion'];
    $fechaCertificacion_ =strftime("%d-%b-%Y %H:%M:%S", strtotime($fechaCertificacionn));

    
$i++;

    

                ?>
                <tr  align="left">
                  <td><?php echo $i; ?></td>
                  <td><?php echo $fecha; ?></td>
                  <td><?php echo $fechaCertificacion_; ?></td>
                  <td><?php echo $serie___; ?></td>
                  <td><?php echo $autorizacion_; ?></td>
                  <td><?php echo $clp_nombre_; ?></td>

                     
                    <td><a   href="#?caeee=<?php  $caeee=$fila['cae']; echo($caeee)?>&%20iddd=<?php   $iddd=$inm_id_b; echo($iddd)?>" onclick="generar(this)" >Generar Nota</a></td>      


                  <td></td>
                 </tr>
                  <?php   } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div> 
<script type="text/javascript">
   function generar(x) {
           
      $('#modal_exito').modal('show');
  
}
</script>
          </center>
        <?php } ?>
      </div>
      <br>
    </div>
  </div>

            </script>     
                <?php 
          $jfghj_=$iddd;
          $jfghddsj_=$caeee;

          $busqueda22 = "SELECT top 1 fechafactura as fechahoraEmision,clp_Nombre as receptor,vnit as nit_receptor,correoe as correo_receptor, bruto as MontoGravable,iva as impuesto, totalapagar,cae as serie, dte as NumeroDocumento, autorizacion, fechaCertificacion from felectronicaHistorico where inm_Id='$jfghj_' and cae='$jfghddsj_'";
          $buscar2 = sqlsrv_query($con, $busqueda22);
          while ($Fila = sqlsrv_fetch_array($buscar2)) {
            $fechahoraEmision_ = $Fila['fechahoraEmision'];
            $receptor_ = $Fila['receptor'];
            $nit_receptor_ = $Fila['nit_receptor'];
            $correo_receptor_ = $Fila['correo_receptor'];
            $MontoGravable_ = $Fila['MontoGravable'];
            $impuesto_ = $Fila['impuesto'];
            $totalapagar__ = $Fila['totalapagar'];
            $serie_ = $Fila['serie'];
            $NumeroDocumento_ = $Fila['NumeroDocumento'];
            $autorizacion_ = $Fila['autorizacion'];
            $fechaCertificacion__ = $Fila['fechaCertificacion'];
          } ?>
  <div class="modal fade" id="modal_exito" role="dialog" >
    <div class="modal-dialog" style="width: 600px">
        <div class="modal-content" style="width: 600px">
            <div class="modal-header" style="width: 600px">

                 <div class="" style="background-color: white;border-radius: 10px;" id="aaaa" style="">
                  <center>
              <h1>Datos De Factura</h1>

              <div class="form-row">
                <div class="col form-group ">
                 
                  <label for="fechahoraEmision">Fecha De Emisión:</label>
                  <input type="text" name="fechahoraEmision" class="form-control" id="estado" style="width: 200px" value="<?php echo($fechahoraEmision_)?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="">Fecha De Certificación:</label>
                  <input type="text" name="fechaCertificacion" class="form-control" id="fechaCertificacion" style="width: 205px" value="<?php echo($fechaCertificacion__)?>" disabled>
                </div>
              </div>
              <div class="form-row">
                <div class="col form-group">
                  <label for="">Receptor:</label>
                  <input type="text" name="receptor" class="form-control" id="receptor" style="width: 277px" value="<?php echo($receptor_)?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="">Nit Receptor:</label>
                  <input type="text" name="nit_receptor" class="form-control" id="nit_receptor" style="width: 177px" value="<?php echo($nit_receptor_)?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="">Correo:</label>
                  <input type="text" name="correo_receptor" class="form-control" id="correo_receptor" style="width: 400px" value="<?php echo($correo_receptor_)?>" disabled>
                </div>
              </div>
              <div class="border-left border-bottom border-right border-top" style="background-color: whitesmoke;">
                <br>
                <div class="form-row">
                  <div class="col form-group">
                    <label for=""> Monto Gravable:</label>
                  </div>
                  <div class="col form-group">
                    <input type="text" name="MontoGravable" class="form-control" id="MontoGravable" style="width: 177px" value="<?php echo($MontoGravable_)?>" disabled>
                  </div>
                </div>
                <div class="form-row">
                  <div class="col form-group">
                    <label for="">Impuesto:</label>
                  </div>
                  <div class="col form-group">
                    <input type="text" name="impuesto" class="form-control" id="impuesto" style="width: 177px" value="<?php echo($impuesto_)?>" disabled>
                  </div>
                </div>
                <hr>
                <div class="form-row">
                  <div class="col form-group">
                    <label for="totalapagar">Total A Pagar:</label>
                  </div>
                  <div class="col form-group">
                    <input type="text" name="totalapagar" class="form-control" id="totalapagar" style="width: 177px" value="<?php echo($totalapagar__)?>" disabled>
                  </div>     
                </div> 
              </div>
              <br>     
              <div class="form-row">
                <div class="col form-group">
                  <label for="">Serie:</label>
                  <input type="text" name="serie" class="form-control" id="serie" style="width: 115px" value="<?php echo($serie_)?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="">No. Documento:</label>
                  <input type="text" name="NumeroDocumento" class="form-control" id="NumeroDocumento" style="width: 120px" value="<?php echo($NumeroDocumento_)?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="">Autorización:</label>
                  <input type="text" name="autorizacion" class="form-control" id="autorizacion" style="width: 300px" value="<?php echo($autorizacion_)?>" disabled>
                </div>
                
                
              </div>
              </center>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Confirmar</button>
                <button type="button" class="btn btn-cancel" data-dismiss="modal">Cancelar</button>
            </div>
        </div>

    </div>
</div>
  <div class="centrar">
    <?php $url = htmlspecialchars(@ $_SERVER['HTTP_REFERER']); ?>
  </div>
</div>

<script type="text/javascript">
 function ocultar(X){
            $("#"+X).hide(500);
            
          }

        
        </script>

  <script src="https://192.168.0.9/sascim/assets/js/funciones.js"></script>
  <script src="https://192.168.0.9/sascim/js/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://192.168.0.9/sascim/assets/js/funciones.js"></script>
  <script src="https://192.168.0.9/sascim/js/jquery.min.js"></script>
  <script src="assets/js/funciones.js"></script>
  
  <script src="assets/js/funciones.js"></script>
</body>
</html>