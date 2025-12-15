<?php
	header("Content-type: text/json");
	include("../config/conn_refer.php");
	/*
	$sql="SELECT patients.cid,patients.hn,patients.prename,patients.ptname,appoint_walkin.chif,patients.tel,patients.status,patients.lname
	FROM patients 
	LEFT JOIN appoint_walkin ON patients.hn=appoint_walkin.hn 
	WHERE  patients.hospcode='Regis' AND (appoint_walkin.chif is NULL or trim(appoint_walkin.chif)='') AND (patients.hn is not null AND patients.hn<>'') AND patients.status='1'
	";	
	*/
	$sql="SELECT patients.cid,patients.hn,patients.prename,patients.ptname,appoint_walkin.chif,patients.tel,patients.status,patients.lname,'new' as pttype,'' as placename,'' as date_app,'' as time_app,'' as referout_no
	FROM patients 
	LEFT JOIN appoint_walkin ON patients.hn=appoint_walkin.hn 
	WHERE  patients.hospcode='Regis' AND (appoint_walkin.chif is NULL or trim(appoint_walkin.chif)='') AND (patients.hn is not null AND patients.hn<>'') AND patients.status='1'
	UNION ALL
	SELECT appoint.cid,appoint.hn,appoint.ptname,'','','',appoint.status_app,'','refer' as pttype,appoint.placename as placename ,date_format(appoint.date_app,'%d-%m-%Y') as date_app,appoint.time_app as time_app,appoint.referout_no as referout_no FROM appoint WHERE line_sms is NULL AND appoint.status_app='1' AND appoint.hn <>'' and appoint.del_flag is NULL";
	$data=array();
	$query=mysql_query($sql) or die(mysql_error());
	while($rs=mysql_fetch_array($query)){
		$userid=get_userid($rs[0],$rs[1]);
		$a['hn']=$rs[1];
		$a['prename']=$rs[2];
		$a['ptname']=$rs[3];
		$a['lname']=$rs[7];
		$a['tel']=$rs[5];
		$a['userid']=$userid;
		$a['pttype']=$rs[8];
		$a['placename']=$rs[9];
		$a['date_app']=$rs[10];
		$a['time_app']=$rs[11];
		$a['referout_no']=$rs[12];
		array_push($data,$a);
	}
	echo  json_encode($data);
	mysql_close();

	function get_userid($cid,$hn){
		include("../config/conn_cc.php");
		$sql="select line_client_id from patient_authen where id_card='".$cid."' and hn='".$hn."'";
		$query=mysql_query($sql);
		$rs=mysql_fetch_array($query);
		return $rs[0];
		mysql_close($conn_cc);
	}
?>