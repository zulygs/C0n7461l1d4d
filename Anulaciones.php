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
    $busquedar = "SELECT top 1 * from felectronicaHistorico where inm_Id = '$idinm_' order by mes desc";
    $buscarr = sqlsrv_query($con, $busquedar);
    
    if ($row=sqlsrv_fetch_array($buscarr)) {
      $alert    = '';
      $valor=1;
    }else{
      $valor=0;
      $alert    = 'No Se Encontraron Datos De Factura';
    }         
  }
}
  header("Cache-Control: no-cache, must-revalidate");  
  date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="es">
<head>
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logoo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Usuarios Sascim
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








  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>t>







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
            <h3 class="titulo">Anulaciones</h3>
            <form class="needs-validation" novalidate method="POST" action="Anulaciones.php" >
              <div class="form-row">
                <div class="col form-group col-md-6">
                  <label for="codlot">Código de Lote:</label>
                  <input type="text" name="codlot" class="form-control" id="codlot" onclick="ocultar('bbbb')" placeholder="" style="width: 290px" value="<?php echo isset($idgen_) ? $idgen_ : ''; ?>"  required>
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
                  <input type="text" name="id_" class="form-control" id="id_" onclick="ocultar('bbbb')" style="width: 290px" value="<?php echo isset($idinm_) ? $idinm_ : ''; ?>"  >
                </div>
              </div>
              <div class="form-row">
                <div class="col form-group">
                  <label for="nombre">Titular Propietario:</label>
                  <input type="text" name="nombre" class="form-control" id="nombre"  style="width: 400px" value="<?php echo isset($nom_) ? $nom_ : ''; ?>" disabled>
                </div>
                <div class="col form-group">
                  <label for="direccion">Dirección:</label>
                  <input type="text" name="direccion" class="form-control" id="direccion" style="width:400px" value="<?php echo isset($dir_) ? $dir_ : ''; ?>" disabled>
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
        <?php
        $vart=0;
        if ($valor == 1) {
          ?>
          <center>
            <br>
            <div style="background-color: white;border-radius: 20px;"  id="bbbb">
              <br>
              <h3 class="titulo">Código de Lote: <?php echo $idgen_ ?></h3>
              <table class="table table-hover table-sm table-striped table-responsive" id="tab">
                <thead>
                  <tr>
                  <td>No.</td>
                  <td>Fecha Emisión</td>
                  <td>Descripción</td>
                  <td>Autorización</td>
                  <td>Nombre</td>
                  <td>Total</td>
                  <td>Acción</td>
                </tr>
              </thead>
              <?php
              $inm_id_b  =  $idinm_;
              $busquedarrr = "SELECT top 1 * from felectronicaHistorico where inm_Id = '$idinm_' order by mes desc";
              $buscarrrr = sqlsrv_query($con, $busquedarrr);
              while ($filass=sqlsrv_fetch_array($buscarrrr)) {
              $vnit__=$filass['vnit'];
              }
             $busqueda = "SELECT top 2 tra_codigo,autorizacion,tra_Descripcion, dia_Fecha as FechaEmision, cae,dte,
  dbo.recuperaNombreInmueble($inm_id_b) AS NOMBRE, dbo.recuperaNitInmueble(inm_id) as nit,inm_id as id,
  dbo.alote(inm_id) as lote ,dbo.recuperaDireccionInmueble(inm_id) AS DIRECCION,debe,dbo.CantidadConLetra(debe)
  AS VALOR_LETRAS, (case codAgencia when 2 then 'SK' ELSE 'MF'END ) as serie, haber,id as idd
  from ecuenta where inm_id=$inm_id_b and tra_Codigo  = 'NC'  and cae <>'0'  ORDER BY FechaEmision  DESC"; 
              //$busqueda = "SELECT top 2 * from felectronicaServicios  where inm_Id = '$idinm_' and tra_Codigo='NC'";
              $buscar = sqlsrv_query($con, $busqueda);
              setlocale(LC_TIME, "spanish");
              date_default_timezone_set('America/Guatemala');
              $i=0;
              while($fila = sqlsrv_fetch_array($buscar)){
                $tra_codigo_ = $fila['tra_codigo'];
                $tra_Descripcion_ = $fila['tra_Descripcion'];
                $FechaEmision_= $fila['FechaEmision'];
                $cae_ = $fila['cae'];//factura
                $dte_ = $fila['dte'];
                $clp_nombre_ = $fila['NOMBRE'];
                $recuperaNitInmueble_ = $fila['nit'];
                $alote_ = $fila['lote'];
                $recuperaDireccionInmueble_ = $fila['DIRECCION'];
                $debe_ = $fila['debe'];
                $haber_ = $fila['haber'];
                $total=+$debe_;
                $CantidadConLetra_ = $fila['VALOR_LETRAS'];
                $inm_id_ = $fila['id'];
                $IDDDDD = $fila['idd'];
                $serie___ = $fila['serie'];
                $autorizacion_ = $fila['autorizacion'];
                //$fechaE_ =strftime("%d-%b-%Y %H:%M:%S", strtotime($FechaEmision_));
               /* $tra_codigo_ = $fila['tra_Codigo'];
                $cae_ = $fila['cae'];//factura
                $mes_act = $fila['mesactual'];
                $fecha1= $fila['fechafactura'];  
                $fecha = strftime("%d-%b-%Y %H:%M:%S", strtotime($fecha1));
                $fecha22=strftime("%d %b %Y ", strtotime($fecha1));
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
                $totalapagar_ = number_format($fila['totalapagar'],2,'.','');
                $letras_ = $fila['letras'];
                $resolu_ = $fila['resolucion']; 
                $autorizacion_ = $fila['autorizacion']; 
                $leyenda2_ = mb_strtoupper($leyenda_);
                $serie___ = $fila['cae'];
                $fechaCertificacionn =$fila['fechaCertificacion'];
                $fechaCertificacion_ =strftime("%d-%b-%Y %H:%M:%S", strtotime($fechaCertificacionn));   
                <td><?php echo $i; ?></td>
                    <td><?php echo $fechaE_; ?></td>
                    <td><?php echo $fechaCertificacion_; ?></td>
                    <td><?php echo $tra_Descripcion_; ?></td>
                    <td><?php echo $serie___; ?></td>
                    <td><?php echo $autorizacion_; ?></td>
                    <td><?php echo $clp_nombre_; ?></td>
                    <td><?php echo $vnit_; ?></td>
                    <td><?php echo $totalapagar_; ?></td> */      
                $i++;
                ?>
                <tbody>
                  <tr  align="left">
                    <td><?php echo $i; ?></td>
                    <td><?php echo date_format($FechaEmision_,'d-m-Y H:i:s'); ?></td>
                    <td><?php echo $tra_Descripcion_; ?></td>
                    <td><?php echo $autorizacion_; ?></td>
                    <td><?php echo $clp_nombre_; ?></td>
                    <td><?php echo $haber_; ?></td>

                    <td><a href="?Aut=<?php $Aut=$fila['autorizacion']; echo($Aut);?>&caeee=<?php $caeee=$fila['cae']; echo($caeee);?>&iddd=<?php $iddd=$inm_id_b; echo($iddd);?>&nit=<?php echo($vnit__);?>&dte=<?php $dte=$fila['dte']; echo($dte);?>&IDDDD=<?php $IDDDD=$fila['idd']; echo($IDDDD);?>">Anular Nota</a></td>
                  </tr>
                </tbody>
                
                <script type="text/javascript">
                  function ocultar(X){
    $("#"+X).hide(500);
  }
                </script>
                <?php } ?>
              </table>
            </div>
          </center>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_GET['iddd'])){
  $jfghj_=$_GET['iddd'];
  $nit_=$_GET['nit'];
  $dte_=$_GET['dte'];
  $jfghddsjj_=$_GET['Aut'];
  $jfghddsj_=$_GET['caeee'];
  $IDDDDD_=$_GET['IDDDD'];
  $busqueda22 = "SELECT * from felectronicaServicios where inm_Id='$jfghj_' and autorizacion='$jfghddsj_'";
  $buscar2 = sqlsrv_query($con, $busqueda22);
  while ($Fila = sqlsrv_fetch_array($buscar2)) {
   $tra_codigo_ = $fila['tra_Codigo'];
                $cae__ = $fila['cae'];//factura
                $mes_act = $fila['mesactual'];
                $fecha1= $fila['fechafactura'];  
                $fecha = strftime("%d-%b-%Y %H:%M:%S", strtotime($fecha1));
                $fecha22=strftime("%d %b %Y ", strtotime($fecha1));
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
                $totalapagar_ = number_format($fila['totalapagar'],2,'.','');
                $letras_ = $fila['letras'];
                $resolu_ = $fila['resolucion']; 
                $autorizacion__ = $fila['autorizacion']; 
                $leyenda2_ = mb_strtoupper($leyenda_);
                $serie___ = $fila['cae'];
                $fechaCertificacionn =$fila['fechaCertificacion'];
                $fechaCertificacion_ =strftime("%d-%b-%Y %H:%M:%S", strtotime($fechaCertificacionn));
  }
  echo '<script type="text/javascript">
  $(window).on("load", function() {
    $("#modal_exito").modal("show");
    });
    </script>';
  }
  ?>
  <div class="modal fade" id="modal_exito" role="dialog" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anulación De Nota</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!--¿Esta seguro de anular la nota de crédito?-->
           <div>
          <label>Descripción De Anulación:</label>
          <input type="textbox" class="form-control" name="MovitoA" id="MovitoA" style="width: 465px;height: 100px" required>
        </div>
        </div>
       

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="validar()">Anular Todo</button>
          <button type="button" class="btn btn-primary" onclick="validar2()">Anular Solo Fel</button>
        </div>
     </div>
    </div>
  </div>
  <div class="centrar">
    <?php $url = htmlspecialchars(@ $_SERVER['HTTP_REFERER']); ?>
  </div>
