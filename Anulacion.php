<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");


    
	

    $dataS = json_decode(file_get_contents("php://input"));


    $id=$dataS->id;
    $inm_id=$dataS->inm_id;

// print $id;
include("conexion.php");

 $query="SELECT * from felectronicaServicios where inm_Id=$inm_id and id=$id";
 $result=sqlsrv_query($con,$query);
 while ($fila=sqlsrv_fetch_array($result)) {
 	$NoDocto_=$fila["autorizacion"];
 	$inm_id=$fila["inm_Id"];
 	$cae=$fila["cae"];
 	$dte=$fila["dte"];
 	$nit=$fila["vnit"];




 }
 //echo "$NoDocto_"."...."."$inm_id"."...."."$cae"."...."."$dte"."...."."$nit";

 date_default_timezone_set('America/Guatemala');
$fechae=date("Y-m-d\TH:i:s");



//$fechae="2021-02-04T10:07:23-06:00";

$MotivoA_="Anulaciones Varias";

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
          "IDReceptor" :'.'"'.$nit.'"'.',
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
 if ($data['Codigo'] == 200) 
{
	$update="UPDATE ecuentaAnulacion set estado='OK' where inm_Id=$inm_id and id=$id";
	$result   = sqlsrv_query($con, $update);
}
}catch(Exception $e)
{
echo 'Error de Anulacion';

} ?>
