<?php
	include("../config/conn_refer.php");
	if($_POST['q']=='add'){
		$placename=$_POST['placename'];
        $placecode=$_POST['placecode'];
        $startdate=explode("-",$_POST['startdate']);
        $startdate=$startdate[2].'-'.$startdate[1].'-'.$startdate[0];

        $enddate=explode("-",$_POST['enddate']);
        $enddate=$enddate[2].'-'.$enddate[1].'-'.$enddate[0];

		//$pla_name=$pla_name[1];

		$sql="replace into holiday_doctor (placecode,placename,datestart,dateend) values ('".$placecode."','".$placename."','".$startdate."','".$enddate."')";
		mysql_query($sql) or die(mysql_error());		
		echo "บันทึกเรียบร้อยแล้ว";
        //echo $sql;
	}elseif($_POST['q']=='del'){
		$sql="delete from holiday_doctor where bid=".$_POST['bid'];
		mysql_query($sql) or die(mysql_error());
		echo "ลบเรียบร้อยแล้ว";
	}
	
	mysql_close($conn);

?>