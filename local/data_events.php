<?php

include("../config/conn_refer.php");
$data=array();
if($_GET['pla']<>'all'){
	$sql="SELECT date_app,count(DISTINCT cid),(SELECT DISTINCT total_app from total_app WHERE total_app.placecode=appoint.placecode) FROM appoint ";
	if($_GET['pla']=='0101'){
		$sql.="	where appoint.placecode in('0101','0109','0111','0112','0105','0117','0106','0110')  and appoint.del_flag is NULL GROUP BY date_app";
	}else{
		$sql.="	where appoint.placecode ='".$_GET['pla']."'  and appoint.del_flag is NULL GROUP BY date_app";
	}
	//WHERE appoint.placecode='".$_GET['pla']."' and appoint.del_flag is NULL GROUP BY date_app";
}else{
	$sql="SELECT date_app,count(DISTINCT cid),(SELECT DISTINCT total_app from total_app WHERE total_app.placecode=appoint.placecode) FROM appoint WHERE appoint.del_flag is NULL GROUP BY date_app";
}

$query=mysql_query($sql) or die(mysql_error());
while($rs=mysql_fetch_array($query)){
	$date_app=new DateTime($rs[0]);

	$a['title']=$rs[1].' / '.$rs[2];
	//$a['title']=$rs[1].' / '.$sql;
	$a['start']=$date_app->format('Y-m-d');
	if($rs[1]==$rs[2]){
		$a['backgroundColor']='#c8c8c8';
	}else{
		$a['backgroundColor']='#66cc00';
	}
	array_push($data,$a);
}

echo  json_encode($data);

?>