<?php
	include("../config/conn_refer.php");
	if($_POST['q']=='add'){
		$sql="insert into  total_app (placecode,total_app,time_app,opd_exam) values ('".$_POST['placecode']."','".$_POST['total_app']."','".$_POST['time_app']."','".$_POST['day']."')";
		mysql_query($sql) or die(mysql_error());		
		echo "บันทึกเรียบร้อยแล้ว";
	}elseif($_POST['q']=='del'){
		$sql="delete from total_app where placecode='".$_POST['placecode']."'";
		mysql_query($sql) or die(mysql_error());
		echo "ลบเรียบร้อยแล้ว";
	}
	
	mysql_close();

?>