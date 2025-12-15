<?php
include("../config/conn_refer.php");
include("../config/conn_thairefer.php");
	$sql_appoint="select referout_no,level_acute FROM appoint WHERE level_acute='' or level_acute is null";
	$query_appoint=mysql_query($sql_appoint,$conn) or die(mysql_error());
	while($rs_appoint=mysql_fetch_array($query_appoint)){
		
		$sql_thairefer="select level_acute from referout_reply where referout_no='".$rs_appoint['referout_no']."'";
		$query_thairefer=mysql_query($sql_thairefer,$connect) or die(mysql_error());
		$rs_thairefer=mysql_fetch_array($query_thairefer);
		$sql_update="update appoint set level_acute='".$rs_thairefer['level_acute']."' where referout_no='".$rs_appoint['referout_no']."'";
		mysql_query($sql_update,$conn) or die(mysql_error());
		echo $rs_appoint['referout_no'].' '.$rs_appoint['level_acute']."-->".$rs_thairefer['level_acute']."<br>";		
	}
mysql_close();
?>