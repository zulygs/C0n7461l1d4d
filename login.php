<?php
$alert = '';
session_start();

if (isset($_POST['insert']) && $_POST['usuario'] != "jcorzo") {
    include "conexion1.php";

    $user = mysqli_real_escape_string($con, $_POST['usuario']);
    $clav = md5(mysqli_real_escape_string($con, $_POST['pass']));

    $query     = "SELECT * from usuario where usuario = '$user' and clave = '$clav'";
    $eje_query = mysqli_query($con, $query);
    $result    = mysqli_num_rows($eje_query);

    if ($result > 0) {
        $data = mysqli_fetch_array($eje_query);

        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['user']   = $data['usuario'];
        $_SESSION['rol']    = $data['rol'];

        header('location: Principal.php');
    } else {
        $alert = 'Usuario o Contraseña INCORRECTOS';
        session_destroy();
    }
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Inicio de Sesión</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="assets/img/logoo.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!--===============================================================================================-->
</head>
<body background="assets/img/baner.jpg" bgcolor="white">

	<div class="limiter">
		<div class="container-login100">
			<!--<div class="wrap-login100">-->
				<div class="login100-pic js-tilt" >
					<img src="assets/img/logoo.png" alt="IMG" >
				</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<form
				method="POST" action="login.php">

					<span class="login100-form-title"><font color="white">
					Iniciar Sesión</font>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Usuario Requerido">
						<input class="input100" type="text" name="usuario" placeholder="Usuario" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">

							<i class="fa fa-envelope" aria-hidden="true"></i>
							<img src="assets/img/user.ico">
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Contraseña Requerida">
						<input class="input100" type="password" name="pass" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<img src="assets/img/Password.ico">
						</span>
					</div>
					<div class="form-group alert"> <?php echo isset($alert) ? $alert : ''; ?></div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submite" name="insert">
							Ingresar
						</button>
					</div>
				</form>
			<!--</div>-->
		</div>
	</div>




<!--===============================================================================================-->
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
<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>

</body>
</html>