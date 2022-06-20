<?php
include("conexion.php"); 
$IDReceptor_=$_REQUEST['IdReceptor'];
$NoDocto_=$_REQUEST['NoDocto'];
$cae_=$_REQUEST['cae'];
$dte_=$_REQUEST['dte'];
$nit_=$_REQUEST['nit'];
date_default_timezone_set('America/Guatemala');
$fechae=date("Y-m-d\TH:i:s");
//$fechae="2021-02-04T10:07:23-06:00";

$MotivoA_=$_REQUEST['MotivoA'];
$IDDD_=$_REQUEST['IDDD'];


//echo "$IDDD_";
/*echo "<br>$IDReceptor_";
echo "<br>$NoDocto_";
echo "<br>$dte_";
echo "<br>$cae_";
echo "<br>$fechae";*/

/*$deletetarnc = "SELECT * from ecuenta where inm_id='$IDReceptor_'and cae='$cae_' and autorizacion='$NoDocto_'  ";
$buscar   = sqlsrv_query($con, $deletetarnc);
while ($fila=sqlsrv_fetch_array($buscar)) {
  print_r($fila);
  echo "string";
  # code...
}
echo "$IDReceptor_";*/

try
{
  $curl = curl_init();

  curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://receptor.fel.sigsa.gt/prod/Token',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ODMzODgxNzpiWTBPaEQwNzZhaFk5aFZsdlJVS2V3PT0='
  ),
));
$responseToken = curl_exec($curl);
$simpleXml = simplexml_load_string($responseToken) or die("Error: Cannot create encode data to xml object");
$jsondata = json_encode($simpleXml) or die("Error: Cannot encode record to json");
$data = json_decode($jsondata, true);
$MensajeToken=$data['mensaje'];
curl_close($curl);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://receptor.fel.sigsa.gt/prod/AnulacionJsonData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
       "NumeroDocumento":'.'"'.$NoDocto_.'"'.',
       "NITEmisor": "8338817",
          "IDReceptor" :'.'"'.$nit_.'"'.',
          "FechaHoraAnulacion":'.'"'.$fechae.'"'.',
       "Motivo":'.'"'.$MotivoA_.'"'.'
}',
  CURLOPT_HTTPHEADER => array(
    'Token:'.$MensajeToken.'',
    'EMISOR: 8338817',
    'Content-Type: text/plain'
  ),
));

$response = curl_exec($curl);
curl_close($curl);
$data = json_decode($response, true);
echo $response;
   // Codigo 200
    //Autorizacion
   // FechaHoraCertificacion



 if ($data['Codigo'] == 200) 
{
$Insertarnc = "INSERT into felectronicaServiciosAnulados(inm_id,autorizacion) VALUES('".$IDReceptor_."','".$NoDocto_."') ";
$buscar2   = sqlsrv_query($con, $Insertarnc);

$UpdateEcuenta = "UPDATE ecuenta set cae='',dte='',resolucion='',fechaCertificacion='',autorizacion='Contingencia'
where inm_id=$IDReceptor_ and id=$IDDD_";
$buscar3   = sqlsrv_query($con, $UpdateEcuenta);

$UpdateService = "UPDATE felectronicaServicios set clp_Nombre=dbo.anombre(inm_Id),clp_NIT=dbo.recuperaNitInmueble(inm_Id),
coso=dbo.recuperaDireccionInmueble(inm_Id),vnit='',cae='',dte='',resolucion='',fechaCertificacion='',autorizacion='Contingencia'
where   inm_Id=$IDReceptor_ and id=$IDDD_";
$buscar4   = sqlsrv_query($con, $UpdateService);

echo '<script language="javascript">alert("La Nota De Credito ha Sido Anulada");
 window.location.href = "Anulaciones.php";
</script>';
}
else
{
  echo '<script language="javascript">alert("Ocurrio el siguiente error'.$data['mensaje'].'");
  window.location.href = "Anulaciones.php";
</script>';
}
}

catch(Exception $e)
{
echo '<script language="javascript">alert("Ocurrio el siguiente error de'.$e.'");
 window.location.href = "Anulaciones.php";
</script>';

}

