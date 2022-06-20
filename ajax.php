<?php
include "conexion.php";
session_start();

if (empty($_POST)) {
} else {
    if ($_POST['action'] == 'searchLot') {

        if ($_POST['lote']) {

            $id_g     = $_POST['lote'];
            $fechoy   = date('Y-m-d');
            $mes_     = 134;
            $ejeqlote = sqlsrv_query($con, "SELECT dbo.recuperaEstadoInmueble(inm_id) as estado, dbo.recuperaNombreInmueble(inm_id) as nombre,
            dbo.recuperaDireccionInmueble(inm_id) as direccion, dbo.recuperaNitInmueble(inm_id) as nit,
            dbo.ecuentasaldopormes(inm_id,'$fechoy') as saldo, $mes_ as mes, *
            from tblInmuebles where inm_IdGenerado like '$id_g'");
            $fila = 0;
            while ($fila = sqlsrv_fetch_array($ejeqlote)) {
                $id_generado = $fila['inm_IdGenerado'];
                echo json_encode($fila, JSON_UNESCAPED_UNICODE);
            }
        }
        exit;
    } else {
        if ($_POST['action'] == 'searchLot2') {

            if ($_POST['inm_id']) {
                $id_m = $_POST['inm_id'];
                $fechoy   = date('Y-m-d');
                $mes_     = 134;
                $ejeqlote = sqlsrv_query($con, "SELECT dbo.recuperaEstadoInmueble(inm_id) as estado, dbo.recuperaNombreInmueble(inm_id) as nombre,
            dbo.recuperaDireccionInmueble(inm_id) as direccion, dbo.recuperaNitInmueble(inm_id) as nit,
            dbo.ecuentasaldopormes(inm_id,'$fechoy') as saldo, $mes_ as mes, *
            from tblInmuebles where inm_id like '$id_m'");
                $fila = 0;
              
               
                while ($fila = sqlsrv_fetch_array($ejeqlote)) {
                    $id_generado = $fila['inm_IdGenerado'];
                    echo json_encode($fila, JSON_UNESCAPED_UNICODE);
                }
                 
              
            exit;
        }  }
    }

    if($_POST['action'] == 'searchSec'){
        if($_POST['sector']){
            $sec = $_POST['sector'];
            $query1 = mysqli_query($con, "SELECT * FROM cliente WHERE sec_codigo = '$sec' order by codcli desc limit 1");
            mysqli_close($con);
            $result1 = mysqli_num_rows($query1);
            $data1 = '';
            if ($result1 > 0) {
                $data1 = mysqli_fetch_assoc($query1);
            } else {
                $data1 = 0;
            }
            echo json_encode($data1,JSON_UNESCAPED_UNICODE);
        }
        exit;
    }
    if($_POST['action'] == 'searchsobre'){
        if($_POST['sobre']){
            $sec = $_POST['sobre'];

            $data1 = 0;

            if ($sec == 1 ) {
                $data1 = 1;
            } 
            if ($sec == 2) {
                $data1 = 2;
            }
            echo json_encode($data1,JSON_UNESCAPED_UNICODE);
            
        }
        exit;
    }
    exit;
}
exit;
?>