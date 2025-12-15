<?php
header("Content-type: text/json");
include("../config/conn_refer.php");
//include("../config/conn_thairefer.php");
$data=array();
$result=array();
$total=0;
$report_date=explode("-",$_GET['report_date']);
$report_date=$report_date[2].'-'.$report_date[1].'-'.$report_date[0];
if($_GET['q']=='visit'){
	$sql="select count(DISTINCT referout_no) as app, sum(CASE 	WHEN visit_opd='Y' THEN '1'	ELSE '0' END) as visit, concat(hospcode.hosptype,hospcode.hospname)
	FROM appoint 
	INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode
	WHERE DATE_FORMAT(date_app,'%Y-%m-%d')='".$report_date."' and (appoint.del_flag='' or appoint.del_flag is NULL) /*AND appoint.level_acute in('07','08')*/  GROUP BY concat(hospcode.hosptype,hospcode.hospname) order BY count(referout_no) DESC";
	$query=mysql_query($sql,$conn) or die(mysql_error());
	$numrow=mysql_num_rows($query);
	if($numrow==0){
		$total=0;
		$c[]="";
		$a['app'][]=0;
		$a['visit'][]=0;
		$b[]=number_format($total);
		array_push($data,$b);
		array_push($data,$a);
		array_push($data,$c);
	}else{
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
	}
}elseif($_GET['q']=='app'){
	$sql="SELECT count(DISTINCT referout_no) as total_count,concat(hospcode.hosptype,hospcode.hospname)
	FROM appoint 
INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode
where (appoint.del_flag is null or appoint.del_flag='') AND date_format(appoint.referout_date,'%Y-%m-%d')='".$report_date."'
GROUP BY concat(hospcode.hosptype,hospcode.hospname) ORDER BY count(DISTINCT referout_no) DESC";
	$query=mysql_query($sql,$conn) or die(mysql_error());
	$numrow=mysql_num_rows($query);
	if($numrow==0){
		$a['data'][]=array("name"=>"","y"=>"");
	}else{
		while($rs=mysql_fetch_array($query)){
			$a['data'][]=array("name"=>$rs[1],"y"=>(int)$rs[0]);			
		}
	}
	array_push($data,$a);
	//$data['data']=array(array("name"=>"ได้รับวัคซีน 1 เข็ม", "y"=>(int)$rs[0]),array("name"=>"ได้รับวัคซีน 2 เข็ม","y"=>(int)$rs[1]),array("name"=>"ได้รับวัคซีน 3 เข็ม","y"=>(int)$rs[2]),array("name"=>"ได้รับวัคซีน 4 เข็ม","y"=>(int)$rs[3]),array("name"=>"ยังไม่รับวัคซีน","y"=>(int)$rs[4],"color"=>"red","sliced" => true));
}
echo json_encode($data, JSON_NUMERIC_CHECK);
mysql_close($conn);
?>