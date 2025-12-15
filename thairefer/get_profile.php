<?php
header('Content-Type: application/json');
	include '../config/conn_thairefer.php';
	$sql="SELECT DISTINCT concat(concat(concat(pname,fname),' '),lname) as ptname,addrpart,moopart,tmbpart,amppart,chwpart,
	case
		when sex='ชาย' then 'M'
		when sex='หญิง' then 'F'
	end as sex,father,mother FROM referout_reply where cid='".$_POST['cid']."'";
	$data=array();
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)) {
		$data=$rs;	
	}
	echo json_encode($data);
	mysql_close();
?>