</div>
<script>
  
  function generar(x) {
    $('#modal_exito').modal('show');
  };
   
   function validar(){
         var valor = $("#MovitoA").val();
    if (valor == null || valor.length == 0) {
        alert('Ingrese Descripción');
        return false;
    }else{
    window.location.href="EnvioAnulacion.php?nit=<?php echo($nit_)?>&dte=<?php echo($dte_)?>&cae=<?php echo($jfghddsj_)?>&%20NoDocto=<?php echo($jfghddsjj_) ?>&%20IdReceptor=<?php echo($jfghj_) ?>&%20MotivoA="+ $('#MovitoA').val();
   
  
    }
   }; 
    function validar2(){
         var valor = $("#MovitoA").val();
    if (valor == null || valor.length == 0) {
        alert('Ingrese Descripción');
        return false;
    }else{
    window.location.href="EnvioAnulacion2.php?nit=<?php echo($nit_)?>&dte=<?php echo($dte_)?>&cae=<?php echo($jfghddsj_)?>&%20NoDocto=<?php echo($jfghddsjj_) ?>&%20IDDD=<?php echo($IDDDDD_)?>&%20IdReceptor=<?php echo($jfghj_) ?>&%20MotivoA="+ $('#MovitoA').val();
   
  
    }
   }; 
 
              
</script>
<!--   Core JS Files   -->



<?php include('includes/ScriptPrincipal.php'); ?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/funciones.js"></script>
</body>
</html>