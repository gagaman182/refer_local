<?php
include("../config/conn_refer.php");
$data=array();
$sql="select
count(CASE WHEN visit_appoint = 'Y' THEN '1' END) as  appoint_pmk,
count(CASE WHEN visit_appoint is null or visit_appoint='' THEN '1' END) as  not_appoint_pmk,
count(CASE WHEN refer_appoint = 'Y' THEN '1' END) as  refer_pmk,
count(CASE WHEN refer_appoint is null OR refer_appoint = '' THEN '1' END) as  not_refer_pmk,
count(CASE WHEN visit_opd = 'Y' THEN '1' END) as  visit_pmk,
count(CASE WHEN visit_opd is null OR visit_opd = '' THEN '1' END) as  not_visit_pmk
from appoint 
WHERE date_format(referout_date,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') and (appoint.del_flag='' or appoint.del_flag is NULL) AND appoint.level_acute in('07','08')";
$query=mysql_query($sql);
while($rs=mysql_fetch_array($query)){
	$data[]=$rs;
}
echo json_encode($data, JSON_NUMERIC_CHECK);
mysql_close($conn);
?>