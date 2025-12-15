<?php
include("../config/conn_refer.php");

$sql="update appoint set line_sms='Y' where referout_no='".$_POST['referout_no']."'";

$query=mysql_query($sql) or die(mysql_error());
if($query){
	echo "1";
}else{
	echo "0";
}
?>