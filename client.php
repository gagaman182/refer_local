<?php
require '../webservice/lib/nusoap.php';
$client = new nusoap_client("http://192.168.4.3/webapp/webservice/webservice.php?wsdl"); // Create a instance for nusoap client
$q = $_POST['q'];
$q1 = $_POST['q1'];
$func=$_POST['func'];
$response = $client->call($func,array("q"=>$q,"q1"=>$q1));
echo $response;
?>
