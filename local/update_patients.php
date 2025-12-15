<?php
include("../config/conn_refer.php");
if(isset($_POST['q']) || $_POST['q']=='line' || $_POST['q']=='sms'){
	$sql="update patients set status='3' where hn='".$_POST['hn']."'";
}else{
	$sql="update patients set status='1' where cid='".$_POST['cid']."'";
}
$query=mysql_query($sql) or die(mysql_error());
if($query){
	echo "1";
}else{
	echo "0";
}
mysql_close($conn);
?>