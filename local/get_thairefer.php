<?php
header('Content-Type: application/json');
include("../config/conn_thairefer.php");
//include("../config/conn_thairefer_rh12.php");
$data=array();

if($_GET['q']=='profile'){	
	$sql="SELECT vn,referout_reply.referout_no,doctor_id,doctor_name,drugallergy,cc,t,p,r,bp,memoDiag,hcode ,cause_referout.cause_referout_name,concat(date_format(expire_date,'%d-%m-'),date_format(expire_date,'%Y')+543) as expiredate
		from referout_reply 
		LEFT JOIN cause_referout ON referout_reply.cause_referout_id=cause_referout.cause_referout_id
		where  referout_reply.referout_no='".$_GET['referout_no']."'";

	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		
		array_push($data,$rs);
	}
	
	/*
	$sql="SELECT vn,referout.refer_no,doctor_id,doctor_name,drugallergy,cc,t,p,r,bp,memoDiag_end,hcode ,cause_referout.cause_referout_name,concat(format(expire_date,'dd-MM-'),format(expire_date,'yyyy')+543) as expiredate
		from referout 
		LEFT JOIN cause_referout ON referout.cause_referout_id=cause_referout.cause_referout_id
		where  referout.refer_no=='".$_GET['referout_no']."'";

	$query=sqlsrv_query($sql);
	while($rs=sqlsrv_fetch_array($query)){
		
		array_push($data,$rs);
	}

	sqlsrv_close($conn);
	*/
	
}elseif($_GET['q']=='diag'){
	$sql="select referout_reply_diag.icd10,icd10.`name` ,referout_reply_diag.diagtype_id
		from referout_reply
		INNER JOIN referout_reply_diag ON referout_reply.referout_no=referout_reply_diag.referout_no AND referout_reply.hcode=referout_reply_diag.hcode
		INNER JOIN icd10 ON referout_reply_diag.icd10=icd10.`code`
		WHERE
		referout_reply.referout_no='".$_GET['referout_no']."'";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$a['icdcode']=$rs[0];
		$a['icdname']=$rs[1];
		$a['type']=$rs[2];
		array_push($data,$a);
	}
}elseif($_GET['q']=='drug'){
	$sql="select date_format(referout_reply_drug.makedate,'%d-%m-%Y'),referout_reply_drug.stockname,referout_reply_drug.touse
		from referout_reply
		INNER JOIN referout_reply_drug ON referout_reply.referout_no=referout_reply_drug.referout_no AND referout_reply.hcode=referout_reply_drug.hcode AND referout_reply.hn=referout_reply_drug.hn

		WHERE
		referout_reply.referout_no='".$_GET['referout_no']."'";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$a['datedrug']=$rs[0];
		$a['drugname']=$rs[1];
		$a['druguse']=$rs[2];
		array_push($data,$a);
	}
}

echo  json_encode($data);
mysql_close();
?>