<?php
$serverName = "tcp:164.115.44.160,1433";
$userName = 'dev';
$userPassword = 'dev#1140rh12';
$dbName = "referdb_dw";

$refer_hospcode='10682';

$conn = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true,"CharacterSet"  => 'UTF-8');

sqlsrv_configure('WarningsReturnAsErrors', 0);
$conn = sqlsrv_connect( $serverName, $conn);
if(!$conn){
	 die( print_r( sqlsrv_errors(), true));
}
?>