
<?php 
  include("conexion.php");
$Fecha="2021-04-23";
$Fechaa="2021-04-26";
    $busquedar = "SELECT  * from felectronicaServicios where inm_Id = '722' and cae='558E3089'";
          $buscarr = sqlsrv_query($con, $busquedar);
        while ($fila=sqlsrv_fetch_array($buscarr)) {
          print_r($fila);
          # code...
        }

        /*



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
          "IDReceptor" :'.'"'.$IDReceptor_.'"'.',
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
/*
    Codigo 200
    Autorizacion
    FechaHoraCertificacion

*/
/*
 if ($data['Codigo'] == 200) 
{
echo $response;
$deletetarnc = "DELETE from  ecuenta where inm_id='$IDReceptor_' and cae='$cae_' and dte='$NoDocto_' ";
$buscar   = sqlsrv_query($con, $deletetarnc);

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
echo '<script language="javascript">alert("Ocurrio el siguiente error'.$e.'");
 window.location.href = "Anulaciones.php";
</script>';

}

        */
?>

