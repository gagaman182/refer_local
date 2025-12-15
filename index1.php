<?php session_start();
/*
if(!isset($_SESSION['usr']))
{
	header("Location: login.html");
}
*/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>ระบบงาน HIS โรงพยาบาลหาดใหญ่</title>
		<link rel="shortcut icon" href="http://172.16.99.200/web/hy_ico.ico">
		<meta name="description" content="ตรวจสอบข้อมูล &amp; รายงาน" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

   		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/font-awesome/css/all.css" />

		<!--- bootstrap-table ----->
		<link rel="stylesheet" href="assets/bootstrap-table_new/dist/bootstrap-table.min.css">

		<!--- select --->
		<link rel="stylesheet" href="assets/css/bootstrap-select.css">
		<!-- <link rel="stylesheet" href="assets/css/select2.css"> -->

		<style type="text/css">
		
		

		</style>
	</head>
	<body>


			<div class="row">
				<div class="col-md-2">
					<div class="load-html" id="pic" data-source="/his/pmk/get_picture.php"></div>
				</div>
				<div class="col-md-10">
					<form id="profile">	
					<div class="panel  panel-primary">
						<div class="panel-body">
							<div class="form-row">
								<div class="col-md-1 mb-1">
									<label for="hn">HN</label>
									<input type="text" class="form-control" id="hn" placeholder="" value="">
								</div>
								<div class="col-md-2 mb-2">
									<label for="cid">เลขที่บัตร</label>
									<input type="text" class="form-control" id="cid" placeholder="" >
								</div>
								<div class="col-md-2 mb-2">
									<label for="prename">คำนำหน้า</label>
									<input type="text" class="form-control" id="prename" placeholder="" value="">
								</div>
								<div class="col-md-2 mb-2">
									<label for="pname">ชื่อ</label>
									<input type="text" class="form-control" id="pname" placeholder="" value="">
								</div>
								<div class="col-md-2 mb-2">
									<label for="lname">นามสกุล</label>
									<input type="text" class="form-control" id="lname" placeholder="" value=""  >
								</div>
								<div class="col-md-1 mb-1">
									<label for="sex">เพศ</label>
									<select class="form-control" id="sex">
										<option></option>
										<option value="M">ชาย</option>
										<option value="F">หญิง</option>
									</select>
								</div>
								<div class="col-md-2 mb-2">
									<label for="dob">วันเกิด</label>
									<input type="text" class="form-control" id="dob" placeholder=""  >
								</div>
								<div class="col-md-2 mb-2">
									<label for="age">อายุ</label>
									<input type="text" class="form-control" id="age" placeholder="" >
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active " id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true" >ข้อมูลทั่วไป</a>
								<a class="nav-item nav-link" id="nav-admit-tab" data-toggle="tab" href="#nav-admit" role="tab" aria-controls="nav-admit" aria-selected="false">Admit</a>
								<a class="nav-item nav-link" id="nav-visit-tab" data-toggle="tab" href="#nav-visit" role="tab" aria-controls="nav-visit" aria-selected="false">Visit</a>
								<a class="nav-item nav-link" id="nav-fu-tab" data-toggle="tab" href="#nav-fu" role="tab" aria-controls="nav-fu" aria-selected="false">นัด</a>
							</div>
						</nav>

						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
								<div class="form-row">									
									<div class="col-md-2 mb-2">
									<label for="nicname">ชื่อเล่น</label>
									<input type="text" class="form-control" id="nicname" placeholder="" value=""  >
								</div>
								<div class="col-md-2 mb-2">
									<label for="prename_eng">Prename</label>
									<input type="text" class="form-control" id="prename_eng" placeholder="" value=""  >
								</div>
								<div class="col-md-2 mb-2">
									<label for="pname_eng">First Name</label>
									<input type="text" class="form-control" id="pname_eng" placeholder="" value=""  >
								</div>
								<div class="col-md-2 mb-2">
									<label for="lname_eng">Last Name</label>
									<input type="text" class="form-control" id="lname_eng" placeholder="" value=""  >
								</div>
								<div class="col-md-2 mb-2">
									<label for="blood">กรุ๊ปเลือด</label>
									<select class="selectpicker form-control" id="blood"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>								
								</div>	
								<div class="col-md-2 mb-2">
									<label for="eth">สัญชาติ</label>
									<select class="selectpicker form-control" id="eth"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>	
								</div>
								<div class="col-md-2 mb-2">
									<label for="native">เชื้อชาติ</label>
									<select class="selectpicker form-control" id="native"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>	
								</div>
								<div class="col-md-2 mb-2">
									<label for="rel">ศาสนา</label>
									<select class="selectpicker form-control" id="rel"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>
								</div>
								<div class="col-md-2 mb-2">
									<label for="mstatus">สถานะ</label>
									<select class="selectpicker form-control" id="mstatus"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>
								</div>
								<div class="col-md-3 mb-3">
									<label for="edu">การศึกษา</label>
									<select class="selectpicker form-control" id="edu"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>
								</div>									
								<div class="col-md-3 mb-3">
									<label for="prof">อาชีพ</label>
									<select class="selectpicker form-control" id="prof"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
										<option value=""></option>
									</select>
								</div>	
								</div>
								<button class="btn btn-primary" type="submit">Submit form</button>
							</div>

							<div class="tab-pane fade" id="nav-admit" role="tabpanel" aria-labelledby="nav-admit-tab">
								<table id="tbl_admit" class="table" data-toolbar="" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="" data-show-export="true" data-row-style="rowStyle" data-page-size="10" data-show-refresh="true" data-pagination="true" data-export-types="['excel']"   data-locale="th-TH">
									<thead class="thead-light">	
										<tr>														
											<th data-field="id" data-halign="center" data-align="left" data-formatter="autonum">ลำดับที่</th>
											<th data-field="an" data-halign="center" data-align="left">AN</th>    
											<th data-field="dateadmit" data-halign="center" data-align="left">วันที่ Admit</th>    
											<th data-field="datedisch" data-halign="center" data-align="left">วันที่ D/C</th> 
											<th data-field="pla_place" data-halign="center" data-align="left">รหัส Ward</th> 
											<th data-field="ward" data-halign="center" data-align="left">Ward</th>    
											<th data-field="ds_status" data-halign="center" data-align="left">ประเภทการจำหน่าย</th>
										</tr>
									</thead>
									<tbody>														
									</tbody>
								</table>	
							</div>

							<div class="tab-pane fade" id="nav-visit" role="tabpanel" aria-labelledby="nav-visit-tab">
								<table id="tbl_visit" class="table" data-toolbar="" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="" data-show-export="true" data-row-style="rowStyle" data-page-size="10" data-show-refresh="true" data-pagination="true" data-export-types="['excel']" data-locale="th-TH">
									<thead class="thead-light">	
										<tr>														
											<th data-field="id" data-halign="center" data-align="left" data-formatter="autonum">ลำดับที่</th>
											<th data-field="visit_type" data-halign="center" data-align="left">Type</th>    
											<th data-field="opd_date" data-halign="center" data-align="left">วันที่ตรวจ</th>    
											<th data-field="opd_time" data-halign="center" data-align="left">เวลา</th>    
											<th data-field="pla_place" data-halign="center" data-align="left">รหัสห้องตรวจ</th>
											<th data-field="halfplace" data-halign="center" data-align="left">ห้องตรวจ</th>    
											<th data-field="doc" data-halign="center" data-align="left">แพทย์</th>
										</tr>
									</thead>
									<tbody>														
									</tbody>
								</table>	
							</div>

							<div class="tab-pane fade" id="nav-fu" role="tabpanel" aria-labelledby="nav-fu-tab">
								<table id="tbl_fu" class="table" data-toolbar="" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="" data-show-export="true" data-row-style="rowStyle" data-page-size="10" data-show-refresh="true" data-pagination="true" data-export-types="['excel']" data-locale="th-TH">
									<thead class="thead-light">	
										<tr>														
											<th data-field="id" data-halign="center" data-align="left" data-formatter="autonum">ลำดับที่</th>
											<th data-field="app_date" data-halign="center" data-align="left">นัดวันที่</th>
											<th data-field="dayofweek" data-halign="center" data-align="left">วัน</th>   
											<th data-field="app_name" data-halign="center" data-align="left">นัดเวลา</th>
											<th data-field="dayofweek" data-halign="center" data-align="left">รหัสห้องตรวจ</th>    
											<th data-field="pla_place" data-halign="center" data-align="left">ห้องตรวจ</th>
											<th data-field="doc" data-halign="center" data-align="left">พบแพทย์</th>    
											<th data-field="pla_place_fu" data-halign="center" data-align="left">ห้องตรวจที่นัด</th>
											<th data-field="pla_palce_fu_date" data-halign="center" data-align="left">วันที่ทำนัด</th>
											<th data-field="del_flag" data-halign="center" data-align="left">ยกเลิกนัด</th>
										</tr>
									</thead>
									<tbody>														
									</tbody>
								</table>	
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>

	<script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

	<!--- bootstrap-table ----->
    <script src="assets/bootstrap-table/src/bootstrap-table.min.js"></script>
	<script src="assets/bootstrap-table/src/bootstrap-table-locale-all.js"></script>
	<script src="assets/bootstrap-table/src/bootstrap-table-export.js"></script>
	<script src="assets/bootstrap-table/src/tableexport.js"></script>

	 <!--- select ---->
	<script src="assets/js/bootstrap-select.js"></script>

