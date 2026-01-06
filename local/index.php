<?php
	/*
	if($_SERVER['REMOTE_ADDR']<>'192.168.4.238'){
		header("Location: http://192.168.4.3/webapp/refer/local");
		die();
	}
	*/
	session_start();
	if($_SESSION['hospcode']=='' or !isset($_SESSION['hospcode'])){
		header("Location: login/index.php");
	}
	date_default_timezone_set("Asia/Bangkok");
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

		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree&display=swap" rel="stylesheet">
		<style type="text/css">		
		
			body {
				font-family: 'Bai Jamjuree', sans-serif;
				font-weight: 600;
			}

			#calendar{
				max-width: 700px;		
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
			.bg-navbar {
				color: #FFFFFF;
				background-color: #585f66;
			}

			.menu-icon {
				background-color: #000000;
			}
			#toTop{
				position: fixed;
				bottom: 10px;
				right: 10px;
				cursor: pointer;
				display: none;
			}

			.a {
			  font-size: 16px;
			 
			}

			.h1-responsive {
				font-size: 250%
			}

			.h2-responsive {
				font-size: 145%;
				/*font-family:  monospace;*/
			}

			.h3-responsive {
				font-size: 135%
			}

			.h4-responsive {
				font-size: 115%
			}

			.h5-responsive {
				font-size: 100%
			}

			@media (min-width: 576px) {
				.h1-responsive {
					font-size: 170%
				}

				.h2-responsive {
					font-size: 140%
				}

				.h3-responsive {
					font-size: 125%
				}

				.h4-responsive {
					font-size: 100%
				}

				.h5-responsive {
					font-size: 90%
				}

				 img {
				max-width: 20%;
			  }
			}

			@media (min-width: 768px) {
				.h1-responsive {
					font-size: 200%
				}

				.h2-responsive {
					font-size: 170%
				}

				.h3-responsive {
					font-size: 140%
				}

				.h4-responsive {
					font-size: 125%
				}

				.h5-responsive {
					font-size: 100%
				}

				 img {
				max-width: 50%;
			  }
			}

			@media (min-width: 992px) {
				.h1-responsive {
					font-size: 200%
				}

				.h2-responsive {
					font-size: 170%
				}

				.h3-responsive {
					font-size: 140%
				}

				.h4-responsive {
					font-size: 125%
				}

				.h5-responsive {
					font-size: 100%
				}

				 img {
				max-width: 50%;
			  }
			}

			@media (min-width: 1200px) {
				.h1-responsive {
					font-size: 250%
				}

				.h2-responsive {
					font-size: 200%
				}

				.h3-responsive {
					font-size: 170%
				}

				.h4-responsive {
					font-size: 140%
				}

				.h5-responsive {
					font-size: 125%
				}

				 img {
				max-width: 100%;
			  }
			}
			.word-wrap {
				word-break: break-all;

			}
			.bg-navbar {
				color: #FFFFFF;
				background-color: #585f66;
			}

			.menu-icon {
				background-color: #000000;
			}
			#toTop{
				position: fixed;
				bottom: 10px;
				right: 10px;
				cursor: pointer;
				display: none;
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
				<div class="tab-content" id="pills-tabContent">
					<!---- **************** การส่งต่อ ************************** --->
					<div class="tab-pane fade show active" id="m-refer" role="tabpanel" aria-labelledby="m-refer">
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">รายชื่อผู้ป่วยส่งต่อรอทำประวัติ</h3>											
									</div>
									<div class="panel-body p-1">	
										<table id="tbl_ptlist" class="table table-sm" data-toolbar="#toolbar_regis" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="get_appoint.php?q=new&status=0" data-show-export="true" data-pagination="true" data-locale="th-th" data-export-types="['excel']" data-page-size="5" data-page-list="[20,50,100,200,All]" data-auto-refresh="true">
											<thead class="thead-light">	
												<tr>
													<th data-formatter="autonum">#</th>
													<th data-field="referout_no">เลขที่ใบ Refer</th>
													<th data-field="hn">HN</th>
													<th data-field="cid">เลขบัตรปปช.</th>
													<th data-field="ptname">ชื่อ สกุล</th>
													<th data-field="pt_tel">เบอร์โทร</th>
													<!-- <th data-field="placecode">รหัสห้องตรวจ</th> -->
													<!-- <th data-field="placename">ชื่อห้องตรวจ</th>
													<th data-field="dateapp">วันที่นัดพบแพทย์</th>
													<th data-field="time_app">เวลานัดพบแพทย์</th> -->
													<th data-field="datecreate">วันที่ทำรายการ</th>
													<th data-field="hosname">รพ.ต้นทาง</th>
													<th data-field="del">ลบ</th>
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
									<div class="panel-body p-1">	
										<!-- <table id="tbl_appoint_walkin" class="table table-sm" data-toolbar="#toolbar_appoint_walkin" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-show-refresh="true" data-url="get_appoint_walkin.php?status=0" data-show-export="true" data-pagination="true" data-row-style="rowStyle" data-locale="th-th" data-export-types="['excel']" data-page-size="5" data-auto-refresh="true"> -->
										<table id="tbl_appoint_walkin" class="table table-sm" data-toolbar="#toolbar_appoint_walkin" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-show-refresh="true" data-url="" data-show-export="true" data-pagination="true" data-row-style="rowStyle" data-locale="th-th" data-export-types="['excel']" data-page-size="5" data-auto-refresh="true">
											<thead class="thead-light">	
												<tr>
													<th data-formatter="autonum">#</th>
													<th data-field="hn">HN</th>
													<th data-field="cid">เลขบัตรปปช.</th>
													<th data-field="ptname">ชื่อ สกุล</th>
													<th data-field="address">ที่อยู่</th>
													<th data-field="chif" class="word-wrap">อาการสำคุญ</th>
													<th data-field="pttype">สิทธิ</th>
													<th data-field="cardid">เลขที่สิทธิ</th>
													<th data-field="hmain">รพ.หลัก</th>
													<!-- <th data-field="appoint_date">วันเวลานัดพบแพทย์</th>
													<th data-field="place">นัดตรวจแผนก</th>
													<th data-field="doctor">นัดพบแพทย์</th> -->
													<!--<th data-field="hosname">รพ.ต้นทาง</th> -->
												</tr>
											</thead>													
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!---- **************** ผู้ป่วยรอทำนัดใน PMK************************** --->
					<div class="tab-pane fade p-1" id="m-history" role="tabpanel" aria-labelledby="m-history-tab">
						<div class="row">
							<div class="col-md-12">
								<div class="alert alert-primary" role="alert">
									Update ... แต่ละ OPD สามารถ lock วันที่ไม่รับ refer ได้ โดยคลิกที่รูป <i class="fas fa-cog fa-2x text-primary"></i> ด้านล่าง
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">รายชื่อผู้ป่วยส่งต่อรอทำนัด</h3>
									</div>
									<div class="panel-body p-1">
										<div id="toolbar">
											<div class="form-inline">
												<label class="my-1 mr-2" for="pla">ห้องตรวจ </label>
												<select  class="selectpicker" name="pla" id="pla" data-live-search="true" data-style="btn-new" title="เลือกแผนก ..." data-size="10">
													<option value=""></option>
												</select>&nbsp;	
												<select  class="selectpicker" name="date_list" id="date_list" data-live-search="true" data-style="btn-new">
													<option value="date_appoint" selected>วันที่นัดพบแพทย์</option>
													<option value="date_register">วันที่พบแพทย์ต้นทาง</option>
												</select>&nbsp;	
												<!-- <label class="my-1 mr-2" for="referout_date">วันที่นัดพบแพทย์  </label> -->
												<input type="text" class="form-control" id="referout_date" name="referout_date" value="<?= date("d-m-Y") ?>"> &nbsp;
												<div class="form-check mb-1 mr-sm-1">
													<div class="custom-control custom-checkbox mr-sm-3 align-self-center">
														<input type="checkbox" class="custom-control-input" id="app_status">
														<label class="custom-control-label" for="app_status">รอลงนัดใน PMK</label>
													</div>
												</div>
												&nbsp;<a href="#" id="setup_slot"><i class="fas fa-cog fa-2x text-primary"></i></a>
											</div>
										</div>												
										<table id="tbl_ptapp" class="table table-sm" data-toolbar="#toolbar"  data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="" data-show-export="true" data-pagination="true" data-row-style="rowStyle" data-export-types="['excel']" data-locale="th-th" data-auto-refresh="true" data-page-list="[20,50,100,200,All]">
											<thead class="thead-light">	
												<tr>
													<th data-formatter="autonum">#</th>
													<!-- <th data-field="referout_no" footerFormatter= "totalNameFormatter">เลขที่ใบ Refer</th> -->
													<th data-field="cid">เลขบัตรปปช.</th>
													<th data-field="hn">HN</th>
													<th data-field="ptname">ชื่อ สกุล</th>
													<th data-field="pt_tel">เบอร์โทร</th>
													<th data-field="placename">ห้องตรวจ</th>
													<th data-field="dateapp" data-sortable="true">วันที่นัดพบแพทย์</th>
													<th data-field="time_app">เวลานัดพบแพทย์</th>	
													<th data-field="hosname">รพ.ต้นทาง</th>
													<th data-field="datecreate" data-sortable="true">วันที่พบแพทย์ต้นทาง</th>
													<th data-field="timecreate" data-sortable="true">เวลา</th>
													<th data-field="visit_appoint" data-align="center">ลงนัดใน PMK</th>
													<th data-field="refer_appoint" data-align="center">ลงรับ Refer</th>
													<th data-field="visit_opd" data-align="center">ส่งบัตรตรวจ</th>
													<th data-field="moph" data-align="center">หมอพร้อม</th>
												</tr>
											</thead>													
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="m-calendar" role="tabpanel" aria-labelledby="m-calendar-tab">
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">แสดงจำนวนผู้ป่วยส่งต่อที่นัดตรวจ รพ.หาดใหญ่</h3>											
									</div>
									<div class="panel-body p-1">
										<select  class="selectpicker" name="pla-showapp" id="pla-showapp" data-live-search="true" data-style="btn-new" title="เลือกแผนกตรวจ ..." data-size="10">
											<option value=""></option>
										</select>
										<div id="calendar">	</div>	
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--- สถิติการนัดผู้ป่วย refer --->
					<div class="tab-pane fade p-1" id="m-report" role="tabpanel" aria-labelledby="m-report-tab">
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">จำนวนการส่งผู้ป่วยนัด Refer Online</h3>											
									</div>
									<div class="panel-body p-1">
										<div class="row">
											<div class="col-md-6">												
												<div class="form-group row">
													<label for="report_date" class="col-sm-2 text-right col-form-label">วันที่ Refer</label>
													<div class="col-sm-3">
														<input type="text" class="form-control" id="report_date" value="<?php echo Date('d-m-Y');?>">
													</div>
												</div>
												<div class="row">									
													<div class="col-md-12 mb-1">
														<div class="card card">
															<!-- <div class="card-header p-1 h5 bg-warning border-warning">
																<i class="fas fa-user-check"></i> ผู้ป่วย Refer Online ทั้งหมด
															</div> -->
															<div class="card-body pt-1 pb-1 text-success">
																<div class="row">
																	<div class="col-12 text-center">
																		<div class="row border-bottom">
																			<div class="col-12 pt-1 pb-1">
																				<span class="h1-responsive text-primary" id="refer_total">-</span><span class="h6-responsive text-dark"> ราย</span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-6 border-right p-1 text-left">
																				<span class="h6-responsive text-dark"> ลงนัดใน PMK</span>
																			</div>
																			<div class="col-6 border-left p-1 text-left">
																				<span class="h6-responsive text-danger"> รอลงนัดใน PMK</span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-6 border-bottom border-right pt-0 pb-2">
																				<span class="h1-responsive" id="appoint_pmk">-</span><span class="h6-responsive text-dark"> ราย</span>
																			</div>
																			<div class="col-6 border-bottom border-left pt-0 pb-2 text-danger">
																				<span class="h1-responsive " id="not_appoint_pmk">-</span><span class="h6-responsive"> ราย</span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-6 border-right p-1 text-left">
																				<span class="h6-responsive text-dark"> ลงรับ Referใน PMK</span>
																			</div>
																			<div class="col-6 border-left p-1 text-left">
																				<span class="h6-responsive text-danger"> รอลงรับ Refer ใน PMK</span>
																			</div>
																		</div>
																		<div class="row">
																			<div class="col-6 border-right pt-0 pb-2">
																				<span class="h1-responsive" id="refer_pmk">-</span><span class="h6-responsive text-dark"> ราย</span>
																			</div>
																			<div class="col-6 border-left pt-0 pb-2 text-danger">
																				<span class="h1-responsive " id="not_refer_pmk">-</span><span class="h6-responsive"> ราย</span>
																			</div>
																		</div>
																		
																	</div>
																</div>														
															</div>											
														</div>
													</div>
												</div>												
											</div>
											<div class="col-md-6">
												<div id="chart_app_place" class="panel panel-default"></div>	
											</div>											
										</div>
										<div class="row">
											<div class="col-md-6">
												<div id="hosp_refer" class="panel panel-default"></div>
											</div>
											<div class="col-md-6">
												<div id="hosp_app" class="panel panel-default"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>						
						<div class="row">							
							<div class="col-md-6">
								<div class="panel  panel-info">
									<div class="panel-heading">
										<h3 class="panel-title">จำนวนผู้ป่วย Refer รายวัน</h3>											
									</div>
									<div class="panel-body p-1">
										<div id="total_d" class="panel panel-default"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">จำนวนผู้ป่วย Refer นัด แยกรายแผนก</h3>											
									</div>
									<div class="panel-body p-1">
										<div id="total_place" class="panel panel-default"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">จำนวนนัด ผู้ป่วย Refer แยกรายรพ. </h3>											
									</div>
									<div class="panel-body p-1">
										<div id="total_hosp" class="panel panel-default"></div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel  panel-primary">
									<div class="panel-heading">
										<h3 class="panel-title">จำนวนผู้ป่วย Refer นัดรายเดือน</h3>											
									</div>
									<div class="panel-body p-1">
										<div id="total_m" class="panel panel-default"></div>
									</div>
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
				<option value="0">รอนัด</option>
				<option value="1">นัดแล้ว</option>
			</select>	
		</div>

		<!--- modal แสดงรายชื่อคนไข้นัดประจำวัน --->
		<div id="modal_ptname_appoint" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">			
					<div class="modal-body">
						<table id="tbl_ptname_appoint" class="table table-sm" data-toolbar="#" data-toggle="table" data-cache="false" data-search="true" data-show-print="false" data-url="" data-show-export="true" data-pagination="true" data-export-types="['excel']" data-row-style="" data-locale="th-th">
							<thead class="thead-light">	
								<tr>
									<th data-formatter="autonum">#</th>
									<th data-field="ptname">ชื่อผู้ป่วย</th>
									<th data-field="placename">แผนกที่นัด</th>
									<th data-field="date_app">วันที่นัด</th>
									<th data-field="time_app">เวลานัด</th>																
									<th data-field="app_status">ลงนัดใน PMK</th>
								</tr>
							</thead>													
						</table>		
					</div>				
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">ตกลง</button>
					</div>
				</div>					
			</div>
		</div>

		<!---- modal แสดงสถานะกรุณารอ --->
		<div id="modal_wait" class="modal" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">			
					<div class="modal-body text-center" id="display">
						<i class="fa fa-spinner fa-pulse fa-4x fa-fw text-primary"></i><br>กำลังตรวจสอบข้อมูล กรุณารอสักครู่ ...	
					</div>				
				</div>					
			</div>
		</div>
	
	<!-- <script src="../../assets/js/jquery-3.2.1.min.js"></script> -->
	<script src="../assets/js/jquery-2.1.4.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
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

	<script src="../assets/js/bootstrap-select.js"></script>

	<script src="../assets/js/highcharts.js"></script>	
	<script src="../assets/js/highcharts-more.js"></script>
	<!-- <script src="../assets/js/solid-gauge.js"></script> -->

	<script src="../assets/js/notify.js"></script>
	
	<!---- script jquery สำหรับใช้งานหลัก ------>
	<script type="text/javascript" src="script.js"></script>

