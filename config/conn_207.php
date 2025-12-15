<?php
$host_207="61.19.25.207";
$name_207="takis3";
$pw_207="skho@00866";
$db_207="opdsi";
//$db="datacenter";
$conn_opdsi=mysql_connect($host_207,$name_207,$pw_207) or die(mysql_error());
mysql_select_db($db_207,$conn_opdsi);
$cs1 = "SET character_set_results=utf8";
 mysql_query($cs1) or die('Error query: ' . mysql_error()); 

 $cs2 = "SET character_set_client = utf8";
 mysql_query($cs2) or die('Error query: ' . mysql_error()); 

 $cs3 = "SET character_set_connection = utf8";
 mysql_query($cs3) or die('Error query: ' . mysql_error());
 set_time_limit(0);
?>