<!--

=========================================================
* Now UI Dashboard - v1.5.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-dashboard
* Copyright 2019 Creative Tim (http://www.creative-tim.com)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<?php
    $alert = '';
    include("conexion1.php");
    session_start();
    $result = 0;
    $editar =  0;
    if (empty($_SESSION['active'])) {
        header('location: index.php');
    } else {
    if(isset($_POST['inserta'])){
        $user_ = $_POST['usuario'];

        $query = "SELECT * from usuario where usuario = '$user_'";
        $eje_query = mysqli_query($con,$query);
        $result = mysqli_num_rows($eje_query);

        if ($result > 0) {
            $alert = "El usuario ya existe";
            $editar = 1;
            $query = "SELECT * from usuario where usuario = '$user_'";
            $resultado = $con->query($query);
            while($datos=$resultado->fetch_array()){
                $idusu_ = ($datos["idusuario"]);
                $nom_ = ($datos["nombre"]);
                $usu_ = ($datos["usuario"]);
                $cla_ = ($datos["clave"]);
                $rol_ = ($datos["rol"]);

            }
        } else {
                header("Location: usuarios.php?usu=".urlencode($user_));
        }
            
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logoo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Usuarios Sascim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css"> 
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="logo">
        <a href="#" class="simple-text logo-mini">
         <i><img src="../assets/img/logoo.png"></i>
        </a>
        <a href="../Principal.php" class="simple-text logo-normal">
          Sascim
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">

        <ul class="nav">
          <li class="active ">
            <a href="Usuarios.php">
           <i><img src="../assets/img/user.ico"></i>
              <p>usuarios</p>
            </a>
          </li>
     
          <li>
            <a href="Lecturas.php.">
             <i><img src="../assets/img/lecturas.ico"></i>
              <p>Lecturas</p>
            </a>
          </li>
          <li>
            <a href="Reportes.php">
             <i><img src="../assets/img/reportes.ico"></i>
              <p>Reportes</p>
            </a>
          </li>
          <li>
            <a href="Impresiones.php">
            <i><img src="../assets/img/imprimir.ico"></i>
              <p>Impresiones</p>
            </a>
          </li>
    
          <li class="active-pro">
            <a href="salir.php">
             <span>
                <i><img src="../assets/img/salir.ico"></i>
              </span>
              <p>Salir</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
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
            <a class="navbar-brand" href="../Principal.php">Principal</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
             
            </form>
            <ul class="navbar-nav">
             
            
              <li class="nav-item">
                <a class="nav-link" href="">
                  <span><img src="../assets/img/usuario.ico"></span>
                  <?php echo $user_ ?>
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
      <div class="panel-header panel-header-lg">
      	 <form  method="POST" action="verifi_usuario.php" >     
         <center>
         <div class="form-group " >

              <input type="text"  class="form-control" placeholder="Usuario" name="usuario" required>
              </div>
                <br>  
                    <div class="form-group" >        
            <input type="submit" id="click" name="inserta" class="btn btn-primary btn-lg btn-block" value="Imprimir" style="width: 200px"><br>
          </div>
                </center> 
                </form>
      </div>

      <div class="content" >
        
        <div class="row">
          <div class="col-md-12">
            <div class="card" >
              <div class="card-header row" >

               &nbsp;&nbsp; <h4 class="card-title" > Usuarios</h4>
              
              </div>
              <div class="card-body">
                <div class="table-responsive" >
                  <table class="table">
                    <thead class=" text-primary" align="center">
                      <th>
                        ID
                      </th>
                      <th>
                        Nombre
                      </th>
                      <th >
                        Usuario
                      </th>
                      <th >
                        Roll
                      </th>
                        <th>
                        Accion
                      </th>
                      
                    </thead>
                   <tbody>
                  
                    <?php
                    $queryy = "SELECT * from usuario";
              $ejecutarc = mysqli_query($con, $queryy);
              $i = 0;
              while($fila = mysqli_fetch_array($ejecutarc)){
                $idd = $fila['idusuario'];
                        $nombree = $fila['nombre'];
                        $usuarioo = $fila['usuario'];
                        $rol__ = $fila['rol'];
                        $query_c = "SELECT * FROM rol where idrol = $rol__";
                        $ejecutard = mysqli_query($con, $query_c);
                        while($fila2 = mysqli_fetch_array($ejecutard)){
                        $n_rol =  $fila2['rol'];
                    }
            $i++;
                ?>
                <tr class="" align="center">
                  <td><?php echo $idd; ?></td>
                  <td nowrap><?php echo $nombree; ?></td>
                  <td nowrap><?php echo $usuarioo; ?></td>
                        <td nowrap><?php echo $n_rol; ?></td>
                        <td><a href="borrar_usuario.php?borrar=<?php echo $idd; ?>" name = "borra">Eliminar</a></td>
                </tr>
            <?php } ?>

          </table>
            </div>
          </tbody>
                  </table>
                </div>
              </div>
            </div></div>
            <input type="button" class="btn btn-dark btn-lg" onclick="printDiv('areaImprimir')" value="IMPRIMIR" >
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class=" container-fluid ">
          <nav>
            <ul>
              <li>
                <a href="https://www.creative-tim.com">
                  Creative Informatica
                </a>
              </li>
              
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy; <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
   <script src="js/main.js"></script>
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/tilt/tilt.jquery.min.js"></script>

  <script >
    $('.js-tilt').tilt({
      scale: 1.1
    })
  </script>

  
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>