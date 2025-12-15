<?php
include("../config/conn_refer.php");
$sql="update patients set del_flag='Y' where id=".$_POST['id'];
$query=mysql_query($sql) or die(mysql_error());
if($query){
	echo 'ลบรายการเรียบร้อยแล้ว';
}else{
	echo mysql_error();
}
mysql_close($conn);
?>