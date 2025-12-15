<?php
	include '../config/conn.php';
	
	if($_REQUEST['get']=="list"){
		$sql="select OPDS.OPD_NO,opds.OPD_VISIT_TYPE,opds.DAILY_QUEUE_NO, opds.SUBSPECIAL,p.HN,p.prename||p.name||' '||p.SURNAME,TRUNC(MONTHS_BETWEEN (OPDS.OPD_DATE,BIRTHDAY ) /12 )  || ' ปี '  ||
		TRUNC(MOD(MONTHS_BETWEEN(OPDS.OPD_DATE,BIRTHDAY),12)) || ' เดือน '  ||
		trunc(OPDS.OPD_DATE-add_months(BIRTHDAY,trunc(months_between(OPDS.OPD_DATE,BIRTHDAY)/12)*12+trunc(mod(months_between(OPDS.OPD_DATE,BIRTHDAY),12)))) ||' วัน'   as age,
		opds.dd_doc_code,doc.PRENAME||doc.name||' '||doc.SURNAME,to_char(opds.opd_time,'hh24:mi'),fu.APPOINT_NAME,OPDS.MARK_YN,(select DISTINCT DATE_DBFS.OPD_NO from DATE_DBFS where DATE_DBFS.OPD_NO=OPDS.OPD_NO)
		FROM
		(SELECT * 
		from OPDS  
		WHERE to_char(OPD_DATE,'yyyy-mm-dd')=to_char(sysdate,'yyyy-mm-dd') AND PLA_PLACECODE='0101' AND MARK_YN IS NULL) opds
		LEFT JOIN DATE_DBFS fu ON opds.pla_placecode=FU.PLA_PLACECODE AND OPDS.PAT_RUN_HN=FU.PAT_RUN_HN AND OPDS.PAT_YEAR_HN=FU.PAT_YEAR_HN AND OPDS.OPD_DATE=FU.APP_DATE
		LEFT JOIN DOC_DBFS doc on DOC.DOC_CODE=opds.dd_doc_code
		INNER JOIN PATIENTS p ON p.RUN_HN=opds.pat_run_hn AND p.YEAR_HN=opds.pat_year_hn

		ORDER BY opds.SCREENING_OPD_DATETIME";

		$data=array();
		set_time_limit(0);		
		$st = oci_parse($con,$sql);
		oci_execute($st,OCI_DEFAULT);
		while(($rs = oci_fetch_array($st,OCI_RETURN_NULLS)) !=false) {
	
			$a['visit_type']=$rs[1];
			$a['q']=$rs[2];
			$a['sub']=$rs[3];
			$a['hn']=$rs[4];
			$a['ptname']=$rs[5];
			$a['age']=$rs[6];
			$a['doc_code']=$rs[7];
			$a['doc_name']=$rs[8];
			$a['opd_time']=$rs[9];
			$a['app_name']=$rs[10];

			if($rs[11]==null){
				$a['mark_yn']='';
			}else{
				$a['mark_yn']='<i class="ace-icon fa fa-check bigger-110 green"></i>';
			}

			if($rs[12]==null){
				$a['fu']='';
			}else{
				$a['fu']='<i class="ace-icon fa fa-check bigger-110 green"></i>';
			}
			array_push($data,$a);
			
		}
	}
	echo json_encode($data);
	oci_close($con);

?>