</body>
<script type="text/javascript">
	var hn;
	$(document).ready(function() {	
		
	});
	
$(function () {
    $(".load-html").each(function () {
        $(this).load(this.dataset.source);
    });
});

	$("#profile").keypress(function(e) {
	  if (e.which == 13) {
		hn=$('#hn').val();
		//console.log(hn);
		$.ajax({
			url: "/his/pmk/get_profile.php",
			type: "POST",
			data :{get:'profile',hn:hn},
			dataType: "json",
			success: function(data) {
				console.log(data);
				$('#prename').val(data[1]);
				$('#pname').val(data[2]);
				$('#lname').val(data[3]);
				$('#sex').val(data[4]);
				$('#nicname').val(data[5]);
				$('#prename_eng').val(data[6]);
				$('#pname_eng').val(data[7]);
				$('#lname_eng').val(data[8]);
				$('#blood').selectpicker('val', data[9]);
				$('#dob').val(data[10]);
				$('#age').val(data[18]);
				$('#cid').val(data[11]);
				$('#eth').selectpicker('val', data[12]);
				$('#native').selectpicker('val', data[13]);
				$('#rel').selectpicker('val', data[14]);
				$('#mstatus').selectpicker('val', data[15]);
				$('#edu').selectpicker('val', data[16]);
				$('#prof').selectpicker('val', data[17]);

			}
		});
		$('#pic').load("/his/pmk/get_picture.php?hn="+hn);
		$('#tbl_admit').bootstrapTable('refresh', {url: '/his/pmk/get_profile.php?get=admit&hn='+hn });
		$('#tbl_visit').bootstrapTable('refresh', {url: '/his/pmk/get_profile.php?get=visit&hn='+hn });
		$('#tbl_fu').bootstrapTable('refresh', {url: '/his/pmk/get_profile.php?get=fu&hn='+hn });
		return false;
	  }
	  
	});


