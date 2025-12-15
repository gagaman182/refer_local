<?php
include("../config/conn_refer.php");
$data=array();
$total=0;
/*
if($_GET['q']=='hosp'){
	$sql="SELECT count(DISTINCT referout_no),concat(hospcode.hosptype,hospcode.hospname),appoint.user_app 
	FROM appoint 
	INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode 
	where (appoint.del_flag is null or appoint.del_flag='')  AND appoint.level_acute in('07','08') AND date_format(appoint.referout_date,'%Y-%m')>='2020-07' GROUP BY concat(hospcode.hosptype,hospcode.hospname),appoint.user_app ORDER BY count(DISTINCT referout_no) DESC";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$count_thairefer=count_thairefer($rs[2]);
		$total=$rs[0]+$total;
		$percen=round(($rs[0]/$count_thairefer)*100,2);
		$a[]=array($rs[1],$percen);
		//array_push($data,$a);			
	}
	$b[]=number_format($total);
	array_push($data,$b);
	array_push($data,$a);
	*/
if($_GET['q']=='hosp'){
	$sql="SELECT count(DISTINCT referout_no) as total_count,concat(hospcode.hosptype,hospcode.hospname) as hosp_name,appoint.user_app 
	FROM appoint 
	INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode 
	where (appoint.del_flag is null or appoint.del_flag='')  /*AND appoint.level_acute in('07','08')*/ AND date_format(appoint.referout_date,'%Y-%m')>='2020-07' GROUP BY concat(hospcode.hosptype,hospcode.hospname),appoint.user_app ORDER BY count(DISTINCT referout_no) DESC";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$total=$rs[0]+$total;
		$a[]=array($rs[1],$rs[0]);
		//array_push($data,$a);			
	}
	$b[]=number_format($total);
	array_push($data,$b);
	array_push($data,$a);
		
}elseif($_GET['q']=='place'){
	/*$sql="SELECT count(DISTINCT appoint.referout_no),total_app.placename_main FROM appoint INNER JOIN total_app ON appoint.placecode=total_app.placecode
	WHERE (appoint.del_flag='' or appoint.del_flag is NULL)  AND date_format(appoint.referout_date,'%Y-%m')>='2020-07'
	GROUP BY total_app.placename_main 
	ORDER BY count(DISTINCT appoint.referout_no) DESC";*/
	$sql="SELECT count(DISTINCT referout_no) as total_count,appoint.placename
	FROM appoint 
	INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode 
	where (appoint.del_flag is null or appoint.del_flag='')  /*AND appoint.level_acute in('07','08')*/ AND date_format(appoint.referout_date,'%Y-%m')>='2020-07' 
GROUP BY appoint.placename ORDER BY count(DISTINCT referout_no) DESC";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$total=$rs[0]+$total;
		$a[]=array($rs[1],$rs[0]);
		//array_push($data,$a);			
	}
	$b[]=number_format($total);
	array_push($data,$b);
	array_push($data,$a);
}elseif($_GET['q']=='m'){
	$sql="SELECT count(DISTINCT appoint.referout_no),date_format(appoint.referout_date,'%Y-%m') FROM appoint INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode 
	WHERE (appoint.del_flag='' or appoint.del_flag is NULL) /*AND appoint.level_acute in('07','08')*/ AND date_format(appoint.referout_date,'%Y-%m')>='2020-07'
	GROUP BY date_format(appoint.referout_date,'%Y-%m')
	ORDER BY date_format(appoint.date_app,'%Y-%m')";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$total=$rs[0]+$total;
		$a[]=array($rs[1],$rs[0]);
		//array_push($data,$a);			
	}
	$b[]=number_format($total);
	array_push($data,$b);
	array_push($data,$a);
}elseif($_GET['q']=='d'){
	$sql="SELECT count(DISTINCT appoint.referout_no),date_format(appoint.referout_date,'%d-%m-%Y') FROM appoint INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode 
	WHERE (appoint.del_flag='' or appoint.del_flag is NULL) /*AND appoint.level_acute in('07','08')*/ AND date_format(appoint.referout_date,'%Y-%m')=date_format(now(),'%Y-%m')
	GROUP BY date_format(appoint.referout_date,'%d-%m-%Y') 
	ORDER BY date_format(appoint.referout_date,'%d-%m-%Y')";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$total=$rs[0]+$total;
		$a[]=array($rs[1],$rs[0]);
		//array_push($data,$a);			
	}
	$b[]=number_format($total);
	array_push($data,$b);
	array_push($data,$a);
}elseif($_GET['q']=='total'){
	include("../config/conn_thairefer.php");
	$sql_appoint="SELECT count(DISTINCT referout_no)
	FROM appoint INNER JOIN hospcode ON appoint.user_app=hospcode.hospcode 
	where (appoint.del_flag is null or appoint.del_flag='')  AND date_format(appoint.referout_date,'%Y-%m')>='2020-07' and appoint.level_acute in('07','08') ";
	$query_appoint=mysql_query($sql_appoint,$conn) or die(mysql_error());
	$rs_appoint=mysql_fetch_array($query_appoint);

	$sql_thairefer="SELECT count(referout_reply.referout_no)
	FROM referout_reply
	INNER JOIN hospcode ON referout_reply.hcode=hospcode.hospcode
	where date_format(referout_date,'%Y-%m')>='2020-07' and referout_reply.station_name='OPD' AND referout_reply.level_acute in('07','08') ";
	$query_thairefer=mysql_query($sql_thairefer,$connect) or die(mysql_error());
	$rs_thairefer=mysql_fetch_array($query_thairefer);
	$total_percen=round(($rs_appoint[0]/$rs_thairefer[0])*100,2);
	$a=array($total_percen);
	array_push($data,$a);	

}

function count_thairefer($hcode){
	include("../config/conn_thairefer.php");
	$sql="SELECT count(referout_reply.referout_no)
	FROM referout_reply
	INNER JOIN hospcode ON referout_reply.hcode=hospcode.hospcode
	where date_format(referout_date,'%Y-%m')>='2020-07' and referout_reply.station_name='OPD' AND referout_reply.level_acute in('07','08') AND hcode='".$hcode."'";
	$query=mysql_query($sql) or die(mysql_error());
	$rs=mysql_fetch_array($query);
	return $rs[0];
	mysql_close($conn);
}

echo json_encode($data, JSON_NUMERIC_CHECK);
mysql_close($conn);
?>