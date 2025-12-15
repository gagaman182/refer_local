<?php
header("Content-type: text/json");
include("../config/conn_refer.php");
$data=array();
$result=array();
$total=0;
$sql="SELECT count(x.referout_no),sum(x.status_app),sum(visit_appoint),x.placename_main
FROM
(SELECT DISTINCT appoint.referout_no,status_app,visit_appoint,total_app.placename_main FROM appoint INNER JOIN total_app ON appoint.placecode=total_app.placecode
WHERE (appoint.del_flag='' or appoint.del_flag is NULL) ) x
GROUP BY x.placename_main";
$query=mysql_query($sql) or die(mysql_error());
while($rs=mysql_fetch_array($query)){
	$c[]=$rs[3];
	$e[]=(int)$rs[0];
	$f[]=(int)$rs[1];
	$g[]=(int)$rs[2];
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