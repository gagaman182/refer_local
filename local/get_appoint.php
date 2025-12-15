<?php	
	session_start();
	if($_SERVER['REMOTE_ADDR']=='192.168.97.90'){
		//header("Location: http://192.168.4.3/webapp/refer/local");
		die();
	}
	include("../config/conn_refer.php");
	//echo $_GET['q'];

	if($_GET['q']=='new'){
		$sql="SELECT DISTINCT patients.id, patients.cid,concat(concat(concat(patients.prename,patients.ptname),' '),patients.lname) as ptname,
		hospital.hoscode5, date_format(appoint.date_app,'%d-%m-%Y') as dateapp,
		CASE
			when appoint.date_created is NULL THEN date_format(patients.date_create,'%d-%m-%Y %H:%i:%s')
			ELSE date_format(appoint.date_created,'%d-%m-%Y %H:%i:%s') 
		END as datecreate,
		CASE
			WHEN patients.hospcode='Regis' THEN 'ทำบัตร Online'
			ELSE hospital.HOSNAME
		END hosname,
		concat(date_format(patients.dob,'%d-%m-'),date_format(patients.dob,'%Y')+543)  as birthday,
		appoint.referout_no,
		appoint.placecode,
		appoint.placename,
		appoint.time_app,
		appoint.referout_no,
		patients.hn,
		CASE
			WHEN patients.tel=patients.tel_connect THEN patients.tel
			ELSE concat(concat(patients.tel,', '),patients.tel_connect)
		END as tel
		FROM patients 
		LEFT JOIN appoint ON patients.cid=appoint.cid 
		left JOIN hospital ON appoint.user_app=hospital.HOSCODE5 
		where patients.del_flag is null ";
		
		if($_GET['status']=='0'){
			$sql.="and (patients.hn is null or patients.hn='') ORDER BY patients.date_create desc";
		}elseif($_GET['status']<>'0'){
			$sql.="and (patients.hn is not null and patients.hn<>'') ORDER BY patients.date_create desc";
		}
		
		//echo $sql;
		//die();
		$data=array();
	
		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){	
			$a['id']=$rs['id'];
			$a['cid']=$rs['cid'];
			$a['ptname']=$rs['ptname'];
			$a['hoscode5']=$rs['hoscode5'];
			$a['dateapp']=$rs['dateapp'];
			$a['datecreate']=$rs['datecreate'];
			$a['hosname']=$rs['hosname'];
			$a['birthday']=$rs['birthday'];
			$a['referout_no']=$rs['referout_no'];
			$a['placename']=$rs['placename'];
			$a['placecode']=$rs['placecode'];
			$a['time_app']=$rs['time_app'];
			$a['pt_tel']=$rs['tel'];
			$a['hn']=$rs['hn'];
			$a['del']='<i class="fas fa-trash-alt text-danger"></i>';
			array_push($data,$a);		
		}

		echo  json_encode($data);
		//chk_app_status('1/49');
	}elseif($_GET['q']=='dayclick'){
		$sql="SELECT count(DISTINCT appoint.cid),(select DISTINCT total_app.total_app FROM total_app WHERE total_app.placecode='".$_GET['pla']."' AND total_app.opd_exam=dayofweek('".$_GET['date_app']."')) ,(select DISTINCT total_app.time_app FROM total_app WHERE total_app.placecode='".$_GET['pla']."' AND total_app.opd_exam=dayofweek('".$_GET['date_app']."')) 
			FROM appoint
			LEFT JOIN total_app ON appoint.placecode=total_app.placecode
			WHERE appoint.del_flag <>'Y' and date_format(appoint.date_app,'%Y-%m-%d')='".$_GET['date_app']."' AND appoint.placecode='".$_GET['pla']."'";
		$data=array();
		$query=mysql_query($sql);
		while($rs=mysql_fetch_array($query)){			
			$a['total_appoint']=$rs[0];
			$a['total']=$rs[1];
			$a['time_app']=$rs[2];			
			array_push($data,$a);
		}
		echo  json_encode($data);
	}elseif($_GET['q']=='app'){
		$app_status=$_GET['app_status'];
		$date_app=$_GET['date_app'];
		$date_app=explode("-",$date_app);
		$date_app=$date_app[2]."-".$date_app[1]."-".$date_app[0];
		$date_list=$_GET['date_list'];
		//echo $_GET['date_app']."<br>";

		if($_GET['pla']==''){
			$sql="SELECT DISTINCT x.*,
					CASE
						WHEN x.hn_app='' OR x.hn_app is NULL THEN (select hn from patients WHERE patients.cid=x.cid AND patients.hospcode=x.user_app)
						ELSE x.hn_app
					END as hn
					FROM
					(SELECT appoint.id as appoint_id,patients.id as id,appoint.cid,appoint.hn as hn_app,appoint.ptname,appoint.placecode,appoint.placename,date_format(appoint.date_app,'%d-%m-%Y') as dateapp,appoint.time_app,hospital.HOSNAME as hosname,date_format(appoint.date_created,'%d-%m-%Y') as datecreate,appoint.referout_no,appoint.date_app ,appoint.visit_opd,appoint.user_app,status_app,total_app.placecode_main,appoint.visit_appoint,refer_appoint,appoint.date_created,date_format(appoint.date_created,'%H:%i') as timecreate,moph,appoint.pt_tel
					FROM appoint 
					LEFT JOIN total_app ON appoint.placecode=total_app.placecode
					LEFT JOIN patients ON appoint.cid=patients.cid AND appoint.user_app=patients.hospcode 
					left JOIN hospital ON appoint.user_app=hospital.HOSCODE5 
					where ";
					if($app_status=="1"){
						$sql.="(status_app is null or status_app='') and ";
					}elseif($app_status=="0"){
						$sql.="";
					}
					$sql.="appoint.del_flag <> 'Y') x where ";
					if($date_list=="date_appoint"){
						$sql.="x.date_app='".$date_app."' ";
					}elseif($date_list=="date_register"){
						$sql.="date_format(x.date_created,'%Y-%m-%d')='".$date_app."' ";
					}
					
					$sql.=" ORDER BY x.date_created DESC";
		}else{
			$sql="SELECT DISTINCT x.*,
					CASE
						WHEN x.hn_app='' OR x.hn_app is NULL THEN (select hn from patients WHERE patients.cid=x.cid AND patients.hospcode=x.user_app)
						ELSE x.hn_app
					END as hn
					FROM
					(SELECT appoint.id as appoint_id,patients.id as id,appoint.cid,appoint.hn as hn_app,appoint.ptname,appoint.placecode,appoint.placename,date_format(appoint.date_app,'%d-%m-%Y') as dateapp,appoint.time_app,hospital.HOSNAME as hosname,date_format(appoint.date_created,'%d-%m-%Y') as datecreate,appoint.referout_no,appoint.date_app ,appoint.visit_opd,appoint.user_app,status_app,total_app.placecode_main,appoint.visit_appoint,refer_appoint,appoint.date_created,date_format(appoint.date_created,'%H:%i') as timecreate,moph,appoint.pt_tel
					FROM appoint 
					LEFT JOIN total_app ON appoint.placecode=total_app.placecode
					LEFT JOIN patients ON appoint.cid=patients.cid AND appoint.user_app=patients.hospcode 
					left JOIN hospital ON appoint.user_app=hospital.HOSCODE5 where ";
					if($app_status=="1"){
						$sql.="(status_app is null or status_app='') and ";
					}elseif($app_status=="0"){
						$sql.="";
					}
					$sql.="appoint.del_flag <> 'Y' and total_app.placecode_main='".$_GET['pla']."') x where ";
					if($date_list=="date_appoint"){
						$sql.="x.date_app='".$date_app."' ";
					}elseif($date_list=="date_register"){
						$sql.="date_format(x.date_created,'%Y-%m-%d')='".$date_app."' ";
					}
					
					$sql.=" ORDER BY x.date_created DESC";
					
		}		

		$data=array();
		//$a['referout_no']=$sql;
		//array_push($data,$a);
		//echo  json_encode($data);
		//die();
		
		$query=mysql_query($sql) or die(mysql_error());
		while($rs=mysql_fetch_array($query)){
			
			$a['id']=$rs['id'];
			$a['referout_no']=$rs['referout_no'];
			//$a['referout_no']=$sql;
			$a['cid']=$rs['cid'];
			$a['ptname']=$rs['ptname'];
			$a['placename']=$rs['placename'];
			$a['dateapp']=$rs['dateapp'];
			$a['time_app']=$rs['time_app'];
			$a['hosname']=$rs['hosname'];
			$a['datecreate']=$rs['datecreate'];
			$a['timecreate']=$rs['timecreate'];
			$a['hn']=$rs['hn'];
			$a['pt_tel']=$rs['pt_tel'];
			//$a['hn']=chk_hn_pmk($rs['cid']);
			$a['app_status_code']=$rs['status_app'];
			
			/*
			if($rs['visit_appoint']=='Y'){
				$a['app_status']='<i class="far fa-check-circle fa-2x text-success" title="ลงนัดใน PMK แล้ว"></i>';			
			}elseif($rs['status_app']==null){
				//$a['app_status']='<i class="far fa-times-circle fa-2x text-warning"></i>';
				$a['app_status']='<i class="far fa-clock fa-2x text-warning"  title="รอลงนัดใน PMK"></i>';
			}elseif($rs['status_app']=='2'){
				$a['app_status']='<i class="far fa-times-circle fa-2x text-danger"  title="ยกเลิกนัดใน PMK แล้ว"></i>';
			}
			*/
			if($rs['visit_appoint']=='Y'){
				$a['visit_appoint']='<i class="far fa-check-circle fa-2x text-success"  title="ลงนัดใน PMK แล้ว"></i>';			
			}else{
				$a['visit_appoint']='<i class="far fa-clock fa-2x text-warning"  title="รอลงนัดใน PMK"></i>';
			}
			if($rs['refer_appoint']=='Y'){
				$a['refer_appoint']='<i class="far fa-check-circle fa-2x text-success"  title="ลงรับ Referใน PMK แล้ว"></i>';			
			}else{
				$a['refer_appoint']='<i class="far fa-clock fa-2x text-warning"  title="รอลงรับ Referใน PMK"></i>';
			}
			if($rs['visit_opd']=='Y'){
				$a['visit_opd']='<i class="far fa-check-circle fa-2x text-success" title="ส่งบัตรตรวจในน PMK แล้ว"></i>';			
			}else{
				$a['visit_opd']='<i class="far fa-clock fa-2x text-warning" title="รอส่งบัตรตรวจใน PMK"></i>';
			}

			if($rs['moph']=='04'){
				$a['moph']='<i class="far fa-check-circle fa-2x text-success" title="มี App หมอพร้อม แล้ว"></i>';
			}elseif($rs['moph']=='05'){
				$a['moph']='<i class="far fa-times-circle fa-2x text-danger" title="ไม่มี App หมอพร้อม"></i>';
			}else{
				$a['moph']='<i class="far fa-clock fa-2x text-warning" title="รอตรวจสอบ App หมอพร้อม"></i>';
			}

			array_push($data,$a);
		}
		//echo $sql."<br>";
		echo  json_encode($data);
	}elseif($_GET['q']=='eventclick'){
		$sql="SELECT appoint.placename,appoint.time_app,referout_no,date_format(appoint.date_app,'%d-%m-%Y'),user_app, ptname,cid,total_app.placecode_main,status_app FROM appoint LEFT JOIN total_app ON appoint.placecode=total_app.placecode WHERE appoint.del_flag <>'Y' and date_format(appoint.date_app,'%Y-%m-%d')='".$_GET['date_app']."' and total_app.placecode_main ='".$_GET['pla']."'";
		
		$data=array();
		
		$query=mysql_query($sql);
		while($rs=mysql_fetch_array($query)){			
			$hn=chk_hn_pmk($rs[6]);
			$a['ptname']=$rs[5];
			$a['placename']=$rs[0];
			$a['time_app']=$rs[1];
			$a['date_app']=$rs[3];
			//$app_status=chk_app_status($hn,$rs['placecode_main'],$_GET['date_app']);
			/*
			if($rs['status_app']=='1'){
				$a['app_status']='<i class="far fa-check-circle fa-2x text-success"></i>';			
			}else{
				$a['app_status']='<i class="far fa-times-circle fa-2x text-warning"></i>';
			}
			*/
			if($rs['status_app']=='1'){
				$a['app_status']='<i class="far fa-check-circle fa-2x text-success" title="ลงนัดใน PMK แล้ว"></i>';			
			}elseif($rs['status_app']==null){
				//$a['app_status']='<i class="far fa-times-circle fa-2x text-warning"></i>';
				$a['app_status']='<i class="far fa-clock fa-2x text-danger" title="รอลงนัดใน PMK"></i>';
			}elseif($rs['status_app']=='2'){
				$a['app_status']='<i class="far fa-times-circle fa-2x text-warning" title="ยกเลิกนัดใน PMK แล้ว"></i>';
			}
			array_push($data,$a);
		}
		echo  json_encode($data);
	}
	//echo  json_encode($data);
	mysql_close($conn);

	function chk_hn_pmk($cid){
		//$hn='';
		include("../config/conn.php");
		$sql_pmk="select hn,locate_position from patients where id_card='".$cid."'";
		$st = oci_parse($con,$sql_pmk);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
			return $rs[0];
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
	}

	function chk_app_status($hn,$placecode,$date_app){	
		include("../config/conn.php");
		$hn=explode("/",$hn);
		$run_hn=$hn[0];
		$year_hn=$hn[1];
		$sql="select count(DISTINCT concat(concat(PAT_RUN_HN,'/'),pat_year_hn)) from DATE_DBFS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' AND PLA_PLACECODE='".$placecode."' AND to_char(APP_DATE,'yyyy-mm-dd')='".$date_app."' AND DEL_FLAG is NULL";
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
		
		$sql="select count(*) from PATIENTS_REFER_HX WHERE IMPORTANT_NO='".$referno."'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

	function chk_appoint_status($hn,$appoint_date,$placecode){	
		include("../config/conn.php");
		$sql="SELECT count(hn) FROM OPD_WAREHOUSE WHERE HN='".$hn."' AND to_char(OPD_DATE,'yyyy-mm-dd')='".$appoint_date."' AND PLA_PLACECODE='".$placecode."'";
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while($rs_pmk=oci_fetch_array($st,OCI_BOTH)){
			return $rs_pmk[0];
			//return $sql."<br>";
		}
		
		oci_close($con);
	}

?>