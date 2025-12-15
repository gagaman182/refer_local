<?php	
	session_start();
	include("../config/conn_refer.php");
	$sql="SELECT id,hn,placecode,date_app,referout_no,visit_appoint,refer_appoint from appoint WHERE (hn is not null or hn<>'') and date_format(referout_date,'%Y-%m-%d')=date_format(now(),'%Y-%m-%d') AND ((refer_appoint ='' or refer_appoint is NULL) or (visit_appoint='' or visit_appoint is null) or (visit_opd='' or visit_opd is null))";
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query)){
		$data=chk_pmk($rs['hn'],$rs['placecode'],$rs['date_app'],$rs['referout_no']);
		//echo $data['HN']."<br>";
		//echo $rs['hn']."==>".$rs['placecode']."==>".$rs['date_app']."==>".$rs['visit_appoint']."==>".$rs['refer_appoint']."==>".$rs['visit_opd']." || ".chk_app_status($rs['hn'],$rs['placecode'],$rs['date_app']."<br>");
		$sql_update="update appoint set visit_appoint='".$data['APPOINT']."', refer_appoint='".$data['REFER']."',visit_opd='".$data['VISIT']."',mark_yn='".$data['MARK_YN']."' where id=".$rs['id'];
		if(mysql_query($sql_update)){
			echo "OK";
		}else{
			echo mysql_error();
		}

	}
	mysql_close($conn);

	function chk_pmk($hn,$placecode,$date_app,$refer_no){	
		include("../config/conn.php");
		$sql="SELECT p.hn,
		CASE 	WHEN d.DATE_SQ is not NULL then 'Y' 	ELSE '' END as appoint,
		CASE 	WHEN o.opd_no is not null then 'Y'  	else '' END as visit,
		CASE 	WHEN r.REFER_NO is not null THEN 'Y' 	ELSE '' END as refer,
		CASE 	WHEN O.MARK_YN is not null then 'Y' 	ELSE '' end as mark_yn 
		FROM (SELECT RUN_HN,YEAR_HN,HN FROM PATIENTS WHERE HN='".$hn."') p
		LEFT JOIN (select * FROM PATIENTS_REFER_HX WHERE IMPORTANT_NO='".$refer_no."') r ON p.run_hn=r.pat_run_hn AND p.year_hn=r.pat_year_hn
		LEFT JOIN (select * FROM OPD_WAREHOUSE WHERE to_char(OPD_WAREHOUSE.OPD_DATE,'yyyy-mm-dd')='".$date_app."' AND OPD_WAREHOUSE.PLA_PLACECODE='".$placecode."') o ON p.hn=o.hn
		LEFT JOIN (select * FROM DATE_DBFS WHERE to_char(DATE_DBFS.APP_DATE,'yyyy-mm-dd')='".$date_app."' AND DATE_DBFS.PLA_PLACECODE='".$placecode."') d ON d.PAT_RUN_HN=p.run_hn AND d.PAT_YEAR_HN=p.year_hn";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk;
		}
		oci_close($con);
	}


?>