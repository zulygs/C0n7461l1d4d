<?php
$servidor = "192.168.0.10";
$vaina = array( "Database"=>"CONTA", "UID"=>"administrador", "PWD"=>'340$Uuxwp7Mcxo7Khy', "CharacterSet"=>"UTF-8");
$con = sqlsrv_connect( $servidor, $vaina);

if( $con ) {
     echo "";
}else{
     echo "Conexión no se pudo estableceerer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>