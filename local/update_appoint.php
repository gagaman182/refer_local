<?php
date_default_timezone_set('Asia/Bangkok');
include("../config/conn_refer.php");

$sql="update appoint_walkin set status='3',appoint_date='".$_POST['app_date']."',place='".$_POST['app_place']."',doctor='".$_POST['app_doc']."',appointment_date=now() where id=".$_POST['id']."";
$query=mysql_query($sql) or die(mysql_error());
if($query){
	echo "1";
}else{
	echo $sql;
}
mysql_close($conn);
?>