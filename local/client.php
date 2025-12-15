<?php
header('Content-Type: application/json');
session_start();
require 'lib/nusoap.php';
//$client = new nusoap_client("http://192.168.4.3/webapp/webservice/webservice.php?wsdl");
$client = new nusoap_client("http://192.168.96.119/webservice/webservice.php?wsdl");
$q = $_POST['q'];
$q1 = $_POST['q1'];
$func=$_POST['func'];
$response = $client->call($func,array("q"=>$q,"q1"=>$q1));
echo $response;

?>
