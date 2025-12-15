<?php
header("Content-type: text/json");
include("../config/conn_refer.php");
$data=array();
$result=array();
$total=0;
$report_date=explode("-",$_GET['report_date']);
$report_date=$report_date[2].'-'.$report_date[1].'-'.$report_date[0];
$sql="select count(DISTINCT referout_no) as app, sum(CASE 	WHEN visit_appoint='Y' THEN '1'	ELSE '0' END) as visit, placename
FROM appoint 
WHERE DATE_FORMAT(referout_date,'%Y-%m-%d')='".$report_date."' and (appoint.del_flag='' or appoint.del_flag is NULL) /*AND appoint.level_acute in('07','08')*/  
GROUP BY appoint.placename order BY count(referout_no) DESC";
$query=mysql_query($sql) or die(mysql_error());
$numrow=mysql_num_rows($query);
if($numrow==0){
	$total=0;
	$c[]="";
	$a['app'][]=0;
	$a['visit'][]=0;
}else{
	while($rs=mysql_fetch_array($query)){
		$total=$rs[0]+$total;
		$c[]=$rs[2];
		$a['app'][]=$rs[0];
		$a['visit'][]=$rs[1];
		//array_push($data,$a);			
	}
}
$b[]=number_format($total);
array_push($data,$b);
array_push($data,$a);
array_push($data,$c);
echo json_encode($data, JSON_NUMERIC_CHECK);
mysql_close($conn);
?>