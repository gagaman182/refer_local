<?php	
	session_start();
	include("../config/conn_refer.php");
	$data=array();
	$sql="update services set sended='Y' WHERE id=".$_GET['id'];
	$query=mysql_query($sql) or die(mysql_error());
	echo "1";
	mysql_close($conn);
	
?>