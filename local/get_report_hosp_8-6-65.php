<?php
header("Content-type: text/json");
include("../config/conn_refer.php");
//include("../config/conn_thairefer.php");
$data=array();
$result=array();
$total=0;

$sql="select count(DISTINCT referout_no) as app, sum(CASE 	WHEN visit_opd='Y' THEN '1'	ELSE '0' END) as visit, hospital.HOSNAME
FROM appoint 
INNER JOIN hospital ON appoint.user_app=hospital.HOSCODE5
WHERE DATE_FORMAT(date_app,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') and (appoint.del_flag='' or appoint.del_flag is NULL) /*AND appoint.level_acute in('07','08')*/  GROUP BY hospital.HOSNAME order BY count(referout_no) DESC";
$query=mysql_query($sql,$conn) or die(mysql_error());
while($rs=mysql_fetch_array($query)){
	$total=$rs[0]+$total;
	$c[]=$rs[2];
	$a['app'][]=$rs[0];
	$a['visit'][]=$rs[1];
	//array_push($data,$a);			
}
$b[]=number_format($total);
array_push($data,$b);
array_push($data,$a);
array_push($data,$c);

echo json_encode($data, JSON_NUMERIC_CHECK);
mysql_close($conn);
?>