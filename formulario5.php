<!DOCTYPE html>
<?php
include "conexion.php";
date_default_timezone_set('America/Guatemala');
?>
<meta charset="UTF-8">
<html>
  <head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=2">

    <title>Consultas por Sector</title>
    <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/estilos.css">
  <script src="js/jquery.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


  <!-- Custom styles for this template -->
  <link href="form-validation.css" rel="stylesheet">
  <!-- Datepiker  -->
  <script src="css/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  </head>
<body>

  <div class="container-fluid wrapper">
    <h1>Reporte Ingresos </h1>
    <form method="POST" action="consulta05.php">
      <div class="col-md-4">
      <div class="form-group">
        <label for="fecha1">Fecha Inicial:</label>
        <div class="input-group date vc-date">
          <input type="text" name="fecha01" class="form-control" placeholder="Ingrese Fecha Inicial" value="" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
      </div>

      <div class="form-group">
        <label for="fecha2">Fecha Final:</label>
        <div class="input-group date vc-date">
          <input type="text" name="fecha02" class="form-control" placeholder="Ingrese Fecha Final" value="" required><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
        </div>
      </div>

      <div class="form-group">
        <P><INPUT TYPE="SUBMIT" NAME="buscar" VALUE="Buscar"></P>
      </div>
      <div class="centrar">
        <tr><a class="btn btn-primary" href="javascript:history.back()"> Menu Anterior </a></tr>
    </div>
    </div>
    </form>
  </div>
<br /><br /><br />
<script src="js/app.js" charset="utf-8"></script>
    <!-- Bootstrap core JavaScript
  ================================================== -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="bootstrap/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>



</body>
</html>