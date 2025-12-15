<?php
	session_start();
	if($_SESSION['hospcode']=='' or !isset($_SESSION['hospcode'])){
		header("Location: login/index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>ระบบส่งต่อผู้ป่วย โรงพยาบาลหาดใหญ่</title>
		<link rel="shortcut icon" href="http://172.16.99.200/web/hy_ico.ico">
		<meta name="description" content="ส่งต่อผู้ป่วย &amp; รายงาน" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

   		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/font-awesome/css/all.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/css/fontawesome.css">
		<link rel="stylesheet" href="../assets/font-awesome/css/brands.css">
		<link rel="stylesheet" href="../assets/font-awesome/css/solid.css">
				<!--- bootstrap-table ----->
		<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">

		<!--- select --->
		<link rel="stylesheet" href="../assets/css/bootstrap-select.css">
		<!-- <link rel="stylesheet" href="../assets/css/select2.css"> -->

		<link rel="stylesheet" href="../assets/css/bootstrap-datepicker3.min.css">
		<link rel="stylesheet" href="../assets/css/menu.css">

		<link rel="stylesheet" href="../assets/css/fullcalendar.min.css">


		<style type="text/css">				
			#calendar{
				max-width: 800px;		
				margin: 0 auto;
				font-size:16px;
			}  

			tr.custom--success td {
				background-color: #ccffcc !important; /*custom color here*/
			}
			 tr.custom--success-regis td {
			  background-color: #3399ff !important; /*custom color here*/
			}
			.table-hover tbody tr:hover > td {
				cursor: pointer;
			}
			
			.word-wrap {
        word-break: break-all;

    }
		</style>
	</head>
	<body class="no-skin">
	<?php
		include('menu.php');
		include('form_add.php');
		
	?>		
		<div class="main-content-inner">
			<div class="page-content">
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">	
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">รายชื่อผู้ป่วยส่งต่อรอทำประวัติ</h3>											
									</div>
									<div class="panel-body">	
										<table id="tbl_ptlist" class="table" data-toolbar="#toolbar_regis" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="get_appoint.php?q=new&status=0" data-show-export="true" data-pagination="true" data-row-style="rowStyle" data-locale="th-th" data-export-types="['excel']" data-page-size="5" data-auto-refresh="true">
											<thead class="thead-light">	
												<tr>
													<th data-formatter="autonum">#</th>
													<th data-field="referout_no">เลขที่ใบ Refer</th>
													<th data-field="cid">เลขบัตรปปช.</th>
													<th data-field="ptname">ชื่อ สกุล</th>
													<!-- <th data-field="placecode">รหัสห้องตรวจ</th> -->
													<!-- <th data-field="placename">ชื่อห้องตรวจ</th>
													<th data-field="dateapp">วันที่นัดพบแพทย์</th>
													<th data-field="time_app">เวลานัดพบแพทย์</th> -->
													<th data-field="datecreate">วันที่ทำรายการ</th>
													<th data-field="hosname">รพ.ต้นทาง</th>
												</tr>
											</thead>													
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-danger">
									<div class="panel-heading">
										<h3 class="panel-title">รายชื่อผู้ป่วยขอพบแพทย์</h3>											
									</div>
									<div class="panel-body">	
										<table id="tbl_appoint_walkin" class="table" data-toolbar="#toolbar_appoint_walkin" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="get_appoint_walkin.php?status=1" data-show-export="true" data-pagination="true" data-row-style="rowStyle" data-locale="th-th" data-export-types="['excel']" data-page-size="5" data-auto-refresh="true">
											<thead class="thead-light">	
												<tr>
													<th data-formatter="autonum">#</th>
													<th data-field="hn">HN</th>
													<th data-field="cid">เลขบัตรปปช.</th>
													<th data-field="ptname">ชื่อ สกุล</th>
													<th data-field="chif" class="word-wrap">อาการสำคุญ</th>
													<!-- <th data-field="placename">เบอร์โทร</th> -->
													<th data-field="appoint_date">วันเวลานัดพบแพทย์</th>
													<th data-field="place">นัดตรวจแผนก</th>
													<th data-field="doctor">นัดพบแพทย์</th>
													<!--<th data-field="hosname">รพ.ต้นทาง</th> -->
												</tr>
											</thead>													
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade" id="list-app" role="tabpanel" aria-labelledby="list-app-list">	
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">รายชื่อผู้ป่วยส่งต่อรอทำนัด</h3>											
									</div>
									<div class="panel-body">
										<div id="toolbar">
											<div class="form-inline">
												<label class="my-1 mr-2" for="pla">แผนก </label>
												<select  class="selectpicker" name="pla" id="pla" data-live-search="true" data-style="btn-new" title="เลือกแผนก ..." data-size="10">
													<option value=""></option>
												</select>&nbsp;
												<label class="my-1 mr-2" for="referout_date">วันที่นัด  </label>
												<input type="text" class="form-control" id="referout_date" name="referout_date" value=" <?= date("d-m-Y") ?>">
											</div>
										</div>												
										<table id="tbl_ptapp" class="table" data-toolbar="#toolbar"  data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="get_appoint.php?q=app&pla=&date_app=<?=date("d-m-Y");?>" data-show-export="true" data-pagination="true" data-row-style="rowStyle" data-export-types="['excel']" data-locale="th-th" data-auto-refresh="true">
											<thead class="thead-light">	
												<tr>
													<th data-formatter="autonum">#</th>
													<th data-field="referout_no">เลขที่ใบ Refer</th>
													<th data-field="cid">เลขบัตรปปช.</th>
													<th data-field="hn">HN</th>
													<th data-field="ptname">ชื่อ สกุล</th>
													<th data-field="placename">ห้องตรวจ</th>
													<th data-field="dateapp">วันที่นัดพบแพทย์</th>
													<th data-field="time_app">เวลานัดพบแพทย์</th>	
													<th data-field="hosname">รพ.ต้นทาง</th>
													<th data-field="datecreate">นัดที่ทำการนัด</th>
													<!-- <th data-field="app_status">สถานะการนัด</th> -->
													<!-- <th data-field="app_status_code">สถานะการนัด</th> -->
												</tr>
											</thead>													
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade" id="show-app" role="tabpanel" aria-labelledby="list-show-app">	
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">แสดงจำนวนผู้ป่วยส่งต่อที่นัดตรวจ รพ.หาดใหญ่</h3>											
									</div>
									<div class="panel-body">
										<select  class="selectpicker" name="pla-showapp" id="pla-showapp" data-live-search="true" data-style="btn-new" title="เลือกแผนกตรวจ ..." data-size="10">
											<option value=""></option>
										</select>
										<div id="calendar">	</div>	
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
		<div id="toolbar_regis">
			<select  class="selectpicker" name="patients_status" id="patients_status" data-style="btn-new"  data-size="10">
				<option value="0">รอทำบัตร</option>
				<option value="1">ทำบัตรแล้ว</option>
			</select>	
		</div>

		<div id="toolbar_appoint_walkin">
			<select  class="selectpicker" name="appoint_status" id="appoint_status" data-style="btn-new"  data-size="10">
				<option value="1">รอนัด</option>
				<option value="2">นัดแล้ว</option>
			</select>	
		</div>
	
	<!-- <script src="../../assets/js/jquery-3.2.1.min.js"></script> -->
	<script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/bootstrap-datepicker.min.js"></script>
	<script src="../assets/locales/bootstrap-datepicker.th.min.js"></script>

	<!--- bootstrap-table ----->
    <script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
	<script src="../assets/bootstrap-table/bootstrap-table-locale-all.js"></script>
	<script src="../assets/bootstrap-table/bootstrap-table-auto-refresh.js"></script>
	<script src="../assets/bootstrap-table/bootstrap-table-export.js"></script>
	<script src="../assets/bootstrap-table/tableExport.js"></script>


	 <!--- select ---->
	<script src="../assets/js/bootstrap-select.js"></script>
	
	<script src="../assets/js/bootbox.js"></script>

	<script defer src="../assets/js/fontawesome-all.js"></script>
	<script src="../assets/js/jquery.colorbox.min.js"></script>
	<script type="text/javascript" src="../assets/js/moment.min.js"></script>
	<script type="text/javascript" src="../assets/js/fullcalendar.min.js"></script>
	<script type="text/javascript" src="../assets/js/fullcalendar_th.js"></script>
	
	<!---- script jquery สำหรับใช้งานหลัก ------>
	<script type="text/javascript" src="script.js"></script>

<script type="text/javascript">
	//var referout_no='';
	$(document).ready(function() {		
		//meeting('');
	});

	$("#btn_regis").on('click',function(){
		
		var cid=$("#cid").val();
		//console.log(cid);
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:cid,func:'get_cid',q1:''},
			cache: false,	
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
			},
			error:function(err){
				console.log(err);
			},
			success: function(data) {
				//console.log(data);
				if(data.length=="0"){
					bootbox.alert("ไม่พบ HN ในระบบ PMK กรุณาตรวจสอบ");
					return false;
				}
				send_sms(data[0].HN,data[0].MOBILE);
			}
		});
	});

	$('#modal-addpt').on('hidden.bs.modal', function (e) {
		//console.log('aaa');
		reset_form();
	});

	$("#patients_status").on('change',function(){
		var status=this.value;
		$('#tbl_ptlist').bootstrapTable('refresh',{url : "get_appoint.php?q=new&status="+status});
	});

	$("#appoint_status").on('change',function(){
		var status=this.value;
		$('#tbl_appoint_walkin').bootstrapTable('refresh',{url : "get_appoint_walkin.php?status="+status});
	});

	$("#referout_date,#pla").on('change',function(){
		var pla=$("#pla").val();
		var date_app=$("#referout_date").val();
		//console.log(date_app);
		$('#tbl_ptapp').bootstrapTable('refresh',{url : "get_appoint.php?q=app&pla="+pla+"&date_app="+date_app});
	});

	$('#tbl_ptapp').on('click-row.bs.table', function (e, row, $element) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		//console.log(row.id);
		$('#calendar_edit').fullCalendar( 'destroy' );
		$('#fu_status').val('').trigger('change'); 
		$("#btn_fu").addClass('disabled');


		$("#nav-home-tab,#nav-fu-tab").removeClass('active');
		$("#nav-home,#nav-fu").removeClass('show active');

		$("#nav-profile-tab").addClass('active');
		$("#nav-profile").addClass('show active');

		
		$("#referout_no").val(row.referout_no);

		$("#dateapp_old").val(row.dateapp);
		$("#pla_edit_fu").val(row.placecode);
		$("#planame_edit_fu").val(row.placename);

		showptdetail(row.id,row.cid,row.referout_no);
		showptservice(row.referout_no);
	
		$('#modal-addpt').modal({backdrop: 'static', keyboard: false}) ;

	});

	$('#tbl_ptlist').on('click-row.bs.table', function (e, row, $element) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		//console.log(row.id+' '+row.cid+' '+row.referout_no)
		
		$("#nav-home-tab").addClass('active');
		$("#nav-home").addClass('show active');

		$("#nav-profile-tab").removeClass('active');
		$("#nav-profile").removeClass('show active');
		
		$("#referout_no").val(row.referout_no);

		showptdetail(row.id,row.cid,referout_no);
		showptservice(row.referout_no);
	
		$('#modal-addpt').modal({backdrop: 'static', keyboard: false}) ;

	});
	
	$('#tbl_appoint_walkin').on('click-row.bs.table', function (e, row, $element) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		$("#appoint_walkin_id").val(row.id);
		$("#ptname_appoint").text('ชื่อ สกุล : '+row.ptname);
		$("#chif_appoint").text('อาการสำคัญ : '+row.chif);
		$('#tbl_chk_appoint').bootstrapTable('refresh',{url : "get_check_appoint.php?hn="+row.hn});
		$('#modal_appoint_walkin').modal({backdrop: 'static', keyboard: false}) ;

	});

	$('#tbl_chk_appoint').on('click-row.bs.table', function (e, row, $element) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		$("#app_date").val(row.DATE_APP+' '+row.APPOINT_NAME);
		$("#app_place").val(row.HALFPLACE);
		$("#app_doc").val(row.DOC_NAME);
	});

	// list box เลือก เลือน หรือ ยกเลิกนัด
	$("#fu_status").on('change',function(){
		$('#calendar_edit').fullCalendar( 'destroy' );
		if(this.value=='0'){			
			$("#btn_fu").removeClass('disabled');
			//console.log('เลื่อน');
			meeting('edit',$("#pla_edit_fu").val());
		}else if(this.value=='1'){
			$("#btn_fu").removeClass('disabled');
			//console.log('ยกเลิก');
		}
	});
	
	$("#btn_update_appoint").on("click",function(){
		var id=$("#appoint_walkin_id").val();
		var app_date=$("#app_date").val();
		var app_doc=$("#app_doc").val();
		var app_place=$("#app_place").val();
		$.ajax({
			url: "update_appoint.php",
			type: "POST",
			data: {id:id,app_date:app_date,app_doc:app_doc,app_place:app_place},
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false});
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			},
			success:function(data){
				//console.log(data);
				if(data=="1"){
					$('#tbl_appoint_walkin').bootstrapTable('refresh', {silent: true});
					
					$('#modal_appoint_walkin').modal('hide') ;
					bootbox.alert("ยกเลิกนัดเรียบร้อยแล้ว");
				}else{
					bootbox.alert("ไม่สามารถยกเลิกนัดได้"+data);
				}
			}
		});
	});
	// ปุ่มบันทึก เลื่อน หรือยกเลิกนัด
	$("#btn_fu").on('click',function(){
		var referout_no=$("#referout_no").val();
		var fu_status=$("#fu_status").val();

		$.ajax({
			url: "edit_app.php",
			type: "POST",
			data: {referout_no:referout_no,fu_status:fu_status},
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false});
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			},
			success:function(data){
				//console.log(data);
				if(data=="1"){
					$('#tbl_ptapp').bootstrapTable('refresh', {silent: true});
					$("#btn_fu").addClass('disabled');
					$('#modal-addpt').modal('hide') ;
					bootbox.alert("ยกเลิกนัดเรียบร้อยแล้ว");
				}else{
					bootbox.alert("ไม่สามารถยกเลิกนัดได้");
				}
			}
		});
	});

	// ปุ่มยืนยันการเลื่อนนัด
	$("#btn_appoint").on('click',function(){
		var referout_no=$("#referout_no").val();
		var fu_status=$("#fu_status").val();
		var date_app=$("#date_app").val();

		$.ajax({
			url: "edit_app.php",
			type: "POST",
			data: {referout_no:referout_no,fu_status:fu_status,date_app:date_app},
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false});
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			},
			success:function(data){
				//console.log(data);
				if(data=="1"){
					$('#tbl_ptapp').bootstrapTable('refresh', {silent: true});
					$("#btn_fu").addClass('disabled');
					$('#modal_appoint').modal('hide') ;
					bootbox.alert("เลื่อนนัดเรียบร้อยแล้ว");
					$('#calendar_edit').fullCalendar( 'destroy' );
					meeting('edit',$("#pla_edit_fu").val());
				}else{
					bootbox.alert("ไม่สามารถเลื่อนนัดได้");
				}
			}
		});
	});
	
	function send_sms(hn,mobile){
		//console.log(mobile);
		$.ajax({
			url: 'http://172.16.99.200/otp/otp_check.php',
			type: "POST",
			dataType: "json",
			data : {hn:hn,getlink:hn,mobile:mobile,'ac':'notify_regis_patients',app:'Regis Online'},
			cache: false,
			error:function(err){
				console.log(err);
			},
			success: function(data) {
				console.log(data);
				//$("#div_otp").attr('hidden',false);
				if(data!="1"){
					bootbox.alert("ไม่สามารถส่งข้อความได้");
					return false;
				}
				
				var cid=$("#cid").val();
				$.ajax({
					url: 'update_patients.php',
					type: "POST",
					dataType: "json",
					data : {cid:cid},
					cache: false,
					error:function(err){
						console.log(err);
					},
					success: function(data) {
						if(data!="1"){
							bootbox.alert("ไม่สามารถปรับปรุงสถานะได้");
							return false;
						}
						$('#tbl_ptlist').bootstrapTable('refresh',{url : "get_appoint.php?q=new&status=0"});
						bootbox.alert("ทำงานเรียบร้อยแล้ว");
					}
				});
			}
		});
	}

	function showptservice(referout_no){
		$.ajax({
				url: "get_thairefer.php?q=profile&referout_no="+referout_no,
				type: "POST",
				//data: {},
				beforeSend : function() {
					$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
				},
				 error: function (request, status, error) {
					console.log(request.responseText);
				},
				success:function(data){
					//console.log(data[0].referout_no);
					$("#referout_no").val(referout_no);
					$("#cause_referout_name").val(data[0].cause_referout_name);
					$("#doctor_name").val(data[0].doctor_name);
					$("#cc").val(data[0].cc);
					$("#diag").val(data[0].memoDiag_end);
					$("#t").val(data[0].t);
					$("#pr").val(data[0].p);
					$("#rr").val(data[0].r);
					$("#bp").val(data[0].bp);
					$('#tbl_diag').bootstrapTable('refresh',{url : "get_thairefer.php?q=diag&referout_no="+referout_no});
					$('#tbl_drug').bootstrapTable('refresh',{url : "get_thairefer.php?q=drug&referout_no="+referout_no});
					
				}
			});
   
	}

	function showptdetail(id,cid,referout_no){		
		if(id!=null){ // ดึงข้อมูลทั่วไปของคนไข้ กรณีทำบัตรใหม่ ดึงจากการบันทึกเพิ่มเติม
			$.ajax({
				url: "get_patients.php",
				type: "POST",
				dataType: "json",
				data: {id:id},
				error: function (request, status, error) {
					console.log(request.responseText);
				},
				success:function(data){
					//console.log(data);
					
					$("#hn").val(data[0].hn);
					$("#cid").val(data[0].cid);
					$('#ptname').val(data[0].prename+data[0].ptname);
					$('#sex').val(data[0].sex);
					$('#dob').val(data[0].birth);
					$("#blood").selectpicker('val',data[0].blood);
					$("#mstatus").selectpicker('val',data[0].mstatus);
					$("#rel").selectpicker('val',data[0].rel);
					$("#eth").selectpicker('val',data[0].eth);
					$("#native").selectpicker('val',data[0].native);
					$("#edu").selectpicker('val',data[0].edu);
					$("#prov").selectpicker('val',data[0].prov);
					
					amp(data[0].prov,data[0].amp);
					tambon(data[0].amp,data[0].tambon);

					$("#zip").val(data[0].zip);
					$('#home').val(data[0].home);
					$("#road").val(data[0].road);
					$('#moo').val(data[0].moo);
					$("#soi").val(data[0].soi);
					$('#prof').selectpicker('val',data[0].prof);
					$("#father").val(data[0].father);
					$("#mother").val(data[0].mother);
					$("#wifename").val(data[0].wifename);
					$('#tel').val(data[0].tel);	
					$('#tel_connect').val(data[0].tel_connect);	
					$('#who').val(data[0].who);	
				}
			});
		}else if(id==null){ // ดึงข้อมูลทั่วไปคนไข้ กรณีมี HN แล้วให้ดึงจาก PMK
			$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:cid,func:'get_profile',q1:''},
			cache: false,	
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
			},
			success: function(data) {
				console.log(data);
				if(data[0]!=null){
					$("#hn").val(data[0][0]);
					$('#ptname').val(data[0][1]);
					$('#sex').val(data[0][2]);
					$('#dob').val(data[0][4]);
					$("#blood").selectpicker('val',data[0][3]);
					$("#mstatus").selectpicker('val',data[0][10]);
					$("#rel").selectpicker('val',data[0][9]);
					$("#eth").selectpicker('val',data[0][8]);
					$("#native").selectpicker('val',data[0][7]);
					$("#edu").selectpicker('val',data[0][11]);
					$("#prov").selectpicker('val',data[0][20]);
					
					amp(data[0][20],data[0][19]);
					tambon(data[0][19],data[0][18]);

					$("#zip").val(data[0][21]);
					$('#home').val(data[0][14]);
					$("#road").val(data[0][15]);
					$('#moo').val(data[0][16]);
					$("#soi").val(data[0][17]);
					$('#prof').selectpicker('val',data[0][13]);
					$("#father").val(data[0][22]);
					$("#mother").val(data[0][24]);
					$("#wifename").val(data[0][26]);
					$('#tel').val(data[0][5]);
					$("#modal_wait").modal('hide');		        
				}else{
					//search_thairefer(q);					
					return false;
				}
			},
			error:function(err){
				//console.log(err);
				$("#modal_wait").modal('hide');
			}
		});
		}
		
		$("#btn_save").attr("disabled", true);
	}
	
	function reset_form(){
		$("#hn").val('');
		$("#cid").val('');
		$('#ptname').val('');
		$('#sex').val('');
		$('#dob').val('');
		$('#blood').val('').trigger('change'); 
		$("#mstatus").val('').trigger('change'); 
		$("#rel").val('').trigger('change'); 
		$("#eth").val('').trigger('change'); 
		$("#native").val('').trigger('change'); 
		$("#edu").val('').trigger('change'); 
		$("#prov").val('').trigger('change'); 
		$("#amp").val('').trigger('change'); 
		$("#amp1").val('').trigger('change'); 
		
		//amp(data[0].prov,data[0].amp);
		//tambon(data[0].amp,data[0].tambon);

		$("#zip").val('');
		$('#home').val('');
		$("#road").val('');
		$('#moo').val('');
		$("#soi").val('');
		$('#prof').val('').trigger('change'); 
		$("#father").val('');
		$("#mother").val('');
		$("#wifename").val('');
		$('#tel').val('');	
		$('#tel_connect').val('');	
			
		$("#referout_no").val('');
		$("#cause_referout_name").val('');
		$("#doctor_name").val('');
		$("#t").val('');
		$("#pr").val('');
		$("#rr").val('');
		$("#bp").val('');
		$("#cc").val('');
		$("#diag").val('');
		$('#tbl_diag').bootstrapTable('refresh',{url : ""});
	}
	
	$("#showapp").on('click',function(){
		
	});

	$("#pla-showapp").on('change',function(){
		var pla=$("#pla-showapp").val();
		$('#calendar').fullCalendar( 'destroy' );
		meeting('show',pla);
	});

	function meeting(status,pla){
		console.log(pla);
		if(status=='show'){
			var $calendar=$("#calendar");
		}else if(status=='edit'){
			var $calendar=$("#calendar_edit");
		}
		$calendar.fullCalendar({
		  header: {
			right: 'today prev,next'
		  },
			weekends:false,
			  /*
			events: [
		{
		  id: 'a',
		  title: 'my event',
		  start: '2020-01-02'
		},
			],
			*/
			dayRender: function( date, cell ) { 
				cell.css('cursor', 'pointer');
			},
			//hiddenDays: [ 2] , //hidden วันที่ห้องตรวจไม่เปิด get ค่ามาจาก pmk
			events: {
				url: 'data_events.php?pla='+pla,				
				error: function(err) {
					console.log(err);
				},
				success:function(data){
					//console.log(data);
				}
			},
			
			eventRender: function(event, element) {		
				element.css("font-size", "1.3em");
				element.css("padding", "3px");
				//element.css("backgroundColor","#66cc00");
				element.css("cursor","pointer");
				element.css("text-align", "center");
			},
			eventLimit:true,
	//        hiddenDays: [ 2, 4 ],
			lang: 'th',
			dayClick: function(date) {
				var date_app = date.format('YYYY-MM-DD');
				var date_th = date.format('DD-MM-YYYY');
				var date=date.format();
				//var placecode=pla;
				console.log(pla);
				jQuery.ajax({
					url: 'get_appoint.php',
					type: 'GET',	
					dataType: 'json',	
					data :{date_app:date,q:'dayclick',pla:pla},
					success:function(data){
						//console.log(data);
						if(data[0].total_appoint==data[0].total){ //ตรวจสอบจำนวนนัด เต็มหรือยัง
							var status='N'; // เต็ม
						}else{
							var status='Y'; // ว่าง
						}
						show_app(date_th,pla,status);
					}
				});
				//show_app(date_app,placecode,'Y');

			} ,
			
			eventClick:function(calEvent,date){
				var date_app=calEvent.start.format();
				var pla=$("#pla-showapp").val();
				//console.log(date_app);

				$('#tbl_ptname_appoint').bootstrapTable('refresh',{url : "get_appoint.php?pla="+pla+"&date_app="+date_app+"&q=eventclick"});
				$('#modal_ptname_appoint').modal({backdrop: 'static', keyboard: false}) ;	
				/*
				var title=calEvent.title;
				
				console.log(title);

				var placecode=$("#pla").val();
				var date_app=calEvent.start.format();

				var title=calEvent.title;
				var res = title.split(" / ");
				if(res[0]==res[1]){ //ตรวจสอบจำนวนนัด เต็มหรือยัง
					var status='N'; // เต็ม
				}else{
					var status='Y'; // ว่าง
				}
				//show_app(date_app,placecode,status);
				*/
			}
			
		});
		//console.log(r);
	}

	function show_app(date_app,placecode,status){
		if($("#pla_edit_fu").val()==''){
			$("#pla_edit_fu").notify("กรุณาระบุห้องตรวจที่ต้องการส่งต่อ");
			return false;
		}
		//console.log('aaaa='+status);
		//var cid=$("#cid").val();
		var ptname=$("#ptname").val();
		var referout_no=$("#referout_no").val();
		var placename=$("#planame_edit_fu").val();
		console.log(ptname+' '+referout_no+' '+placename+ ' '+date_app);
		
		if(status=='N'){
			bootbox.alert('<i class="fa fa-ban text-danger fa-4x"></i> ไม่สามารถนัดได้ เนื่องจากนัดเต็มจำนวนแล้ว !!!');
			return false;
		}
		
		$("#date_app").val(date_app);
		
		$("#div_body").html('<ul class="list-inline"><li class="list-inline-item h4">ชื่อ สกุล : </li> <li class="list-inline-item text-primary h4">'+ptname+'</li><br><li class="list-inline-item h4">เลขที่ใบ Refer : </li> <li class="list-inline-item text-primary h4">'+referout_no+'</li><br><li class="list-inline-item h4">นัดตรวจแผนก : </li> <li class="list-inline-item text-primary h4">'+placename+'</li><br><li class="list-inline-item h4">นัดตรวจวันที่ : </li> <li class="list-inline-item text-primary h4">'+date_app+'</li></ul>');
		
		$('#modal_appoint').modal({backdrop: 'static', keyboard: false});
		
		//console.log(date_app+'---'+placecode);
	}
	
</script>
