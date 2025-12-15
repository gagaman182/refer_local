<?php	
	session_start();
	include("../config/conn_refer.php");
	$data=array();
	$sql="SELECT details,hospname,date_format(date_created,'%d-%m-%Y %h:%i:%s'),id,hospcode FROM services WHERE sended is null";
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
		$a['details']=$rs[0];
		$a['hospname']=$rs[1];
		$a['date_created']=$rs[2];
		$a['id']=$rs[3];
		$a['hospcode']=$rs[4];
		array_push($data,$a);
	}
	echo  json_encode($data);
	mysql_close($conn);
	
?>