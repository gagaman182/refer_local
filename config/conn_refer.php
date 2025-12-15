<?php
$host="172.16.99.200";
$name="hatyaih";
$pw="Com3274*";
$db="refer";
//$db="datacenter";

$conn=mysql_connect($host,$name,$pw) or die(mysql_error());
mysql_select_db($db,$conn);
$cs1 = "SET character_set_results=utf8";
 mysql_query($cs1) or die('Error query: ' . mysql_error()); 

 $cs2 = "SET character_set_client = utf8";
 mysql_query($cs2) or die('Error query: ' . mysql_error()); 

 $cs3 = "SET character_set_connection = utf8";
 mysql_query($cs3) or die('Error query: ' . mysql_error());
 set_time_limit(0);

?>
