<?php
include("../config/conn_refer.php");
		// update hn จาก HIS
		$date_start=date('d-m-Y h:i:s');
		echo 'update hn<br>';
		$sql_hn="SELECT DISTINCT patients.cid FROM patients where patients.del_flag is null and (patients.hn is null or patients.hn='')";
		$query_hn=mysql_query($sql_hn) or die(mysql_error());
		while($rs_hn=mysql_fetch_array($query_hn)){
			$array_pmk=chk_hn_pmk($rs_hn['cid']);
			$hn=$array_pmk['hn'];
			$moph=$array_pmk['moph'];
			//echo $hn;
			//die();
			if($hn<>''){
				mysql_query("update appoint set hn='".$hn."' where cid='".$rs_hn['cid']."'",$conn) or die(mysql_error());
				mysql_query("update patients set hn='".$hn."',moph='".$moph."' where cid='".$rs_hn['cid']."'",$conn) or die(mysql_error());
				update_patient_authen($hn,$rs_hn['cid'],$conn);		
			}
		}
		// update สถานะลงนัดใน HIS
		echo 'update appoint<br>';
		$sql="SELECT DISTINCT referout_no,hn,status_app,refer_appoint,visit_appoint,date_app,placecode_main FROM appoint INNER JOIN total_app ON appoint.placecode=total_app.placecode WHERE hn<>'' and (appoint.del_flag ='' or appoint.del_flag is NULL ) AND (visit_appoint is null OR visit_appoint='') AND date_format(date_app,'%Y-%m-%d')>=date_format(now(),'%Y-%m-%d')";

		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$app_status=chk_app_status($rs['hn'],$rs['placecode_main'],$rs['date_app']);	
			//echo $rs['hn'].'-app_status='.$app_status."<br>";
			if($app_status=="1"){			
				mysql_query("update appoint set status_app='1',visit_appoint='Y' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die(' app_status='.mysql_error());
			}
		}	
		
		// update สถานะลงรับ refer ใน HIS
		echo 'update refer<br>';
		$sql="SELECT DISTINCT referout_no FROM appoint WHERE (refer_appoint is NULL or refer_appoint='')  AND date_format(date_app,'%Y-%m-%d')>=date_format(now(),'%Y-%m-%d')";

		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$refer_status=chk_refer_status($rs['referout_no']);
			if($refer_status=="1"){			
				mysql_query("update appoint set refer_appoint='Y' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die('refer_status='.mysql_error());
				//echo "update refer=".$rs['referout_no'];
			}
		}

		
		// update สถานะการ visit บัตรใน HIS
		echo 'update visit<br>';
		$sql="SELECT DISTINCT referout_no,hn,status_app,refer_appoint,visit_appoint,date_app,placecode_main FROM appoint INNER JOIN total_app ON appoint.placecode=total_app.placecode WHERE hn<>'' and (appoint.del_flag ='' or appoint.del_flag is NULL ) AND (visit_appoint is null or visit_appoint is null ='') AND date_format(date_app,'%Y-%m-%d')>=date_format(now(),'%Y-%m-%d')";

		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			$visit_status=chk_visit_status($rs['hn'],$rs['date_app'],$rs['placecode_main']);				
			if($visit_status=="1"){			
				mysql_query("update appoint set visit_opd='Y' where referout_no='".$rs['referout_no']."' and del_flag<>'Y'") or die('visit_status='.mysql_error());
			}

		}
		
		
	echo "check OK<br>";
	echo 'start : '.$date_start.'<br>';
	echo 'end : '.date('d-m-Y h:i:s');
	

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


	function chk_app_status($hn,$placecode,$date_app){	
		include("../config/conn.php");
		//$hn=explode("/",$hn);
		//$run_hn=$hn[0];
		//$year_hn=$hn[1];		

		// ตรวจสอบนัดใน PMK **** ไม่ตรวจสอบแผนกที่นัด เพราะบางครั้งรพช.นัดผิดแผนก
		$sql="SELECT CASE
			WHEN (x.DEL_FLAG='Y' OR x.DELay_FLAG='Y') AND x.HN IS NOT NULL THEN '2'	
			WHEN (x.DEL_FLAG IS null OR x.DELAY_FLAG IS NULL) AND x.HN IS NOT NULL THEN '1'
			END
			FROM
			(SELECT DATE_DBFS.DELAY_FLAG, DATE_DBFS.del_flag, PATIENTS.HN FROM	DATE_DBFS	INNER JOIN PATIENTS ON DATE_DBFS.PAT_RUN_HN=PATIENTS.RUN_HN AND DATE_DBFS.PAT_YEAR_HN=PATIENTS.YEAR_HN
			WHERE	patients.HN ='".$hn."' AND TO_CHAR (DATE_DBFS.APP_DATE, 'yyyy-mm-dd') = '".$date_app."') x";
		
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_refer_status($referno){	
		include("../config/conn.php");
		
		$sql="select count(*) from PATIENTS_REFER_HX WHERE IMPORTANT_NO like '%".$referno."%'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_visit_status($hn,$appoint_date,$placecode){	
		include("../config/conn.php");
		// ตรวจสอบนัดใน PMK **** ไม่ตรวจสอบแผนกที่นัด เพราะบางครั้งรพช.นัดผิดแผนก
		$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_visit_mark_yn($hn,$appoint_date,$placecode){	
		include("../config/conn.php");
		// ตรวจสอบนัดใน PMK **** ไม่ตรวจสอบแผนกที่นัด เพราะบางครั้งรพช.นัดผิดแผนก
		$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."' AND OPD_WAREHOUSE.MARK_YN='Y'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_hn_pmk($cid){
		//echo $cid;
		include("../config/conn.php");
		$sql_pmk="select hn,locate_position from patients where id_card='".$cid."'";
		$st = oci_parse($con,$sql_pmk);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
			$pmk=array("hn"=>$rs[0],"moph"=>$rs[1]);
			//print_r($pmk);
			return $pmk;
		}
		
		oci_close($con);
	}

	function update_patient_authen($hn,$cid){
		include("../config/conn_cc.php");
		$query_update_patient_authen=mysql_query("update patient_authen set hn='".$hn."' where id_card='".$cid."'")  or die(mysql_error());
		//$query_update_patient_authen=mysql_query("update patient_authen set hn='5723/49' where id_card='3860800018271'",$conn_cc)  or die(mysql_error());
		if($query_update_patient_authen){
			return "1";	
		}
		mysql_close($conn_cc);
	}
?>