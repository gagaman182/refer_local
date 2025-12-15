<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>ระบบส่งต่อผู้ป่วย โรงพยาบาลหาดใหญ่</title>
		<link rel="shortcut icon" href="http://172.16.99.200/web/hy_ico.ico">
		<meta name="description" content="ตรวจสอบข้อมูล &amp; รายงาน" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

   		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/font-awesome/css/all.css" />
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<!--- bootstrap-table ----->
		<link rel="stylesheet" href="assets/bootstrap-table_new/dist/bootstrap-table.min.css">

		<!--- select --->
		<link rel="stylesheet" href="assets/css/bootstrap-select.css">
		<!-- <link rel="stylesheet" href="assets/css/select2.css"> -->

		<link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
		<!-- <link rel="stylesheet" href="assets/css/select2.css"> -->

		<style type="text/css">				
			.hide{ 
				display: none;
			}
			.top-container {
			  background-color: #f1f1f1;
			  padding: 30px;
			  text-align: center;
			}

			.header {
			  padding: 10px 16px;
			  background: #555;
			  color: #f1f1f1;
			}

			.content {
			  padding: 16px;
			}

			.sticky {
			  position: fixed;
			  top: 0;
			  width: 100%;
			}

			.sticky + .content {
			  padding-top: 102px;
			}
		</style>
	</head>
	<body class="no-skin">
		<div class="content">
			<div class="main-content-inner">
				<div class="page-content">	
					<div class="row">
						<div class="col-md-12">
							<div class="panel  panel-primary">
								<div class="panel-heading">
									<h3 class="panel-title">ข้อมูลทั่วไป</h3>											
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-row">
												<form class="form-inline" id="frm_search" role="form">
													<div class="form-group mx-sm-3 mb-2">
														<label for="cid" class="sr-only">เลขบัตรประชาชน</label>
														<input type="text" required class="form-control border-danger" id="cid" placeholder="ค้นหา เลขบัตรประชาชน">
													</div>
													<button type="submit" class="btn btn-primary mb-2" id="btn_search">ค้นหา</button>
												</form>
											</div>
										</div>
									</div>
									<form id="frm_profile" role="form">
									<div class="row">
										<div class="col-md-12">
											
											<div class="form-row">
												<div class="col-md-1  mb-1">
													<label for="hn">HN</label>
													<input type="text" class="form-control " name="hn" id="hn" placeholder="" disabled>
												</div>										
												<div class="col-md-3 mb-1">
													<label for="ptname">ชื่อ สกุล</label>
													<input type="text" required class="form-control" id="ptname" placeholder="">
												</div>										
												<div class="col-md-1 mb-1">
													<label for="sex">เพศ</label>
													<select  required class="form-control" id="sex">
														<option></option>
														<option value="M">ชาย</option>
														<option value="F">หญิง</option>
													</select>
												</div>										
												<div class="col-md-1 mb-1">
													<label for="dob">วันเกิด</label>
													<input  required  type="text" id="dob" class="form-control">
												</div>
												<div class="col-md-1 mb-1">
													<label for="blood">กรุ๊ปเลือด</label>
													<select class="selectpicker form-control" id="blood"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>	
												<div class="col-md-1 mb-1">
													<label for="mstatus">สถานะ</label>
													<select required  class="selectpicker form-control" id="mstatus"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>													
												<div class="col-md-2 mb-1">
													<label for="rel">ศาสนา</label>
													<select required  class="selectpicker form-control" id="rel"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>
												<div class="col-md-2 mb-1">
													<label for="tel">เบอร์โทร</label>
													<input required  type="text" id="tel" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-row">
												<div class="col-md-3 mb-1">
													<label for="eth">สัญชาติ</label>
													<select required  class="selectpicker form-control" id="eth"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>	
												<div class="col-md-3 mb-1">
													<label for="native">เชื้อชาติ</label>
													<select required  class="selectpicker form-control" id="native"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>
												<div class="col-md-2 mb-1">
													<label for="edu">การศึกษา</label>
													<select  required class="selectpicker form-control" id="edu"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>	
												<div class="col-md-3 mb-1">
													<label for="prof">อาชีพ</label>
													<select  required class="selectpicker form-control" id="prof"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-row">
												<div class="col-md-3 mb-1">
													<label for="home">ที่อยู่</label>
													<input required  type="text" class="form-control" id="home" placeholder="">
												</div>
												<div class="col-md-1 mb-1">
													<label for="moo">หมู่</label>
													<input type="text" class="form-control" id="moo" placeholder="">
												</div>
												<div class="col-md-2 mb-1">
													<label for="road">ถนน</label>
													<input type="text" class="form-control" id="road" placeholder="">
												</div>
												<div class="col-md-1 mb-1">
													<label for="soi">ซอย</label>
													<input type="text" class="form-control" id="soi" placeholder="">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-row">
												<div class="col-md-2 mb-1">
													<label for="prov">จังหวัด</label>
													<select  required class="selectpicker form-control" id="prov"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
														<option value=""></option>
													</select>								
												</div>														
												<div class="col-md-2 mb-1">
													<label for="amp">อำเภอ</label>
													<select required  class="selectpicker form-control" id="amp"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">														
													</select>								
												</div>
												<div class="col-md-2 mb-1">
													<label for="amp1">ตำบล</label>
													<select required  class="selectpicker form-control" id="amp1"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">														
													</select>								
												</div>
												<div class="col-md-2 mb-1">
													<label for="zip">รหัสไปรษณีย์</label>
													<input type="text" class="form-control" id="zip" placeholder="">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-row">												
												<div class="col-md-2 mb-1">
													<label for="father">บิดา</label>
													<input type="text" class="form-control" id="father" placeholder="">
												</div>
												<div class="col-md-2 mb-1">
													<label for="mother">มารดา</label>
													<input type="text" class="form-control" id="mother" placeholder="">
												</div>
												<div class="col-md-2 mb-1">
													<label for="wifename">คู่สมรส</label>
													<input type="text" class="form-control" id="wifename" placeholder="">
												</div>												
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-md-12">																						
											<button type="submit" class="btn btn-primary" id="btn_save">บันทึก</button> <button type="button" class="btn btn-primary" id="btn_reset">ยกเลิก</button>																						
										</div>									
									</div>
									</form>
								</div>
							</div>
						</div>									
					</div>
				</div>
			</div>
		</div>
	</body>

	<div id="modal_wait" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">			
				<div class="modal-body text-center" id="display">
					<i class="fa fa-spinner fa-pulse fa-4x fa-fw text-primary"></i>กรุณารอสักครู่ ...	
				</div>				
			</div>					
		</div>
	</div>

	<div id="modal_nodata" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">			
				<div class="modal-body text-center" id="display_nodata">
					<!-- <i class="fa fa-exclamation fa-2x text-warning"></i> ไม่พบข้อมูลในฐานข้อมูล  -->
				</div>				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">ตกลง</button>
			</div>
			</div>					
		</div>
	</div>

	<script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/locales/bootstrap-datepicker.th.min.js"></script>


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

	$('#dob').datepicker({
		format: "dd-mm-yyyy",
		todayBtn: "linked",
		language: "th",
		autoclose: true,
		todayHighlight: true
	});

	$("#cid").keyup(function(){		
		//console.log(this.value);
	});

	$('#frm_search').submit(function(e){	
		e.preventDefault(); // ใส่เพื่อให้ bootbox ทำงาน
		searchpt();
	});

	$("#prov").on('change',function(){	
		$("#amp").empty();
		$("#amp1").empty();
		$('#amp').selectpicker('refresh');
		$('#amp1').selectpicker('refresh');
		var prov_code=this.value;
		amp(prov_code,'');
		
	});

	$("#amp").on('change',function(){
		$("#amp1").empty();
		$('#amp1').selectpicker('refresh');
		//var prov_code=$("#prov").val();
		var amp_code=this.value;
		tambon(amp_code,'');
	});

	function searchpt(){
		resetform();
		var q=$("#cid").val();
		
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:q,func:'get_profile'},
			cache: false,	
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
			},
			success: function(data) {
				if(data[0]!=null){
					$("#hn").val(data[0]);
					$('#ptname').val(data[1]);
					$('#sex').val(data[2]);
					$('#dob').val(data[4]);
					$("#blood").selectpicker('val',data[3]);
					$("#mstatus").selectpicker('val',data[10]);
					$("#rel").selectpicker('val',data[9]);
					$("#eth").selectpicker('val',data[8]);
					$("#native").selectpicker('val',data[7]);
					$("#edu").selectpicker('val',data[11]);
					$("#prov").selectpicker('val',data[20]);				
					
					amp(data[20],data[19]);
					tambon(data[19],data[18]);

					$("#zip").val(data[21]);
					$('#home').val(data[14]);
					$("#road").val(data[15]);
					$('#moo').val(data[16]);
					$("#soi").val(data[17]);
					$('#prof').selectpicker('val',data[13]);
					$("#father").val(data[22]);
					$("#mother").val(data[24]);
					$("#wifename").val(data[26]);
					$('#tel').val(data[5]);
					$("#modal_wait").modal('hide');		        
				}else{
					search_thairefer(q);					
					return false;
				}
			},
			error:function(err){
				console.log(err);
				$("#modal_wait").modal('hide');
			}
		});				
	}

	$("#frm_profile").on('submit',function(e){
		e.preventDefault();
		var cid=$("#cid").val();
		
		var formData = new FormData($("#frm_profile")[0]);
		//formData['cid']=cid;
		//console.log(formData.length);
		//console.log(cid);
		$.ajax({
			url: 'save.php',
			type : 'POST',
			async: true,
			data : formData,
//			contentType: false,
//			data: formData,		
//			processData: false,
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
			},
			error: function(data){
				console.log(data);
				$("#modal_wait").modal('hide');
			},
			success: function(data) {
				$("#modal_wait").modal('hide');
				console.log(data);
			}
		});
	});

	$("#btn_reset").click(function(){
		$("#cid").val('');
	});

	function search_thairefer(q){
		resetform();
		$("#modal_wait").modal('hide');
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:q,func:'get_thairefer'},
			cache: false,	
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
			},
			error: function(data){
				//console.log(data);
				$("#modal_wait").modal('hide');
			},
			success: function(data) {				
				if(data[0]!=null){
					$('#ptname').val(data[0]);
					$('#sex').val(data[6]);
					$("#home").val(data[1]);
					$("#prov").selectpicker('val',data[5]);
					amp(data[5],data[5]+data[4]);
					tambon(data[5]+data[4],data[5]+data[4]+data[3]);					
					$("#modal_wait").modal('hide');
					$("#display_nodata").html('<i class="fa fa-exclamation fa-2x text-warning"></i> ไม่พบข้อมูลในฐานข้อมูลของโรงพยาบาลหาดใหญ่ <br>กรุณาบันทึกข้อมูลเพิ่มเติม');
					$('#modal_nodata').modal({backdrop: 'static', keyboard: false}) ;
				}else{
					$("#modal_wait").modal('hide');
					$("#display_nodata").html('<i class="fa fa-exclamation-triangle fa-2x text-danger"></i> ไม่พบข้อมูลในฐานข้อมูล กรุณาตรวจสอบเลขบัตรประชาชนอีกครั้ง');
					$('#modal_nodata').modal({backdrop: 'static', keyboard: false}) ;	
				}				
			}
		});
	}
	
	$("#btn_reset").on('click',function(){
		resetform();
	});
	
	function resetform(){
		$('#frm_profile')[0].reset();
		$("#blood,#mstatus,#rel,#eth,#native,#prov,#edu,#prof").selectpicker('val','');
		$("#amp,#amp1").empty();
		$("#amp,#amp1").selectpicker('refresh');		
	}

	//***** ทำตัวเลือก drop down จาก PMK************
	function tambon(amp_code,tambon_code){ //  ใช้สำหรับเลือกกรุ๊ปเลือด		
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {func:'get_lookup',q:"tambon",q1:amp_code},
			cache: false,
			success: function(data) {				
				for (var i = 0; i < data.length; i++) {
					if(data[i].id==tambon_code){
						//console.log('Y='+data[i].id);
						$("#amp1").append('<option value="' + data[i].id + '" selected>' + data[i].text + '</option>');
					}else{
						//console.log('N');
						$("#amp1").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
					}
				}
				$('#amp1').selectpicker('refresh');
			}
		});
	};
	
	function amp(prov_code,amp_code){ //  ใช้สำหรับเลือกกรุ๊ปเลือด		
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {func:'get_lookup',q:"amp",q1:prov_code},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
					if(data[i].id==amp_code){
						$("#amp").append('<option value="' + data[i].id + '" selected>' + data[i].text + '</option>');
					}else{
						$("#amp").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
					}
				}
				$('#amp').selectpicker('refresh');
			}
		});	
	};
	
	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"prof",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#prof").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#prof').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:'blood',func:'get_lookup',q1:''},
			cache: false,						
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#blood").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#blood').selectpicker('refresh');
			},
			error:function(data){
				console.log(data);
			}
		});
	});
	
	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:'rel',func:'get_lookup',q1:''},
			cache: false,						
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#rel").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#rel').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"native",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#native").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#native').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"eth",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#eth").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#eth').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"edu",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#edu").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#edu').selectpicker('refresh');
			}
		});
	});

	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"mstatus",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#mstatus").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#mstatus').selectpicker('refresh');
			}
		});
	});
	
	$(function(){ //  ใช้สำหรับเลือกกรุ๊ปเลือด
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"prov",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				//console.log(data);
				for (var i = 0; i < data.length; i++) {
				  $("#prov").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#prov').selectpicker('refresh');
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
    }
	
</script>