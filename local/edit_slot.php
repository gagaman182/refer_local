<?php
	include("../config/conn_refer.php");
	if($_POST['q']=='add'){
		$pla_name=explode("]",$_POST['place_name']);
		$pla_name=$pla_name[1];
		
		$sql="insert into  total_app (placecode,total_app,time_app,opd_exam,opd_exam_name,placecode_main,placename,placename_main) values ('".$_POST['placecode']."','".$_POST['total_app']."','".$_POST['time_app']."','".$_POST['day']."','".$_POST['day_name']."','".$_POST['placecode']."','".$pla_name."','".$pla_name."')";
		mysql_query($sql) or die(mysql_error());		
		echo "บันทึกเรียบร้อยแล้ว";
	}elseif($_POST['q']=='del'){
		$sql="delete from total_app where placecode='".$_POST['placecode']."'";
		mysql_query($sql) or die(mysql_error());
		echo "ลบเรียบร้อยแล้ว";
	}
	
	mysql_close($conn);

?>