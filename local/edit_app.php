<?php
include("../config/conn_refer.php");
$date_app=explode("-",$_POST['date_app']);
$date_app=$date_app[2].'-'.$date_app[1].'-'.$date_app[0];

$data=array();
if($_POST['fu_status']=='0'){
	$sql="update appoint set date_app='".$date_app."' where referout_no='".$_POST['referout_no']."'";
}elseif($_POST['fu_status']=='1'){
	$sql="update appoint set del_flag='Y' where referout_no='".$_POST['referout_no']."'";
}

$query=mysql_query($sql) or die(mysql_error());
if($query){
	echo "1";
}else{
	echo "0";
}
mysql_close($conn);
?>