//***** ทำตัวเลือก drop down ************
	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=blood',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {
				console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#blood").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#blood').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกสัญชาติ
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=eth',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {			
				for (var i = 0; i < data.length; i++) {
				  $("#eth").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#eth').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกเชื้อชาติ
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=native',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {				
				for (var i = 0; i < data.length; i++) {
				  $("#native").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#native').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกศาสนา
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=rel',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {
				for (var i = 0; i < data.length; i++) {
				  $("#rel").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#rel').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกสถานะสมรส
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=mstatus',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {			
				for (var i = 0; i < data.length; i++) {
				  $("#mstatus").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#mstatus').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกการศึกษา
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=edu',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {		
				for (var i = 0; i < data.length; i++) {
				  $("#edu").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#edu').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกอาชีพ
		$.ajax({
			url: '/his/pmk/get_lookup.php?lookup=prof',
			type: "GET",
			dataType: "json",
			cache: false,
			success: function(data) {		
				for (var i = 0; i < data.length; i++) {
				  $("#prof").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#prof').selectpicker('refresh');
			}
		});
	});
	

	function autonum(value, row, index) {
		return index+1;
	}
	
	function rowStyle(row, index) {
		if (row.del_flag=='Y') { // ยกเลิกนัด
			return {
				css: {
					color:"black",
					background:'red',
					//"font-weight": "bold" 
				}
			};
		}
		return {};
		//}
    }
	
</script>