<script type="text/javascript">
	//var referout_no='';
	var datetime=new Date();
	var dateformat = { year: 'numeric', month: 'long' };
	var date_app=$("#referout_date").val();
	var date_list=$("#date_list").val();
	$(document).ready(function() {		
		setInterval(update_appoint, 600000);
		setInterval(pushtext_problem, 600000);
		setInterval(auto_pushtext, 600000);
		getlookup();
		//auto_pushtext();
		$('#tbl_ptapp').bootstrapTable('refresh',{url : "get_appoint.php?q=app&pla=&app_status=0&date_app="+date_app+"&date_list="+date_list});

		$('body').append('<div id="toTop" class="btn btn-info"><i class="fas fa-angle-double-up"></i> ด้านบน</div>');
			$(window).scroll(function () {
				if ($(this).scrollTop() != 0) {
					$('#toTop').fadeIn();
				} else {
					$('#toTop').fadeOut();
				}
			}); 
		$('#toTop').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});		
	});
	
	$(function() { // ใช้สำหรับกำหนดรูปแบบของค่าที่แสดงบนกราฟ ให้มีเครื่องหมาย comma
		Highcharts.setOptions({
			lang: {
				thousandsSep: ','
			}
		});
	});		

	//กำหนดรูปแบบของ datepicker
	$('.datepicker').datepicker({
		format: 'dd-mm-yyyy',
		todayBtn: true,
		autoclose:true,
		language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
		thaiyear: true,           //Set เป็นปี พ.ศ.
		todayHighlight: true,
		//endDate: new Date(new Date().setDate(new Date().getDate()))
	});  //

	$("#tbl_ptapp").on('load-success.bs.table', function (data) {
		//auto_pushtext();
		//console.log('รายชื่อผู้ป่วยนัด refresh');
		// console.log($("#tbl_ptapp").bootstrapTable('getOptions').totalRows);
		// if($("#app_status").is(":checked")){
		// 	if($("#tbl_ptapp").bootstrapTable('getOptions').totalRows>0){
		// 		$.notify('มีผู้ป่วย Refer รอลงนัดใน PMK จำนวน '+$("#tbl_ptapp").bootstrapTable('getOptions').totalRows + ' ราย','info');
		// 	}
		// }
		//console.log(data);
	});

	$('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
		//console.log(e.target.id);
		if(e.target.id=='m-refer-tab'){
			//$('#tbl_ptlist').bootstrapTable('refresh', {silent: true});
		}else if(e.target.id=='m-history-tab'){
			//$('#tbl_history').bootstrapTable('refresh', {silent: true});
		}else if(e.target.id=='m-report-tab'){
			total();
			total_place($("#report_date").val());
			total_m();
			total_d();
			hosp_refer($("#report_date").val());
			chart_app_place($("#report_date").val());
			refer_status($("#report_date").val());
			hosp_app($("#report_date").val());
			//total_percen();
			//$('#tbl_history').bootstrapTable('refresh', {silent: true});
		}

		//console.log(e.target.id);
		e.target // newly activated tab
		e.relatedTarget // previous active tab
	});
	
	$("#report_date").on('change',function(){
		total();
		total_place($("#report_date").val());
		total_m();
		total_d();
		hosp_refer($("#report_date").val());
		chart_app_place($("#report_date").val());
		refer_status($("#report_date").val());
		hosp_app($("#report_date").val());
	});

	$("#pic_cid").on('click',function(){
		var pic=$("#pic").attr('src');
		//console.log(pic);
		///$("#pic_zoom").attr('src',pic);
		window.open(pic);
		//$("#pic").html(html);
		//$("#modal_pic_zoom").modal('show');
	});

	$('#modal-addpt').on('hidden.bs.modal', function (e) {
		//console.log('aaa');
		var status=$("#patients_status").val();
		$('#tbl_ptlist').bootstrapTable('refresh',{url : "get_appoint.php?q=new&status="+status});
		//0$('#tbl_appoint_walkin').bootstrapTable('refresh',{url : "get_appoint_walkin.php?status=1"});
		$('#tbl_appoint_walkin').bootstrapTable('refresh', {silent: true});
		reset_form();
	});

	$("#patients_status").on('change',function(){
		var status=this.value;
		$('#tbl_ptlist').bootstrapTable('refresh',{url : "get_appoint.php?q=new&status="+status});
	});

	$("#appoint_status").on('change',function(){
		var appoint_status=this.value;
		$('#tbl_appoint_walkin').bootstrapTable('refresh',{url : "get_appoint_walkin.php?status="+appoint_status});
	});

	$("#pla,#app_status,#referout_date,#date_list").on('change',function(){
		
		if($("#app_status").is(":checked")){

			var app_status="1";
		}else{
			var app_status="0";
		}

		var pla=$("#pla").val();
		var date_app=$("#referout_date").val();
		var date_list=$("#date_list").val();

		//console.log("pla="+pla + " date_app="+date_app+" app_status="+app_status);
		$('#tbl_ptapp').bootstrapTable('refresh',{url : "get_appoint.php?q=app&pla="+pla+"&app_status="+app_status+"&date_app="+date_app+"&date_list="+date_list});
		
	});

	$('#tbl_ptapp').on('click-row.bs.table', function (e, row, $element) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		getlookup();
		$('#calendar_edit').fullCalendar( 'destroy' );
		$('#fu_status').val('').trigger('change'); 
		$("#btn_fu").addClass('disabled');


		$("#nav-home-tab,#nav-fu-tab,#nav-moph-refer-tab").removeClass('active');
		$("#nav-home,#nav-fu,#nav-moph-refer").removeClass('show active');

		$("#nav-profile-tab").addClass('active');
		$("#nav-profile").addClass('show active');

		
		$("#referout_no").val(row.referout_no);

		$("#dateapp_old").val(row.dateapp);
		$("#pla_edit_fu").val(row.placecode);
		$("#planame_edit_fu").val(row.placename);

		showptdetail(row.id,row.cid,row.referout_no);
		//showptservice(row.referout_no); // Thai Refer - พักไว้ก่อน
		moph_refer(row.referout_no); // ใช้ MOPH Refer เป็นหลัก

		$('#modal-addpt').modal({backdrop: 'static', keyboard: false}) ;

	});

	$('#tbl_ptlist').on('click-row.bs.table', function (e, row, $element,col) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		if(col=='del'){
			bootbox.confirm({
				message: "ต้องการลบรายการนี้ใช้หรือไม่ ?",
				buttons: {
					confirm: {
						label: 'ใช่',
						className: 'btn-success'
					},
					cancel: {
						label: 'ไม่ใช่',
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if(result==true){
						var id=row.id;
						$.ajax({
							url: "delete_patients.php",
							type: "POST",
							data: {id:id},
							beforeSend : function() {
								$('#modal_wait').modal({backdrop: 'static', keyboard: false});
							},
							error: function (request, status, error) {
								$("#modal_wait").modal('hide');
								//console.log(request.responseText);
							},
							success:function(data){
								$('#tbl_ptlist').bootstrapTable('refresh', {silent: true});
								$("#modal_wait").modal('hide');
								bootbox.alert(data);
							}
						});
					}else{
						return false;
					}
				}
			});
		}else{
			getlookup();
			//console.log(row.id+' '+row.cid+' '+row.referout_no)

			$("#nav-home-tab").addClass('active');
			$("#nav-home").addClass('show active');

			$("#nav-profile-tab").removeClass('active');
			$("#nav-profile").removeClass('show active');
			
			$("#referout_no").val(row.referout_no);

			showptdetail(row.id,row.cid,referout_no);
			//showptservice(row.referout_no); // Thai Refer - พักไว้ก่อน
			moph_refer(row.referout_no); // ใช้ MOPH Refer เป็นหลัก
			//var pttype=nhso_check(row.cid);
			//$("#pttype").val(pttype.inscl);
			//$("#cardid").val(pttype.cardid);
			//$("#hmain").val(pttype.hmain);
			//console.log(pttype);
		
			$('#modal-addpt').modal({backdrop: 'static', keyboard: false}) ;
		}
	});
	
	$('#tbl_appoint_walkin').on('click-row.bs.table', function (e, row, $element) {
		$('.custom--success').removeClass('custom--success');        
		$($element).addClass('custom--success');
		if(row.hn==''){
			bootbox.alert ('ผู้ป่วยยังไม่มี HN กรุณาทำประวัติใน PMK');
			$('#tbl_appoint_walkin').bootstrapTable('refresh',{url : "get_appoint_walkin.php?status=0"});
			return false;
		}
		$("#appoint_walkin_id").val(row.id);
		$("#ptname_appoint").text('ชื่อ สกุล : '+row.ptname);
		$("#chif_appoint").text('อาการสำคัญ : '+row.chif);
		$("#userid").val(row.userid);
		$("#hn_walkin").val(row.hn);
		$("#ptname_walkin").val(row.ptname);
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
		//console.log('เลื่อน');
			$("#btn_fu").attr('disabled',true);
			meeting('edit',$("#pla_edit_fu").val());
		}else if(this.value=='1'){
			$("#btn_fu").attr('disabled',false);
			//console.log('ยกเลิก');
		}
	});
	
	$("#btn_update_appoint").on("click",function(){
		var id=$("#appoint_walkin_id").val();
		var app_date=$("#app_date").val();
		var app_doc=$("#app_doc").val();
		var app_place=$("#app_place").val();
		var userid=$("#userid").val();
		var hn=$("#hn_walkin").val();
		var ptname=$("#ptname_walkin").val();
		var message="ชื่อ สกุล : "+ptname+"\nHN : "+hn+"\nนัดวันที่ : "+app_date+"\nนัดแผนก : "+app_place+'\n*** กรุณามาก่อนเวลานัดอย่างน้อย15นาที';
		//console.log(message);
		if(app_date==""){
			bootbox.alert('ยังไม่เลือกวันนัดของผู้ป่วย');
			return false;
		}
		$.ajax({
			url: "update_appoint.php",
			type: "POST",
			data: {id:id,app_date:app_date,app_doc:app_doc,app_place:app_place},
			beforeSend : function() {
				$('#modal_wait').modal({backdrop: 'static', keyboard: false});
			},
			error: function (request, status, error) {
				//console.log(request.responseText);
			},
			success:function(data){
				//console.log(data);
				if(data=="1"){
					var result=pushtext(userid,message,'text','','Register Online');		// function ส่ง line			
					//console.log('text:'+result);
					if(result=="1"){
						//console.log('line='+"OK");
						$("#message").val('');
						$("#appoint_walkin_id").val('');
						$("#app_date").val('');
						$("#app_doc").val('');
						$("#app_place").val('');
						$("#userid").val('');
						$("#hn_walkin").val('');
						$("#ptname_walkin").val('');
						//console.log('log='+result_log);
					}else{
						bootbox.alert('ไม่สามารถส่ง LINE ให้ผู้ป่วยได้  Error : '+result);
					}	
				}else{
					bootbox.alert("ไม่สามารถยืนยันการนัดได้  Error : "+data);
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
					$("#btn_fu").attr('disabled',true);
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

	$("#opd_exam_open").on('click',function(){
		if(this.value=='1'){
			$("#div_opd_exam_day").attr('hidden',true);
			$("#div_opd_exam_all").attr('hidden',false);
		}else if(this.value=='2'){
			$("#div_opd_exam_day").attr('hidden',false);
			$("#div_opd_exam_all").attr('hidden',true);
		}

	});
	
	$("#day_2").on('change',function(){
		if($('#day_2').prop("checked")){
			$("#day_2_time").attr('disabled',false);
			$("#day_2_total").attr('disabled',false);
		}else{
			$("#day_2_time").attr('disabled',true);
			$("#day_2_total").attr('disabled',true);
		}
	});
	
	$("#day_3").on('change',function(){
		if($('#day_3').prop("checked")){
			$("#day_3_time").attr('disabled',false);
			$("#day_3_total").attr('disabled',false);
		}else{
			$("#day_3_time").attr('disabled',true);
			$("#day_3_total").attr('disabled',true);
		}
	});
	$("#day_4").on('change',function(){
		if($('#day_4').prop("checked")){
			$("#day_4_time").attr('disabled',false);
			$("#day_4_total").attr('disabled',false);
		}else{
			$("#day_4_time").attr('disabled',true);
			$("#day_4_total").attr('disabled',true);
		}
	});
	$("#day_5").on('change',function(){
		if($('#day_5').prop("checked")){
			$("#day_5_time").attr('disabled',false);
			$("#day_5_total").attr('disabled',false);
		}else{
			$("#day_5_time").attr('disabled',true);
			$("#day_5_total").attr('disabled',true);
		}
	});
	$("#day_6").on('change',function(){
		if($('#day_6').prop("checked")){
			$("#day_6_time").attr('disabled',false);
			$("#day_6_total").attr('disabled',false);
		}else{
			$("#day_6_time").attr('disabled',true);
			$("#day_6_total").attr('disabled',true);
		}
	});
	$("#setup_slot").on('click',function(){
		
		var pla=$("#pla").val();
		$("#slot_placecode").val(pla);
		$("#slot_place_name").val($('#pla option:selected').text());
		
		if($("#pla").val()==''){
			bootbox.alert('กรุณาเลือกห้องตรวจ...');
			$("#modal_slot").modal('hide');
			return false;
		}
		//console.log($("#pla").val());
		$.ajax({
			url: "get_slot.php",
			type: "POST",
			dataType: "json",
			data: {placecode:pla},
			error: function (request, status, error) {
				console.log(request.responseText);
			},
			success:function(data){
				reset_slot();
				if(data.length=="0"){
					$("#opd_exam_open").val('1');
					$("#div_opd_exam_day").attr('hidden',true);
					$("#div_opd_exam_all").attr('hidden',false);					
				}else if(data.length=="5"){					
					$("#opd_exam_open").val('1');
					$("#div_opd_exam_day").attr('hidden',true);
					$("#div_opd_exam_all").attr('hidden',false);

					$("#setup_time_app").val(data[0].time_app);
					$("#setup_total_app").val(data[0].total_app);
				}else{
					$("#opd_exam_open").val('2');
					$("#div_opd_exam_day").attr('hidden',false);
					$("#div_opd_exam_all").attr('hidden',true);

					for (i = 0; i < data.length; i++) {	
						$("#day_"+data[i].day_app).prop("checked",true);
						$("#day_"+data[i].day_app+"_time").val(data[i].time_app);
						$("#day_"+data[i].day_app+"_total").val(data[i].total_app);
						$("#day_"+data[i].day_app+"_time").attr('disabled',false);
						$("#day_"+data[i].day_app+"_total").attr('disabled',false);
					}
				}
				$("#modal_slot").modal({backdrop: 'static', keyboard: false});

			}
		});

		$("#tbl_holiday_doctor").bootstrapTable('refresh',{url : "get_holiday_doctor.php?pla="+pla});
	});

	$("#btn_slot").on('click',function(){
		var pla=$("#pla").val();
		var pla_name=$("#slot_place_name").val();
		$.ajax({
			url: "edit_slot.php",
			type: "POST",
			data: {q:'del',placecode:pla},
			error: function (request, status, error) {
				bootbox.alert(request.responseText);
				return false;
			},
			success:function(data){
				//console.log(data);			
				if($("#opd_exam_open").val()=='1'){			
					var opd_exam_day = [2,3,4,5,6];	
					var opd_exam_day_name = ['วันจันทร์','วันอังคาร','วันพุธ','วันพฤหัสฯ','วันศุกร์'];
					var time_app=$("#setup_time_app").val();
					var total_app=$("#setup_total_app").val();

					for (i = 0; i < opd_exam_day.length; i++) {
						var day=opd_exam_day[i];
						var day_name=opd_exam_day_name[i];
						$.ajax({
							url: "edit_slot.php",
							type: "POST",
							data: {q:'add',placecode:pla,total_app:total_app,time_app:time_app,day:day,day_name:day_name,placecode_main:pla,place_name:pla_name},
							error: function (request, status, error) {
								bootbox.alert(request);
								//return false;
							},
							success:function(data){
								//console.log(data);
							}
						});

					}
				}else if($("#opd_exam_open").val()=='2'){
					var opd_exam_day = [];
					var opd_exam_day_name = ['','','วันจันทร์','วันอังคาร','วันพุธ','วันพฤหัสฯ','วันศุกร์'];
					$.each($("input[name='opd_exam_day']:checked"), function(){
						opd_exam_day.push($(this).val());
						//console.log(opd_exam_day);
					});			

					//for (i = 0; i < opd_exam_day.length; i++) {
					$.each(opd_exam_day,function(index,value){
						//console.log(value);
						//var day=opd_exam_day[value];
						var day=value;
						var day_name=opd_exam_day_name[value];
						var time_app=$("#day_"+day+"_time").val();
						var total_app=$("#day_"+day+"_total").val();
						//console.log(day_name);
						//return false;
						$.ajax({
							url: "edit_slot.php",
							type: "POST",
							//data: {q:'add',placecode:pla,total_app:total_app,time_app:time_app,day:day},
							data: {q:'add',placecode:pla,total_app:total_app,time_app:time_app,day:day,day_name:day_name,placecode_main:pla,place_name:pla_name},
							error: function (request, status, error) {
								bootbox.alert(request.responseText);
								return false;
							},
							success:function(data){
								//console.log(data);
							}
						});
					});
				}

			}
		});

		bootbox.alert('บันทึกเรียบร้อยแล้ว');
		$("#modal_slot").modal('hide');

	});

	$("#tbl_holiday_doctor").on('click-row.bs.table', function (e, row, $element,col) {
	//	console.log(row);
		var pla=$("#pla").val();
		if(col=='del'){
			$.ajax({
				url: "save_holiday.php",
				type: "POST",
				data: {q:'del',bid:row.bid},
				error: function (request, status, error) {
					bootbox.alert(request.responseText);
					return false;
				},
				success:function(data){
					//console.log(data);
					$("#tbl_holiday_doctor").bootstrapTable('refresh',{url : "get_holiday_doctor.php?pla="+pla});
					bootbox.alert(data);
				}
			});
		}
	});

	$("#btn_holiday").on('click',function(){
		var pla=$("#slot_placecode").val();
		var pla_name=$("#slot_place_name").val();
		$.ajax({
			url: "save_holiday.php",
			type: "POST",
			data: {q:'add',placecode:pla,placename:pla_name,startdate:$("#startdate").val(),enddate:$("#enddate").val()},
			error: function (request, status, error) {
				bootbox.alert(request.responseText);
				return false;
			},
			success:function(data){
			//	console.log(data);
				$("#startdate,#enddate").val('');
				$("#tbl_holiday_doctor").bootstrapTable('refresh',{url : "get_holiday_doctor.php?pla="+pla});
				bootbox.alert(data);
			}
		});
	})

	$('#modal_slot').on('hidden.bs.modal', function (e) {
		reset_slot();
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		if(e.target.id=='nav-moph-refer-tab'){
			// เรียก moph_refer เมื่อคลิกที่ tab
			var referout_no = $("#referout_no").val();
			if(referout_no){
				moph_refer(referout_no);
			}
		}
	});

	$("#btn_moph-refer").on('click',function(){
		if($("#refer-file-url").text()==""){
		}else{
			window.open($("#refer-file-url").text(), '_blank');			
		}
	});
	
	function reset_slot(){
		$("#setup_time_app").val('');
		$("#setup_total_app").val('');
		$("#opd_exam_open").val("1");
		$("#div_opd_exam_day").attr('hidden',true);
		$("#div_opd_exam_all").attr('hidden',false);

		$('#day_2,#day_3,#day_4,#day_5,#day_6').prop("checked",false);
		$("#day_2_time,#day_2_total,#day_3_time,#day_3_total,#day_4_time,#day_4_total,#day_5_time,#day_5_total,#day_6_time,#day_6_total").val('');
		$("#day_2_time,#day_2_total,#day_3_time,#day_3_total,#day_4_time,#day_4_total,#day_5_time,#day_5_total,#day_6_time,#day_6_total").attr('disabled',true);
	};

	function send_sms(hn,mobile){
		//console.log(mobile);
		$.ajax({
			url: 'http://172.16.99.200/otp/otp_check.php',
			type: "POST",
			//dataType: "json",
			data : {hn:hn,getlink:hn,mobile:mobile,'ac':'notify_regis_patients',app:'Regis Online'},
			cache: false,
			error:function(err){
				console.log(err);
				return false;
			},
			success: function(data) {
				//console.log(data);
				//$("#div_otp").attr('hidden',false);
				if(data!="1"){
					bootbox.alert("ไม่สามารถส่งข้อความได้");
					return false;
				}
				//console.log('sms='+data);
				var cid=$("#cid").val();
				$.ajax({
					url: 'update_patients.php',
					type: "POST",
					//dataType: "json",
					data : {hn:hn,q:'sms'},
					cache: false,
					error:function(err){
						console.log(err);
					},
					success: function(data) {
						//console.log('update='+data);
						if(data!="1"){
							bootbox.alert("ไม่สามารถปรับปรุงสถานะได้");
							return false;
						}
						$('#tbl_ptlist').bootstrapTable('refresh',{url : "get_appoint.php?q=new&status=0"});
						//bootbox.alert("ทำงานเรียบร้อยแล้ว");
					}
				});
			}
		});
	}

	// update HN จาก HIS, ตรวจสอบการลงนัดใน HIS, ตรวจสอบการลงรับ Refer ใน HIS, ตรวจสอบการ VISIT บัตรใน HIS
	function update_appoint(){
		//console.log('update_appoint');
				
		$.ajax({
			url: "check_pmk.php",
			type: "POST",				
			error: function (error) {
				console.log(error);
			},
			success:function(data){					
				//console.log(data);
			}
		});	
		
	}

	function showptservice(referout_no){
		//console.log('get service thairefer');
		// ดึงข้อมูลส่งต่อ จากรพ.ต้นทาง
		$.ajax({
				crossOrigin: true,
				//url: "get_thairefer.php?q=profile&referout_no="+referout_no,
				url : "http://172.16.99.200/refer/thairefer/get_thairefer_rh12.php",
				type: "GET",
				data: {q:'profile',referout_no:referout_no},
				dataType: "json",
				beforeSend : function() {
					$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
				},
				 error: function (request, status, error) {
					console.log(error);
				},
				success:function(data){
					//console.log(data.length);
					if(data.length==0){
						moph_refer(referout_no);
						return false;
					}else{
						$("#referout_no").val(referout_no);
						$("#expiredate").val(data[0].expiredate);
						$("#cause_referout_name").val(data[0].cause_referout_name);
						$("#doctor_name").val(data[0].doctor_name);
						$("#cc").val(data[0].cc);
						$("#diag").val(data[0].memoDiag);
						$("#t").val(data[0].t);
						$("#pr").val(data[0].p);
						$("#rr").val(data[0].r);
						$("#bp").val(data[0].bp);
						$("#drugallergy").val(data[0].drugallergy);
						$("#referouttime").val(data[0].refertime);
						$("#referoutdate").val(data[0].referdate);
						$("#hcode").val(data[0].hospdesc);
						$("#refer-file-url").text('')
					}
					//$('#tbl_diag').bootstrapTable('refresh',{url : "http://172.16.99.200/refer/thairefer/get_thairefer_rh12.php?q=diag&referout_no="+referout_no});
					//$('#tbl_drug').bootstrapTable('refresh',{url : "http://172.16.99.200/refer/thairefer/get_thairefer_rh12.php?q=drug&referout_no="+referout_no});
					
				}
			});

			// ดึง diag จากรพ.ต้นทาง
			$.ajax({
				crossOrigin: true,
				//url: "get_thairefer.php?q=profile&referout_no="+referout_no,
				url : "http://172.16.99.200/refer/thairefer/get_thairefer_rh12.php",
				type: "GET",
				data: {q:'diag',referout_no:referout_no},
				dataType: "json",
				beforeSend : function() {
					$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
				},
				 error: function (request, status, error) {
					console.log(error);
				},
				success:function(data){
					$('#tbl_diag').bootstrapTable('load', data);
				}
			});
			
			// ดึงยาจาก รพ.ต้นทาง
			$.ajax({
				crossOrigin: true,
				//url: "get_thairefer.php?q=profile&referout_no="+referout_no,
				url : "http://172.16.99.200/refer/thairefer/get_thairefer_rh12.php",
				type: "GET",
				data: {q:'drug',referout_no:referout_no},
				dataType: "json",
				beforeSend : function() {
					$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
				},
				 error: function (request, status, error) {
					console.log(error);
				},
				success:function(data){
					$('#tbl_drug').bootstrapTable('load', data);
				}
			});
   
	}
	
	// แสดงข้อมูลคนไข้
	function showptdetail(id,cid,referout_no){		
		if(id!=null){ // ดึงข้อมูลทั่วไปของคนไข้ กรณีทำบัตรใหม่ ดึงจากการบันทึกเพิ่มเติม
			$.ajax({
				url: "get_patients.php",
				type: "POST",
				dataType: "json",
				data: {id:id},
				beforeSend : function() {
					$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
				},
				error: function (request, status, error) {
					console.log(request.responseText);
				},
				success:function(data){
					//console.log(data);
					$("#modal_wait").modal("hide");
					$("#hn").val(data[0].hn);
					$("#cid").val(data[0].cid);
					$("#prename").val(data[0].prename);
					$('#ptname').val(data[0].ptname);
					$('#lname').val(data[0].lname);
					$('#sex').val(data[0].sex);
					$('#dob').val(data[0].birthday);
					$("#blood").selectpicker('val',data[0].blood);
					$("#mstatus").selectpicker('val',data[0].mstatus);
					$("#rel").selectpicker('val',data[0].rel);
					$("#eth").selectpicker('val',data[0].eth);
					$("#native").selectpicker('val',data[0].native);
					$("#edu").selectpicker('val',data[0].edu);
					$("#prov").selectpicker('val',data[0].prov);
					$("#passport").val(data[0].passport);
					
					amp(data[0].prov,data[0].amp);
					tambon(data[0].amp,data[0].tambon);

					$("#zip").val(data[0].zip);
					$('#home').val(data[0].home);
					$("#road").val(data[0].road);
					$('#moo').val(data[0].moo);
					$("#soi").val(data[0].soi);
					$('#prof').selectpicker('val',data[0].prof);
					$("#father").val(data[0].father);
					$("#father_lname").val(data[0].father_lname);
					$("#mother").val(data[0].mother);
					$("#mother_lname").val(data[0].mother_lname);
					$("#wifename").val(data[0].wifename);
					$("#wife_lname").val(data[0].wife_lname);
					$('#tel').val(data[0].tel);	
					$('#tel_connect').val(data[0].tel_connect);	
					$("#who_contact").val(data[0].who_contact);
					$('#who').val(data[0].who);
					$("#who_lname").val(data[0].who_lname);	
					$("#pt_tel").val(data[0].tel);

					$("#pic_cid").html(data[1].pic_cid);
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
				//console.log('data'+data);
				if(data[0]!=null){
					$("#hn").val(data[0][0]);
					$("#cid").val(data[0][12]);
					$("#prename").val(data[0]['PRENAME']);
					$('#ptname').val(data[0]['NAME']);
					$('#lname').val(data[0]['SURNAME']);
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
					$('#tel_connect').val(data[0]['WHO_PLACE']);	
					$("#who_contact").val(data[0]['RELATION']);
					$('#who').val(data[0]['WHO']);	

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

	function moph_refer(refer_id){
		$.ajax({
				//crossOrigin: true,
				//url: "get_thairefer.php?q=profile&referout_no="+referout_no,
				url : "get_moph_refer.php",
				type: "POST",
				cache: false,
				data: {refer_id:refer_id},
				dataType: "json",
				beforeSend : function() {
					//$('#modal_wait').modal({backdrop: 'static', keyboard: false}) ;
				},
				 error: function (err) {
					console.log(err);
				},
				success:function(data){
					//console.log(data.data.refer_data);
					//$("#referout_no").val(referout_no);
					$("#expiredate").val(data.data.refer_data.refer_expire_date);
					$("#cause_referout_name").val(data.data.refer_data.request_type_name);
					$("#doctor_name").val(data.data.refer_data.doctor.firstname_th);
					$("#cc").val(data.data.refer_data.record_illness_present);
					$("#diag").val(data.data.refer_data.initial_diagnosis_free_text);
					// โหลด vital signs จาก MOPH Refer
					if(data.data.refer_data.vital_sign){
						var vitalSign = data.data.refer_data.vital_sign;
						// แยก vital signs (format: "140/70 mmHg, HR: 100")
						$("#bp").val(vitalSign.match(/\d+\/\d+/)?.[0] || '');
						$("#pr").val(vitalSign.match(/HR:\s*(\d+)/)?.[1] || '');
						$("#t").val('');
						$("#rr").val('');
					}else{
						$("#t").val('');
						$("#pr").val('');
						$("#rr").val('');
						$("#bp").val('');
					}
					// แปลงข้อมูลการแพ้ยาจาก MOPH Refer ให้อ่านได้
					var drugAllergyText = "";
					if(data.data.refer_data.medication_allergy_history && Array.isArray(data.data.refer_data.medication_allergy_history)){
						data.data.refer_data.medication_allergy_history.forEach(function(item, index){
							if(typeof item === 'object' && item !== null){
								// ถ้าเป็น object ให้แสดงข้อมูลที่สำคัญ
								var allergyInfo = [];
								if(item.drug_name) allergyInfo.push("ยา: " + item.drug_name);
								if(item.symptom) allergyInfo.push("อาการ: " + item.symptom);
								if(item.severity) allergyInfo.push("ระดับ: " + item.severity);

								// เพิ่มการตรวจสอบ properties อื่นๆ ที่อาจมี
								if(item.name && !item.drug_name) allergyInfo.push("ยา: " + item.name);
								if(item.reaction && !item.symptom) allergyInfo.push("อาการ: " + item.reaction);

								// ถ้าไม่มี property ใดๆ เลย ให้พยายาม stringify object
								if(allergyInfo.length === 0){
									try{
										allergyInfo.push(JSON.stringify(item));
									}catch(e){
										allergyInfo.push("ข้อมูลการแพ้ยาไม่สามารถแสดงได้");
									}
								}

								// เพิ่มข้อความเฉพาะเมื่อมีข้อมูล
								if(allergyInfo.length > 0){
									if(drugAllergyText !== "") drugAllergyText += "\n";
									drugAllergyText += allergyInfo.join(", ");
								}
							}else if(typeof item === 'string'){
								if(drugAllergyText !== "") drugAllergyText += "\n";
								drugAllergyText += item;
							}
						});
					}
					// ถ้าไม่มีข้อมูลหรือข้อมูลไม่ชัดเจน ให้ดูจาก record_illness_past
					if(drugAllergyText === "" || drugAllergyText === "[object Object]" || drugAllergyText.includes("[object Object]")){
						if(data.data.refer_data.record_illness_past){
							drugAllergyText = data.data.refer_data.record_illness_past;
						}
					}
					$("#drugallergy").val(drugAllergyText);
					$("#referouttime").val(data.data.refer_data.refer_date);
					$("#referoutdate").val(data.data.refer_data.refer_date);
					$("#hcode").val(data.data.refer_data.hospital_origin_name);
					$("#refer-file-url").text(data.data.refer_data.refer_file_url);

					// โหลดข้อมูล diagnosis เข้าตาราง tbl_diag
					var diagData = [];
					if(data.data.refer_data.initial_diagnosis && Array.isArray(data.data.refer_data.initial_diagnosis)){
						// ถ้ามีข้อมูล ICD10 แบบ array
						data.data.refer_data.initial_diagnosis.forEach(function(item){
							diagData.push({
								icdcode: item.icd10_code || item.code || '',
								icdname: item.icd10_name || item.name || item.description || '',
								type: item.diagtype || item.type || 'Principal'
							});
						});
					}else if(data.data.refer_data.initial_diagnosis && typeof data.data.refer_data.initial_diagnosis === 'string'){
						// ถ้ามีข้อมูล ICD10 แบบ string (format: "M6268: Muscle strain Other" หรือหลาย diagnosis คั่นด้วย comma)
						var diagStr = data.data.refer_data.initial_diagnosis;

						// แยก diagnosis ด้วย regex pattern ที่หา CODE: Description
						// Pattern: หา text ที่ขึ้นต้นด้วย CODE (ตัวอักษรและตัวเลข) ตามด้วย : และ description
						var diagPattern = /([A-Z0-9]+):\s*([^,]+(?::[^,]*)?)/g;
						var matches;
						var foundDiag = false;
						var diagIndex = 0;

						while ((matches = diagPattern.exec(diagStr)) !== null) {
							foundDiag = true;
							diagData.push({
								icdcode: matches[1].trim(),  // CODE part
								icdname: matches[2].trim(),  // Description part
								type: diagIndex === 0 ? 'Principal' : 'Other'  // รายการแรก = Principal, ที่เหลือ = Other
							});
							diagIndex++;
						}

						// ถ้าไม่พบ pattern ให้ใช้วิธีเดิม (แยกด้วย : ครั้งเดียว)
						if(!foundDiag && diagStr.indexOf(':') > -1){
							var parts = diagStr.split(':');
							diagData.push({
								icdcode: parts[0].trim(),
								icdname: parts.slice(1).join(':').trim(),
								type: 'Principal'
							});
						}
					}else if(data.data.refer_data.initial_diagnosis_free_text){
						// ถ้ามีแค่ free text ให้แสดงแบบ text
						diagData.push({
							icdcode: '',
							icdname: data.data.refer_data.initial_diagnosis_free_text,
							type: 'Free Text'
						});
					}
					$('#tbl_diag').bootstrapTable('load', diagData);

					// โหลดข้อมูล drug/procedure เข้าตาราง tbl_drug
					var drugData = [];
					if(data.data.refer_data.procedure && Array.isArray(data.data.refer_data.procedure)){
						data.data.refer_data.procedure.forEach(function(item){
							drugData.push({
								datedrug: data.data.refer_data.refer_date || '',
								drugname: item.procedure_name || item.name || '',
								druguse: item.description || ''
							});
						});
					}
					if(data.data.refer_data.medication_history){
						// เพิ่มข้อมูลประวัติการใช้ยา
						drugData.push({
							datedrug: data.data.refer_data.refer_date || '',
							drugname: 'ประวัติการใช้ยา',
							druguse: data.data.refer_data.medication_history
						});
					}
					if(data.data.refer_data.treatment_provided){
						// เพิ่มข้อมูลยาที่ให้ไป
						drugData.push({
							datedrug: data.data.refer_data.refer_date || '',
							drugname: 'ยาที่ให้ไป',
							druguse: data.data.refer_data.treatment_provided
						});
					}
					$('#tbl_drug').bootstrapTable('load', drugData);

					// แสดงปุ่มเปิดใบ Refer
					if(data.data.refer_data.refer_file_url){
						$("#moph-refer-content").hide();
						$("#moph-refer-button").show();
					}else{
						$("#moph-refer-button").hide();
						$("#moph-refer-content").html('<i class="fas fa-exclamation-triangle fa-5x text-danger mb-3"></i><p class="text-danger">ไม่พบไฟล์ใบ Refer</p>').show();
					}
				}
			});
	}

	function pushtext(userid,message,msg_type,link,app){	
		return $.ajax({
			url: "http://192.168.4.3/webapp/line/send_message.php",
			type: "POST",
			async: false,
			data: {clientid:userid,message:message,msg_type:msg_type,link:link,app:app},			
			success:function(data){
				//console.log(data);	
			}
		}).responseText;
		
	}

	function line_log(userid,message,app){
		return $.ajax({
			url: "http://192.168.4.3/webapp/line/line_log.php",
			type: "POST",
			async: false,
			data: {userid:userid,message:message,app:app},
			error : function(err){
				bootbox.alert(err);
			},
			success:function(data){}
		}).responseText;
	}

	function nhso_check(cid){
		var  pttype;
		$.ajax({
			url: "http://192.168.4.3/webapp/nhso-check/api_chk_nhso.php",
			type: "POST",
			dataType: "json",
			async: false,
			data: {cid:cid},
			error : function(err){
				bootbox.alert(err);
			},
			success:function(data){
				pttype=data;
			}
		});
		return pttype[0];
	}

	function auto_pushtext(){
		//console.log("auto_line");
		var message="";
		$.ajax({
			url: 'get_chk_hn_send_line.php',
			type: "POST",
			async: false,
			dataType: "json",
			//data : {},
			cache: false,	
			error : function(err){
				console.log(err);
			},
			success: function(data) {
				//console.log('send sms='+data);
				var datal=data.length;
				//console.log(datal);
				for (i = 0; i < datal; i++) {
					//if(data[i].userid!=""){
						//console.log('userid='+data[i].userid);
						if(data[i].pttype=="new"){								
							// ส่ง line กรณีทำบัตร online
							message='ชื่อ สกุล : '+data[i].prename+data[i].ptname+' '+data[i].lname+'\nHN : '+data[i].hn+'\n';
							var userid=data[i].userid;
							var template="template";
							var url="update_patients.php";
							var pttype="Register Online";
							var data={hn:data[i].hn,q:'line'};
							var result=pushtext(userid,message,template,'https://liff.line.me/1654185694-BrZbrl1G',pttype);		// function ส่ง line			

						}else if(data[i].pttype=='refer'){						
							//if(data[i].userid!=null){
								//console.log('id='+data[i].referout_no);
								message='เรียน '+data[i].prename+' คุณมีนัดกับโรงพยาบาลหาดใหญ่\nวันที่ : '+data[i].date_app + ' เวลา '+data[i].time_app+'น.\nห้องตรวจ : '+data[i].placename+'\n** นี่เป็นข้อความอัตโนมัติไม่สามารถตอบกลับได้';
								var userid=data[i].userid;
								var template="text";
								var url="update_appoint_refer.php";
								var pttype="Refer Online";
								var data={referout_no:data[i].referout_no};
								//console.log(userid);
								var result=pushtext(userid,message,template,'',pttype);		// function ส่ง line			

							//}
					//	}
						}else if(data[i].userid==""){
							if(data[i].pttype=='newrefer'){								
								//console.log('send sms');
								//send_sms(data[i].hn,data[i].tel);
								//console.log('send sms');
								return false;
							}
						}
						
					//console.log('text:'+result);
					//return false;
					// update status ใน patients หรือใน appoint
					// เช็คว่าส่ง LINE สำเร็จ: ถ้า result เป็น "1" หรือมี "sentMessages" (response จาก LINE API)
					var isSuccess = (result == "1") || (result && result.indexOf('"sentMessages"') > -1);
					if(isSuccess){
						//console.log('aaa');
						$.ajax({
							url: url,
							type: "POST",
							async: false,
							dataType: "json",
							data : data,
							cache: false,	
							error : function(err){
								console.log(err);
							},
							success: function(data) {
								//console.log(data);
								if(data!="1"){
									bootbox.alert('Error Updata Patients');
								}
							}
						});							
					}else{
						bootbox.alert('Error Send LINE: '+result);
					}					
				}

			}
		});
	}
	
	function pushtext_problem(){
		var message="";
		$.ajax({
			url: 'get_problem.php',
			type: "POST",
			async: false,
			dataType: "json",
			cache: false,	
			error : function(err){
				console.log(err);
			},
			success: function(data) {
				//console.log(data);
				for (i=0;i<data.length ;i++ ){
					var message='แจ้งปัญหาระบบนัด Refer\nวันที่ : '+data[i].date_created+'\n'+data[i].hospname+' : '+data[i].details+'\nhttps://www.hatyaihospital.go.th/refer/index_chat.php?hospcode='+data[i].hospcode;
					var msg_type="text";
					var link="";
					var app="Problem Refer";
					//var label="อ่าน";
					var result=pushtext('Ud62bd5b94b25b1cac6730f0a396d21dc',message,msg_type,link,app);
					//console.log(result);
					if(result=='1'){
						$.ajax({
							url: 'update_problem.php?id='+data[i].id,
							type: "POST",
							async: false,
							dataType: "json",
							cache: false,	
							error : function(err){
								console.log(err);
							},
							success: function(data) {
							}
						});
					}
				}
			}
		});
	}

	function reset_form(){
		$("#hn").val('');
		$("#cid").val('');
		$('#ptname').val('');
		$('#prename').val('');
		$('#lname').val('');
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
		$("#who_contact").val('');
		$("#who").val('');
		$('#tel_connect').val('');	
		$("#pic_cid").html('');
			
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
		$("#expiredate").val('');
		$("#drugallergy").val('');
		$("#refer-file-url").text('')
	}
	
	$("#showapp").on('click',function(){
		
	});

	$("#pla-showapp").on('change',function(){
		var pla=$("#pla-showapp").val();
		$('#calendar').fullCalendar( 'destroy' );
		meeting('show',pla);
	});

	function meeting(status,pla){
		//console.log(pla);
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
				//console.log(pla);
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
		//console.log(ptname+' '+referout_no+' '+placename+ ' '+date_app);
		
		if(status=='N'){
			bootbox.alert('<i class="fa fa-ban text-danger fa-4x"></i> ไม่สามารถนัดได้ เนื่องจากนัดเต็มจำนวนแล้ว !!!');
			return false;
		}
		
		$("#date_app").val(date_app);
		
		$("#div_body").html('<ul class="list-inline"><li class="list-inline-item h4">ชื่อ สกุล : </li> <li class="list-inline-item text-primary h4">'+ptname+'</li><br><li class="list-inline-item h4">เลขที่ใบ Refer : </li> <li class="list-inline-item text-primary h4">'+referout_no+'</li><br><li class="list-inline-item h4">นัดตรวจแผนก : </li> <li class="list-inline-item text-primary h4">'+placename+'</li><br><li class="list-inline-item h4">นัดตรวจวันที่ : </li> <li class="list-inline-item text-primary h4">'+date_app+'</li></ul>');
		
		$('#modal_appoint').modal({backdrop: 'static', keyboard: false});
		
		//console.log(date_app+'---'+placecode);
	}


	// ส่วนของรายงาน
	function refer_status(report_date){
		//console.log(report_date);
		$.ajax({
			url: 'get_report_status.php',
			type: "POST",
			data : {report_date:report_date},
			async: false,
			dataType: "json",
			cache: false,	
			error : function(err){
				console.log(err);
			},
			success: function(data) {
				//console.log(data);
				$("#appoint_pmk").text(data[0].appoint_pmk);
				$("#not_appoint_pmk").text(data[0].not_appoint_pmk);

				$("#refer_pmk").text(data[0].refer_pmk);
				$("#not_refer_pmk").text(data[0].not_refer_pmk);

				$("#visit_pmk").text(data[0].visit_pmk);
				$("#not_visit_pmk").text(data[0].not_visit_pmk);
				$("#refer_total").text(data[0].total);

			}
		});
	}
	
	function total(){
		var options = {
			chart: {
				renderTo: 'total_hosp',
				height:350,
				type: 'column',
                //type: 'pie',
                /*backgroundColor: {
                    linearGradient: { x1: 0, x2: 0, y1: 0, y2: 1 },
                    stops: [
                        [0, '#ffffcc'],
                        [1, '#ccff66']
                    ]
                },*/
			},
			title: {
			  text: '',
			},
			subtitle: {
				//text: 'ข้อมูลตั้งแต่วันที่ 01-10-2016'
			},
			yAxis: {
				title: {
					text: 'จำนวน (ครั้ง)'
				},
			},
			xAxis: {
                type: "category",
				labels: {
					style: {
						fontSize: '12px' ,
						fontWeight:'normal',
					},
				},
                //min: 0,
                //max: 9,
                scrollbar: {
                    enabled: true
                },
                tickLength: 0
				//crosshair: true
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						style: {
							fontSize: '12px' ,
							//fontWeight:'normal',
						},
					},
					
				}
			},
			tooltip: {
				formatter:function(){
                    return this.key + ' : ' + this.y;
                }
			},
			credits: {
				enabled: false
			},
			series: [{showInLegend: true,}]
		};

		$.getJSON('get_report_total.php?q=hosp', function(list) {
			//console.log(list);
			options.series[0].name='ทั้งหมด = '+list[0]+ ' ครั้ง';
            options.series[0].data=list[1];
			var chart = new Highcharts.Chart(options);
		});
	}

	function total_place(report_date){
		var options = {
			chart: {
				renderTo: 'total_place',
				height:350,			
				type: 'column',				
			},
			title: {
				text: 'จำนวนการ Refer รายแผนก'
			},
			subtitle: {
			   // text: 'Source: WorldClimate.com'
			},
			
			xAxis: {
				categories: [],	
					labels: {
					style: {
						fontSize: '12px' ,
						fontWeight:'normal',
					},
					useHTML: true,
					
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'จำนวน(ครั้ง)'
				},
				
			},
			tooltip: {
				//headerFormat: '<b>{point.x}</b><br/>',
				//pointFormat: '{series.name}: {point.y}'
				//pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
			},
			plotOptions: {
				column: {
					stacking: 'normal',
					dataLabels: {
						enabled: true,
						style: {
							fontSize: '12px' ,
							fontWeight:'normal',
						},
					},
					
				}
			},
			credits: {
				enabled: false
			},
			series: [{}],			
		};

		$.getJSON('get_report_total.php?q=place', function(list) {
			//console.log(list);
			options.series[0].name='ทั้งหมด = '+list[0]+ ' ครั้ง';
            options.series[0].data=list[1];
			var chart = new Highcharts.Chart(options);
		});
	}

	function total_m(){
		var options = {
			chart: {
				renderTo: 'total_m',
				height:350,
				//type: column',
                type: 'spline',
			},
			title: {
			  text: 'จำนวน นัด ผู้ป่วย Refer รายเดือน ',
			},
			subtitle: {
				//text: 'ข้อมูลตั้งแต่วันที่ 01-10-2016'
			},
			yAxis: {
				title: {
					text: 'จำนวน (ครั้ง)'
				},
			},
			xAxis: {
                type: "category",
				labels: {
					style: {
						fontSize: '12px' ,
						fontWeight:'normal',
					},
				},
                //min: 0,
                //max: 9,
                scrollbar: {
                    enabled: true
                },
                tickLength: 0
				//crosshair: true
			},
			plotOptions: {
				//column: {
                spline : {
					dataLabels: {
						enabled: true,
						//format : "{point.y:.2f}"
					}
				}
			},
			tooltip: {
				formatter:function(){
                    return this.key + ' : ' + this.y;
                }
			},
			credits: {
				enabled: false
			},
			series: [{showInLegend: true,}]
		};

		$.getJSON('get_report_total.php?q=m', function(list) {
			//console.log(list);
			options.series[0].name='ทั้งหมด = '+list[0]+ ' ครั้ง';
            options.series[0].data=list[1];
			var chart = new Highcharts.Chart(options);
		});
	}

	function total_d(){
		var options = {
			chart: {
				renderTo: 'total_d',
				height:350,
				//type: column',
                type: 'spline',
			},
			title: {
			  text: 'จำนวน นัด ผู้ป่วย Refer รายวัน ประจำเดือน '+datetime.toLocaleString("th-TH",dateformat),
			},
			subtitle: {
				//text: 'ข้อมูลตั้งแต่วันที่ 01-10-2016'
			},
			yAxis: {
				title: {
					text: 'จำนวน (ครั้ง)'
				},
			},
			xAxis: {
                type: "category",
				labels: {
					style: {
						fontSize: '12px' ,
						fontWeight:'normal',
					},
				},
                //min: 0,
                //max: 9,
                scrollbar: {
                    enabled: true
                },
                tickLength: 0
				//crosshair: true
			},
			plotOptions: {
				//column: {
                spline : {
					dataLabels: {
						enabled: true,
						//format : "{point.y:.2f}"
					}
				}
			},
			tooltip: {
				formatter:function(){
                    return this.key + ' : ' + this.y;
                }
			},
			credits: {
				enabled: false
			},
			series: [{showInLegend: true,}]
		};

		$.getJSON('get_report_total.php?q=d', function(list) {
			//console.log(list[1]);
			options.series[0].name='ทั้งหมด = '+list[0]+ ' ครั้ง';
            options.series[0].data=list[1];
			var chart = new Highcharts.Chart(options);
		});
	}

	function hosp_refer(report_date){
	
		var options = {
			chart: {
				renderTo: 'hosp_refer',
				height:350,
				type: 'column',
                //type: 'spline',
                
			},
			title: {
			  text: 'จำนวนผู้ป่วยนัด Refer ที่มาตรวจประจำวันที่ '+report_date,
			},
			subtitle: {
				//text: 'ข้อมูลตั้งแต่วันที่ 01-10-2016'
			},
			yAxis: {
				title: {
					text: 'จำนวน (ครั้ง)'
				},
			},
			xAxis: {
					categories: [],	
                type: "category",
				labels: {
					style: {
						fontSize: '12px' ,
						fontWeight:'normal',
					},
				},
                //min: 0,
                //max: 9,
                scrollbar: {
                    enabled: true
                },
                tickLength: 0
				//crosshair: true
			},
			plotOptions: {
				column: {
                //spline : {
					dataLabels: {
						enabled: true,
						format : "{point.y:.0f}"
					}
				}
			},
			tooltip: {
				formatter:function(){
                    return this.key + ' : ' + this.y;
                }
			},
			credits: {
				enabled: false
			},
			series: [
				{
					showInLegend: true,
					name:'นัด Online',
					color:'#339900',
					data:[]
				},
				{
					name:'มาตรวจ',
					data:[],
					color:'#6699ff',
				}
						]
		};

		$.getJSON('get_report_hosp.php?q=visit&report_date='+report_date, function(list) {
			//console.log(list[1].app);
			//options.series[0].name='ทั้งหมด = '+list[0]+ ' ราย';
			options.xAxis.categories = list[2];
            options.series[0].data=list[1].app;
			options.series[1].data=list[1].visit;
			var chart = new Highcharts.Chart(options);
		});
	}

	function chart_app_place(report_date){
	
		var options = {
			chart: {
				renderTo: 'chart_app_place',
				height:350,
				type: 'column',
                //type: 'spline',
                
			},
			title: {
			  text: 'จำนวนผู้ป่วย Refer Online ลงนัดใน PMK ประจำวันที่ '+ report_date,
			},
			subtitle: {
				//text: 'ข้อมูลตั้งแต่วันที่ 01-10-2016'
			},
			yAxis: {
				title: {
					text: 'จำนวน (ครั้ง)'
				},
			},
			xAxis: {
					categories: [],	
                type: "category",
				labels: {
					style: {
						fontSize: '12px' ,
						fontWeight:'normal',
					},
				},
                //min: 0,
                //max: 9,
                scrollbar: {
                    enabled: true
                },
                tickLength: 0
				//crosshair: true
			},
			plotOptions: {
				column: {
                //spline : {
					dataLabels: {
						enabled: true,
						format : "{point.y:.0f}"
					}
				}
			},
			tooltip: {
				formatter:function(){
                    return this.key + ' : ' + this.y;
                }
			},
			credits: {
				enabled: false
			},
			series: [
				{
					showInLegend: true,
					name:'นัด Online',
					//color:'#3300ff',
					data:[]
				},
				{
					name:'ลงนัดใน PMK',
					data:[],
					//color:'#339900',
				}
						]
		};

		$.getJSON('get_report_place.php?report_date='+report_date, function(list) {
			//console.log(list[1].app);
			//options.series[0].name='ทั้งหมด = '+list[0]+ ' ราย';
			options.xAxis.categories = list[2];
            options.series[0].data=list[1].app;
			options.series[1].data=list[1].visit;
			var chart = new Highcharts.Chart(options);
		});
	}

	function total_percen(){		
		var options = {
			chart: {
				renderTo: 'total_percen',
				height:350,			
				type: 'solidgauge',
				
			},
			colors: ['#ff0000', '#50B432'],
			title: {
			  text: '',
			},
			pane: {
				center: ['50%', '85%'],
				size: '140%',
				startAngle: -90,
				endAngle: 90,
				background: {
					backgroundColor:
						Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
					innerRadius: '60%',
					outerRadius: '100%',
					shape: 'arc'
				}
			},
			yAxis: {
				min: 0,
				max: 100,
				title: {
					text: '%'
				},
				stops: [
					[0.1, '#ff0000'], // green
					[0.5, '#DDDF0D'], // yellow
					[0.9, '#33cc00'] // red
				],
				
			},
			xAxis: {        
				//allowDecimals: false
		        type: "category"
			},
			
			tooltip: {
				formatter: function() {
					return '% การใช้งาน : <b>'+ Highcharts.numberFormat(this.y, 2, '.', ',')+'</b>';
				}
				//pointFormat: '{series.name}: <br>{point.percentage:.1f} %<br>value: '+Highcharts.numberFormat(this.y, 0, '.', ',')+'</b>',
				// pointFormat: "ปีงบ " + point.x + "{point.y:.2f}"
				//formatter: function() {
				//	return 'ปีงบ '+ this.x +' : '+ this.y;
				//}
			},
			/*
			legend: { // แสดง ชื่อ series
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle',
				borderWidth: 0
			},
			*/
			credits: {
				enabled: false
			},
			series: [{}]
		};
		
		$.getJSON('get_report_total.php?q=total', function(list) {
			//console.log(list);
			//options.series[0].name='Total = '+list[0];
			options.series[0].data= list[0];
			var chart = new Highcharts.Chart(options);		
		}); 
	}

	function hosp_app(report_date){	
		$.getJSON('get_report_hosp.php', {q: 'app',report_date:report_date}, function(data) {
			//console.log(data.length);
			Highcharts.chart('hosp_app', {
				chart: {
					plotShadow: false,
					type: 'pie',
					height:350,	
					marginBottom: 1,
					marginTop: 25,
				},
				title: {
					text: 'จำนวนผู้ป่วย Refer Online แยกรายโรงพยาบาลประจำวันที่ '+report_date
				},
				tooltip: {
					pointFormat: '<b><span style="font-size:14px">{point.y} ราย</span></b>'
				},
				accessibility: {
					point: {
						//valueSuffix: '%'
					}
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b><span style="font-size:14px">{point.name}</span></b>: <span style="font-size:14px">{point.y} ราย</span>'
						}
					}
				},
				credits: {
					enabled: false
				},
				series: [{
					name: '',
					colorByPoint: true,
					data: data[0].data
				}]
			});
		});

	}

	function totalNameFormatter(data) {
		//return data.length
		//console.log(data.length);
	}
	
</script>
