<?php
header('Content-Type: application/json');
	include '../config/conn.php';
	if($_POST['get']=="profile"){
		$sql="select hn,concat(concat(concat(prename,PATIENTS.name),' '),SURNAME) as ptname,
			sex,
			PATIENTS.BG_BLOOD_GR_ID,
			to_char(BIRTHDAY,'dd-mm-yyyy'),PATIENTS.MOBILE,
			FLOOR(MONTHS_BETWEEN(to_date(SYSDATE),to_date(BIRTHDAY))/12)||' ปี ' || FLOOR(MOD(MONTHS_BETWEEN(to_date(SYSDATE),to_date(BIRTHDAY)),12)) || ' เดือน ' || FLOOR(MOD(MOD(MONTHS_BETWEEN(to_date(SYSDATE),to_date(BIRTHDAY)),12),4)) || ' วัน' as age,
			PATIENTS.NATIVE_ID,
			PATIENTS.ETH_ETHNIC_ID,
			PATIENTS.REL_RELIGION_ID,
			PATIENTS.MAR_MARYSTATUS_ID,
			PATIENTS.EDUCATION_CODE,
			ID_CARD,PRO_PROFF_ID,
			home,PATIENTS.ROAD,PATIENTS.VILLAGE, PATIENTS.SOIMAIN,PATIENTS.TAMBON,PATIENTS.DIS_DIST_CODE,
			PATIENTS.PRO1_PROV_CODE,PATIENTS.ZIP_CODE,
			PATIENTS.FATHERNAME,PATIENTS.FATHER_ID,PATIENTS.MOTHERNAME,PATIENTS.MOTHER_ID,
			PATIENTS.WIFENAME,PATIENTS.WHO,PATIENTS.WHO_PLACE,PATIENTS.RELATION
			from patients
			LEFT JOIN PROFFS ON PATIENTS.PRO_PROFF_ID=PROFFS.PROFF_ID
			left join PROVINCES ON PATIENTS.PRO1_PROV_CODE=PROVINCES.PROV_CODE
			LEFT JOIN DISULTS ON PATIENTS.DIS_DIST_CODE=DISULTS.DIST_CODE
			LEFT JOIN TAMBON ON PATIENTS.TAMBON=TAMBON.CODE
			WHERE
			PATIENTS.id_card='".$_POST['id_card']."' ";
		$data=array();
		$data_pic=array();
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {			
			$data=$rs;
			/*
			$sql_pic="select PATIENT_PICTURE.PIC_1 from patients LEFT JOIN PATIENT_PICTURE ON PATIENTS.RUN_HN=PATIENT_PICTURE.PAT_RUN_HN AND PATIENTS.YEAR_HN=PATIENT_PICTURE.PAT_YEAR_HN where hn='1/49'";
			$st_pic=oci_parse($con,$sql_pic);
			oci_execute($st_pic,OCI_DEFAULT);
			while(($rs_pic = oci_fetch_array($st_pic,OCI_RETURN_NULLS)) !=false) {

				array($data_pic,base64_encode($rs_pic[0]));
			}
			echo json_encode($data_pic);
			*/
		}
		



	}elseif($_REQUEST['get']=="visit"){
		$sql="select OPDS.OPD_VISIT_TYPE,to_char(OPDS.OPD_DATE,'dd-mm-yyyy'),to_char(OPDS.OPD_TIME,'hh24:mi:ss'),PLACES.HALFPLACE,DOC_DBFS.PRENAME||DOC_DBFS.name||' '||DOC_DBFS.SURNAME,OPDS.PLA_PLACECODE FROM
		(select * from OPDS WHERE PAT_RUN_HN='".$run_hn."' and PAT_YEAR_HN='".$year_hn."') opds
		LEFT JOIN DOC_DBFS ON OPDS.DD_DOC_CODE=DOC_DBFS.DOC_CODE
		INNER JOIN PLACES ON OPDS.PLA_PLACECODE=PLACES.PLACECODE
		ORDER BY OPD_DATE";
		
		$data=array();
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
			$a['visit_type']=$rs[0];
			$a['opd_date']=$rs[1];
			$a['opd_time']=$rs[2];
			$a['pla_place']=$rs[5];
			$a['halfplace']=$rs[3];
			$a['doc']=$rs[4];
			array_push($data,$a);
		}
	}elseif($_REQUEST['get']=="admit"){
		
		$sql="SELECT IPDTRANS.AN,to_char(IPDTRANS.DATEADMIT,'dd-mm-yyyy')||' '||to_char(IPDTRANS.TIMEADMIT,'hh24:mi:ss'),to_char(IPDTRANS.DATEDISCH,'dd-mm-yyyy hh24:mi:ss'),PLACES.HALFPLACE,DISCHARGE_STATUSES.name,IPDTRANS.DATEADMIT,IPDTRANS.PLA_PLACECODE FROM
		(SELECT * from IPDTRANS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."') IPDTRANS
		LEFT JOIN DISCHARGE_STATUSES ON IPDTRANS.DS_STATUS_ID=DISCHARGE_STATUSES.STATUS_ID
		INNER JOIN PLACES ON IPDTRANS.PLA_PLACECODE=PLACES.PLACECODE
		ORDER BY IPDTRANS.DATEADMIT";	

		$data=array();
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
			$a['an']=$rs[0];
			$a['dateadmit']=$rs[1];
			$a['datedisch']=$rs[2];
			$a['pla_place']=$rs[6];
			$a['ward']=$rs[3];
			$a['ds_status']=$rs[4];
			array_push($data,$a);
		}
	}elseif($_REQUEST['get']=="fu"){
		$sql="SELECT DAY_OF_WK,to_char(DATE_DBFS.APP_DATE,'dd-mm-yyyy'),DATE_DBFS.APPOINT_NAME,PLACES.HALFPLACE,DATE_DBFS.DD_DOC_CODE,DATE_DBFS.DEL_FLAG,PLACES1.halfplace,to_char(DATE_DBFS.DATE_CREATED,'dd-mm-yyyy'),DOC_DBFS.PRENAME||DOC_DBFS.name||' '||DOC_DBFS.SURNAME FROM
		(select * from DATE_DBFS WHERE PAT_RUN_HN='".$run_hn."' AND PAT_YEAR_HN='".$year_hn."' ORDER BY APP_DATE desc) date_dbfs
		LEFT JOIN DOC_DBFS ON DATE_DBFS.DD_DOC_CODE=DOC_DBFS.DOC_CODE
		left JOIN OPDS ON DATE_DBFS.OPD_NO=OPDS.OPD_NO
		left JOIN PLACES PLACES1 ON OPDS.PLA_PLACECODE=PLACES1.PLACECODE
		INNER JOIN PLACES ON DATE_DBFS.PLA_PLACECODE=PLACES.PLACECODE
		ORDER BY APP_DATE DESC";

		$data=array();
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
			$a['app_date']=$rs[1];
			$a['app_name']=$rs[2];
			$a['dayofweek']=dayofweek($rs[0]);
			$a['doc']=$rs[8];
			$a['del_flag']=$rs[5];
			$a['pla_place']=$rs[3];
			$a['pla_place_fu']=$rs[6];
			$a['pla_palce_fu_date']=$rs[7];
			array_push($data,$a);
		}
		
	}
	

	function dayofweek($day){
		if($day=='1'){
			$dayofweek="อาทิตย์";
		}elseif($day=='2'){
			$dayofweek="จันทร์";
		}elseif($day=='3'){
			$dayofweek="อังคาร";
		}elseif($day=='4'){
			$dayofweek="พุธ";
		}elseif($day=='5'){
			$dayofweek="พฤหัสบดี";
		}elseif($day=='6'){
			$dayofweek="ศุกร์";
		}elseif($day=='7'){
			$dayofweek="เสาร์";
		}
		
		return $dayofweek;
	}

	echo json_encode($data);
	oci_close($con);

?>