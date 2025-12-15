<?php
	session_start();
	include("../config/conn_refer.php");
	$sql="SELECT patients.*,concat(date_format(patients.dob,'%d-%m-'),date_format(patients.dob,'%Y')+543)  as birthday FROM patients where patients.id=".$_POST['id'];
			
	$data=array();
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
		$pic=$rs['pic_cid'];
		array_push($data,$rs);
	}
	$a['pic_cid']='<img id="pic" src="http://www.hatyaihospital.go.th/regis/pic_cid/'.$pic.'" class="img-thumbnail" alt="Responsive image"/>';
	array_push($data,$a);
	echo  json_encode($data);
	mysql_close($conn);
?>