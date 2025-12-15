<? session_start();
 $_SESSION['page']='pa';
 ob_start();  
if($_SESSION['user_id']==''){
	header("Location:chk_user/user_login.php?page=pa");
	}
?>

<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

<link href="../css/buttom.css" rel="stylesheet" type="text/css" />
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style type="text/css">
body {
	background-image: url(../report/images/cc/cch.jpg);
}
</style>
<style type="text/css">
<!--
.Recordadmin_Odd{
background-color:#F3FBFD; 
/*	background:#FF0;*/
	color:#000000
}
.Recordadmin_Even{
	background-color:#D1E5F0; /*??*/
/*	background:#FF0;*/
	color:#000000
}
.Recordadmin_Hover{
	color:#000000;
/*background-color:#9DD8FF ;*/
 background:#39F;
/**/
}
body,td,th {
	font-family: tahoma;
	font-size: 14px;
}
.style1 {color: #FFFFFF}
.style3 {
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
	color: #000033;

}
.style4 {font-size: 18px}
.style5 {color: #FFFFFF; font-weight: bold; }
-->
	.doc_code {
	border:2px solid #456879;
	border-radius:10px;
	height: 30px;
	width: 300px;
	background-color: #CFF;
	font-size: 18px;
}
</style>
<body>

<?
  function getrowadmin_style($var, $hover=""){
	if($hover){
		if($var%2=='0'){
			$style = "class = 'Recordadmin_Even' onMouseOver='this.className=\"Recordadmin_Hover\"' onMouseOut='this.className=\"Recordadmin_Even\"'";
		}else{
			$style = "class = 'Recordadmin_Odd' onMouseOver='this.className=\"Recordadmin_Hover\"' onMouseOut='this.className=\"Recordadmin_Odd\"'";
		}
	}else{
		if($var%2=='0'){
			$style = "class = 'Recordadmin_Even'";
		}else{
			$style = "class = 'Recordadmin_Odd'";
		}
	}
	return $style;
}
$DateToDay = $_REQUEST['txtdate']; 
$user = "cc";
$pass = "cc";
$host = "192.168.99.250/hy";

$objConnect = oci_connect("$user","$pass","$host"); 
//echo $_SESSION['user_id'];
if(empty($_REQUEST['doc_code'])){
	$doc_code=$_SESSION['user_id'];
	}else{
		$doc_code=$_REQUEST['doc_code'];
		}

//echo $doc_code;

$date_st=$_REQUEST['st'];
$date_sp=$_REQUEST['sp'];

  $datet=substr($date_st,0,2);
  $montht=substr($date_st,3,2);
  $yeart=substr($date_st,6,4)-543;
   $date1=$montht.$datet.$yeart;
   
  $datep=substr($date_sp,0,2);
  $monthp=substr($date_sp,3,2);
  $yearp=substr($date_sp,6,4)-543;
  $date2=$monthp.$datep.$yearp;

$strSQL = "
select i.an,i.hn,i.flname,i.dateadmit,i.datedisch,i.bed_no,i.pla_placecode,i.prediagnos as diag,
TO_CHAR(i.timeadmit, 'HH24:MI:SS') tadmit,
i.datedisch disch,TO_CHAR(i.timedisch, 'HH24:MI:SS') tdisch, 
trunc(months_between(sysdate,i.dateadmit)/12) year,
 trunc(mod(months_between(sysdate,i.dateadmit),12)) month,
 trunc(sysdate-add_months(i.dateadmit,trunc(months_between(sysdate,i.dateadmit)/12)*12
+trunc(mod(months_between(sysdate,i.dateadmit),12)))) day

from ipdtrans i 
where (att_doc='$doc_code') 
and i.datedisch is null
/*
WHERE ((i.dateadmit between to_date('$date1 00:00:00','mm/dd/yyyy HH24:MI:SS') and to_date('$date2 00:00:00','mm/dd/yyyy HH24:MI:SS')
or i.datedisch between to_date('$date1 00:00:00','mm/dd/yyyy HH24:MI:SS') and to_date('$date2 00:00:00','mm/dd/yyyy HH24:MI:SS')
or to_date('$date1  00:00:00','mm/dd/yyyy HH24:MI:SS') > i.dateadmit  and  to_date('$date2 00:00:00','mm/dd/yyyy HH24:MI:SS') < datedisch
or to_date('$date1 00:00:00','mm/dd/yyyy HH24:MI:SS') > i.dateadmit and i.datedisch is null)) 
and (att_doc='$doc_code') 
*/


"; 
$objParse = oci_parse($objConnect, $strSQL);  
oci_execute ($objParse,OCI_DEFAULT); 

?>
<form action="" method="get">
<table width="100%" border="0">
  <tr>
    <td width="50%">&nbsp;
        แพทย์ : 
      <input name="show_arti_topic" type="text" class="doc_code" id="show_arti_topic"  style="font-size:18px" size="40"/>
      <input name="doc_code" type="hidden" id="doc_code" value="" />
      <input name="button" type="submit" class="buttom_shout" id="button" value=" ค้นหา" />
    </td>
    <td width="50%" align="right">
      <?php
	echo '';
	 include'chk_user/session.php';
	 //echo $_POST['hn'];
	 ?>
     </td>
  </tr>
</table>

<br />
<table width="100%" border='1' style='border-collapse: collapse'>
  <tr>
    <td height="38" colspan="10" align="center" bgcolor="#CCCCCC">
      <br /> <?php        
echo  'รายชื่อผู้ป่วยที่ Admit ณ ปัจจุบัน'.'<br><br>';
$objConnect3 = oci_connect("$user","$pass","$host"); 
$strSQL3 = "SELECT * FROM doc_dbfs 
where doc_code='$doc_code'
order by doc_code  "; 
$objParse3 = oci_parse($objConnect3, $strSQL3);  
oci_execute ($objParse3,OCI_DEFAULT); 
while($objResult3 = oci_fetch_array($objParse3,OCI_BOTH)) 
{
	echo 'แพทย์เจ้าของไข้ '.$objResult3['PRENAME'].'  '.$objResult3['NAME'].' '.$objResult3['SURNAME'];
	}
		?></p>
      <p>วันที่ <?  echo date('d-m-Y'); ?></p><br />
      
      </td>
  </tr>
  <tr>
    <td width="2%" rowspan="2" align="center" bgcolor="#CCCCCC">No.</td>
    <td width="8%" rowspan="2" align="center" bgcolor="#CCCCCC">เตียง</td>
    <td width="10%" rowspan="2" align="center" bgcolor="#CCCCCC">AN</td>
    <td width="16%" height="38" rowspan="2" align="center" bgcolor="#CCCCCC">ชื่อ-สกุล</td>
    <td width="25%" rowspan="2" align="center" bgcolor="#CCCCCC">Diagnosis</td>
    <td width="12%" rowspan="2" align="center" bgcolor="#CCCCCC">วันที่ Admit</td>
    <td width="12%" rowspan="2" align="center" bgcolor="#CCCCCC">เวลา Admit</td>
    <td colspan="3" align="center" bgcolor="#CCCCCC">วันที่นอน รพ.</td>
    </tr>
  <tr>
    <td width="6%" align="center" bgcolor="#CCCCCC">ปี</td>
    <td width="4%" align="center" bgcolor="#CCCCCC">เดือน</td>
    <td width="5%" align="center" bgcolor="#CCCCCC">วัน</td>
  </tr>
  <? 
$k=1;
while($objResult = oci_fetch_array($objParse,OCI_BOTH))
{ 
$status=$objResult["DEL_FLAG"];

if($objResult["DEL_FLAG"] =="Y"){
	$bg="#FF0000"; 
}else{$bg="#FFFFFF";
}
?>
  <tr <?php if($objResult['DAY'] >'14' or $objResult['MONTH'] >='1'){echo 'bgcolor="#E7B4BE"';}?> >
    <td align="center"><?= $k++?></td>
    <td><?=$objResult["BED_NO"];?></td>
    <td align="center"><?=$objResult["AN"];?></td>
    <td height="31"><?=$objResult["FLNAME"];?></td>
    <td><?=$objResult["DIAG"];?></td>
    <td align="center"><?=$objResult["DATEADMIT"];?></td>
    <td align="center"><?=$objResult["TADMIT"];?></td>
    <td width="6%" align="center"><?=$objResult["YEAR"];?></td>
    <td width="4%" align="center"><?=$objResult["MONTH"];?></td>
    <td width="5%" align="center" ><?=$objResult["DAY"];?></td>
    </tr>
  <?
  }
//oci_close($objConnect);
$total=$t;
  ?>
</table>
<p><a href="../report/doctor/doc_14day_pdf.php?doc_code=<?php echo $doc_code?>" target="_new"><img src="../images/cc/pdfIcon.png" width="94" height="86" border="0" /> <strong>PDF View / Print</strong></a><strong></strong></p>
</form>
</body>
</html>
		<script type="text/javascript" src="../report/doctor/js/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="../report/doctor/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../report/doctor/js/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="../report/doctor/js/jquery-ui-sliderAccess.js"></script>
        
        <script type="text/javascript" src="../report/doctor/js/autocomplete.js"></script>
<link rel="stylesheet" href="../report/doctor/css/autocomplete.css"  type="text/css"/>
<script type="text/javascript">
function make_autocom(autoObj,showObj){
	var mkAutoObj=autoObj; 
	var mkSerValObj=showObj; 
	new Autocomplete(mkAutoObj, function() {
		this.setValue = function(id) {		
			document.getElementById(mkSerValObj).value = id;
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick ) 
			return ;	
	return "../report/doctor/data2.php?q=" +encodeURIComponent(this.value);
    });	
}	

make_autocom("show_arti_topic","doc_code");
</script>