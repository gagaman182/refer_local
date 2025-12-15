<?php
//$conn = oci_connect("admin","admin","192.168.99.250/hy"); 
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
$username="admin";
$password="admin";
$con =oci_connect($username, $password, '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.99.250)(PORT = 1521)) (CONNECT_DATA = (SERVICE_NAME = hy) (SID = hy)))');
	 if(!$con )   { 
		echo "Can not connect to Oracle Server : ";
		exit;
	}

?>