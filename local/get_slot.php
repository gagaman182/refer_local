<?php
	include("../config/conn_refer.php");
	$sql="SELECT * from total_app where del_flag is null and placecode='".$_POST['placecode']."'";
	$data=array();
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$a['day_app']=$rs[6];
		$a['total_app']=$rs[2];
		$a['time_app']=$rs[3];
		array_push($data,$a);
	}
	
	echo  json_encode($data);
	mysql_close($conn);
?>