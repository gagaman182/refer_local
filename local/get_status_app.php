<?php
header("Content-type: text/json");
include("../config/conn_refer.php");
$data=array();
$result=array();
$total=0;
$sql_my="SELECT DISTINCT appoint.placename FROM appoint
	WHERE (appoint.del_flag='' or appoint.del_flag is NULL) AND date_format(appoint.date_created,'%m-%Y')>='07-2020' AND appoint.hn <>'' AND appoint.status_app is NULL";
$query_my=mysql_query($sql_my);
while($rs_my=mysql_fetch_array($query_my)){

	$sql="SELECT count(DISTINCT appoint.referout_no),appoint.placename,date_format(appoint.date_created,'%m-%Y') FROM appoint
		WHERE (appoint.del_flag='' or appoint.del_flag is NULL) AND date_format(appoint.date_created,'%m-%Y')>='07-2020' AND appoint.hn <>'' AND appoint.status_app is NULL and appoint.placename='".$rs_my[0]."' 
	GROUP BY appoint.placename,date_format(appoint.date_created,'%m-%Y')
	ORDER BY appoint.date_created ,count(DISTINCT appoint.referout_no) DESC";
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
		$c[]=$rs[3];
		$e[]=(int)$rs[0];
		$f[]=(int)$rs[1];
		$g[]=(int)$rs[2];
	}
}

$z['name']='นัดRefer';
$z['data']=$e;
array_push($result,$z);
$y['name']='ลงนัดใน PMK';
$y['data']=$f;
array_push($result,$y);
$t['name']='Visitนัด';
$t['data']=$g;
array_push($result,$t);


array_push($data,$c);
array_push($data,$result);

echo json_encode($data, JSON_NUMERIC_CHECK);
mysql_close($conn);
?>