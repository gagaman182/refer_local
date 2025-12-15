<!-- Modal เพิ่มผู้ป่วยนัด-->
		<div class="modal fade " id="modal-addpt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable" style="max-width: 100%;" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">รายละเอียดผู้ป่วยนัด รอทำบัตรใหม่</h5>
						<button type="button" id="btnX_close" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<nav>
							<div class="nav nav-tabs" id="nav-tab" role="tablist">
								<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ข้อมูลทั่วไป</a>
								<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">ข้อมูลการส่งต่อ</a>
								<a class="nav-item nav-link" id="nav-fu-tab" data-toggle="tab" href="#nav-fu" role="tab" aria-controls="nav-fu" aria-selected="false">เลื่อน / ยกเลิก นัด</a>
								
							</div>
						</nav>
						<div class="tab-content" id="nav-tabContent">
							<!--- tab แสดงรายละเอียดทั่วไป --->
							<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
							<br>
								<div class="row">
									<div class="col-md-12">
										<div class="panel  panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">ข้อมูลทั่วไป</h3>											
											</div>
											<div class="panel-body">												
												<div class="row">
													<div class="col-md-9">											
														<div class="form-row">
															<div class="col-md-3 mb-1">
																<label for="hn">เลขบัตรปปช.</label>
																<input type="text" class="form-control" name="cid" id="cid" placeholder="" readonly>
																<input type="hidden" class="form-control" name="hn" id="hn" placeholder="" readonly>
															</div>		
															<div class="col-md-3 mb-1">
																<label for="prename">คำนำหน้า</label>
																<input type="text" required class="form-control" name="prename" id="prename" placeholder="">
															</div>	
															<div class="col-md-3 mb-1">
																<label for="ptname">ชื่อ</label>
																<input type="text" required class="form-control" name="ptname" id="ptname" placeholder="">
															</div>	
															<div class="col-md-3 mb-1">
																<label for="lname">นามสกุล</label>
																<input type="text" required class="form-control" name="lname" id="lname" placeholder="">
															</div>
														</div>
														<div class="form-row">
															<div class="col-md-3 mb-1">
																<label for="sex">เพศ</label>
																<select  required class="form-control" name="sex" id="sex">
																	<option></option>
																	<option value="M">ชาย</option>
																	<option value="F">หญิง</option>
																</select>
															</div>										
															<div class="col-md-3 mb-1">
																<label for="dob">วันเกิด</label>
																  <input type="text" class="form-control" id="dob" name="dob">
													
																<!-- <input  required  type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="DD MM YYYY"  name="dob" id="dob" class="form-control"> -->
															</div>
															<div class="col-md-3 mb-1">
																<label for="blood">กรุ๊ปเลือด</label>
																<select class="selectpicker form-control" name="blood" id="blood"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>	
															<div class="col-md-3 mb-1">
																<label for="mstatus">สถานะ</label>
																<select required  class="selectpicker form-control" name="mstatus" id="mstatus"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>		
														</div>
														<div class="form-row">
															<div class="col-md-4 mb-1">
																<label for="rel">ศาสนา</label>
																<select required  class="selectpicker form-control" name="rel" id="rel"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>															
															
															<div class="col-md-4 mb-1">
																<label for="eth">สัญชาติ</label>
																<select required  class="selectpicker form-control" name="eth" id="eth"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>	
															<div class="col-md-4 mb-1">
																<label for="native">เชื้อชาติ</label>
																<select required  class="selectpicker form-control" name="native" id="native"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>
														</div>
														<div class="form-row">	
															<div class="col-md-4 mb-1">
																<label for="pt_tel">เบอร์โทรศัพท์</label>
																<input type="text" class="form-control" id="pt_tel" name="pt_tel">							
															</div>	
															<div class="col-md-4 mb-1">
																<label for="edu">การศึกษา</label>
																<select  required class="selectpicker form-control" name="edu" id="edu"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>	
															<div class="col-md-4 mb-1">
																<label for="prof">อาชีพ</label>
																<select  required class="selectpicker form-control" name="prof" id="prof"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>
															</div>
														</div>
														<div class="form-row">
															<div class="col-md-4 mb-1">
																<label for="home">ที่อยู่</label>
																<input required  type="text" class="form-control" name="home" id="home" placeholder="">
															</div>
															<div class="col-md-2 mb-1">
																<label for="moo">หมู่</label>
																<input type="text" class="form-control" name="moo" id="moo" placeholder="">
															</div>
															<div class="col-md-4 mb-1">
																<label for="road">ถนน</label>
																<input type="text" class="form-control" name="road" id="road" placeholder="">
															</div>
															<div class="col-md-2 mb-1">
																<label for="soi">ซอย</label>
																<input type="text" class="form-control" name="soi" id="soi" placeholder="">
															</div>
														</div>
													
														<div class="form-row">
															<div class="col-md-3 mb-1">
																<label for="prov">จังหวัด</label>
																<select  required class="selectpicker form-control" name="prov" id="prov"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																	<option value=""></option>
																</select>								
															</div>														
															<div class="col-md-3 mb-1">
																<label for="amp">อำเภอ</label>
																<select required  class="selectpicker form-control" name="amp" id="amp"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">														
																</select>								
															</div>
															<div class="col-md-3 mb-1">
																<label for="amp1">ตำบล</label>
																<select required  class="selectpicker form-control" name="amp1" id="amp1"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">														
																</select>								
															</div>
															<div class="col-md-3 mb-1">
																<label for="zip">รหัสไปรษณีย์</label>
																<input type="text" class="form-control" name="zip" id="zip" placeholder="">
															</div>
														</div>
													
														<div class="form-row">												
															<div class="col-md-2 mb-1">
																<label for="father">ชื่อบิดา</label>
																<input type="text" class="form-control" name="father" id="father" placeholder="">
															</div>
															<div class="col-md-2 mb-1">
																<label for="father">นามสกุลบิดา</label>
																<input type="text" class="form-control" name="father_lname" id="father_lname" placeholder="">
															</div>
															<div class="col-md-2 mb-1">
																<label for="mother">ชื่อมารดา</label>
																<input type="text" class="form-control" name="mother" id="mother" placeholder="">
															</div>
															<div class="col-md-2 mb-1">
																<label for="wifename">นามสกุลมารดา</label>
																<input type="text" class="form-control" name="mother_lname" id="mother_lname" placeholder="">
															</div>	
															<div class="col-md-2 mb-1">
																<label for="wifename">ชื่อคู่สมรส</label>
																<input type="text" class="form-control" name="wifename" id="wifename" placeholder="">
															</div>	
															<div class="col-md-2 mb-1">
																<label for="wifename">นามสกุลคู่สมรส</label>
																<input type="text" class="form-control" name="wif_lname" id="wife_lname" placeholder="">
															</div>	
														</div>
													
														<div class="form-row">	
															<div class="col-md-3 mb-1">
																<label for="who">ชื่อผู้ติดต่อได้ *</label>
																<input required  type="text" class="form-control border border-danger" name="who" id="who" placeholder="">
															</div>
															<div class="col-md-3 mb-1">
																<label for="who">นามสกุลผู้ติดต่อได้ *</label>
																<input required  type="text" class="form-control border border-danger" name="who_lname" id="who_lname" placeholder="">
															</div>
															<div class="col-md-3 mb-1">
																<label for="who_contact">เกี่ยวข้องเป็น *</label>
																<input required  type="text" class="form-control border border-danger" name="who_contact" id="who_contact" placeholder="">
															</div>	
															<div class="col-md-3 mb-1">
																<label for="tel_connect">เบอร์โทรผู้ติดต่อได้</label>
																<input type="number" class="form-control" name="tel_connect" id="tel_connect" placeholder="ตัวอย่าง 0123456789">
															</div>	
														</div>
													
														<div class="form-row">	
															<div class="col-md-6 mb-1">
																<label for="who">สิทธิหลัก</label>
																<input required  type="text" id="pttype" name="pttype" class="form-control">
															</div>
															<div class="col-md-2 mb-1">
																<label for="who_contact">เลขที่สิทธิ</label>
																<input required  type="text" id="cardid" name="cardid" class="form-control">
															</div>
															<div class="col-md-4 mb-1">
																<label for="tel">รพ.หลัก</label>
																<input required  type="text" id="hmain" name="hmain" class="form-control">
															</div>
														</div>
													</div>
													<div class="col-md-3">	
														<div id="pic_cid"></div>
													</div>
												</div>
																					
											</div>
										</div>
										<!-- <button type="button" id="btn_regis" class="btn btn-primary">ทำบัตรเรียบร้อยแล้ว</button> -->
									</div>									
								</div>
							</div>
							<!--- tab รายละเอียดจาก thairefer --->
							<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
								<br>
								<div class="row">
									<div class="col-md-12">
										<div class="panel  panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">ข้อมูลการส่งต่อ</h3>											
											</div>
											<div class="panel-body p-1">
												<div class="form-row">	
													<div class="col-md-4 mb-1">
														<label for="hcode">ต้นทาง</label>
														<input type="text" class="form-control" name="hcode" id="hcode" placeholder="">								
													</div>
													<div class="col-md-4 mb-1">
														<label for="referoutdate">วันที่ส่งตัว</label>
														<input type="text" class="form-control" name="referoutdate" id="referoutdate" placeholder="">								
													</div>
													<div class="col-md-4 mb-1">
														<label for="referouttime">เวลา</label>
														<input type="text" class="form-control" name="referouttime" id="referouttime" placeholder="">	
													</div>													
												</div>
												<div class="form-row">	
													<div class="col-md-2 mb-1">
														<label for="referout_no">เลขที่ใบส่งตัว</label>
														<input type="text" class="form-control" name="referout_no" id="referout_no" placeholder="">								
													</div>
													<div class="col-md-2 mb-1">
														<label for="expiredate">วันหมดอายุใบส่งตัว</label>
														<input type="text" class="form-control" name="expiredate" id="expiredate" placeholder="">								
													</div>
													<div class="col-md-3 mb-1">
														<label for="cause_referout_name">เหตุผลการส่งต่อ</label>
														<input type="text" class="form-control" name="cause_referout_name" id="cause_referout_name" placeholder="">	
													</div>
													<div class="col-md-5 mb-1">
														<label for="doctor_name">แพทย์ผู้ส่ง</label>
														<input type="text" class="form-control" name="doctor_name" id="doctor_name" placeholder="">	
													</div>
												</div>
												<div class="form-row">	
													<div class="col-md-3 mb-1">
														<label for="t">T(c)</label>
														<input type="text" class="form-control" name="t" id="t" placeholder="">								
													</div>
													<div class="col-md-3 mb-1">
														<label for="pr">PR(ครั้ง/นาที)</label>
														<input type="text" class="form-control" name="pr" id="pr" placeholder="">	
													</div>
													<div class="col-md-3 mb-1">
														<label for="rr">RR(ครั้ง/นาที)</label>
														<input type="text" class="form-control" name="rr" id="rr" placeholder="">	
													</div>
													<div class="col-md-3 mb-1">
														<label for="bp">BP(mmHg)</label>
														<input type="text" class="form-control" name="bp" id="bp" placeholder="">	
													</div>
												</div>
												<div class="form-row">	
													<div class="col-md-6 mb-1">
														<label for="cc">CC \ PI \ Physical examination</label>
														 <textarea class="form-control" id="cc" name="cc" rows="7"></textarea>
													</div>
													<div class="col-md-6 mb-1">
														<label for="diag">Diagnosis จากต้นทาง</label>
														 <textarea class="form-control" id="diag" name="diag" rows="7"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">										
										<div class="panel  panel-danger">
											<div class="panel-heading">
												<h3 class="panel-title">การแพ้ยา</h3>											
											</div>
											<div class="panel-body p-1">
												<div class="col-md-12 mb-1">											
													<input type="text" class="form-control" name="drugallergy" id="drugallergy" placeholder="">								
												</div>	
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">										
										<div class="panel  panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">ผลการวินิจฉัย</h3>											
											</div>
											<div class="panel-body p-1">
												<table id="tbl_diag" class="table table-sm" data-toggle="table" data-cache="false"  data-url="" data-show-export="false" data-pagination="false" data-row-style=""  data-locale="th-th">
													<thead class="thead-light">	
														<tr>
															<th data-field="icdcode">ICD10</th>
															<th data-field="icdname">ICD10 Name</th>
															<th data-field="type">DiagType</th>
														</tr>
													</thead>													
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="panel  panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">การใช้ยา</h3>											
											</div>
											<div class="panel-body p-1">
												<table id="tbl_drug" class="table table-sm" data-toggle="table" data-cache="false" data-search="false" data-show-print="false" data-url="" data-show-export="false" data-pagination="false" data-row-style="" data-export-types="['excel']" data-locale="th-th">
													<thead class="thead-light">	
														<tr>
															<th data-field="datedrug">วันที่สั่งยา</th>
															<th data-field="drugname">ชื่อยา</th>
															<th data-field="druguse">วิธีใช้</th>
														</tr>
													</thead>													
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--- tab เลื่อนนัด --->
							<div class="tab-pane fade" id="nav-fu14" role="tabpanel" aria-labelledby="nav-fu-tab">
							<br>
								<div class="row">
									<div class="col-md-12">
										<div class="panel  panel-primary">
											<div class="panel-heading">
												<h3 class="panel-title">เลื่อน / ยกเลิก นัด</h3>										
											</div>
											<div class="panel-body">												
												<div class="form-row">	
													<div class="col-md-2 mb-1">
														<label for="dateapp_old">วันนัดเดิม</label>
														<input type="text" class="form-control" name="dateapp_old" id="dateapp_old" disabled>								
													</div>
													<div class="col-md-3 mb-1">
														<label for="fu_status">เลื่อน / ยกเลิก นัด</label>
														<select  required class="selectpicker form-control" name="fu_status" id="fu_status" data-style="btn-new" title="&nbsp;">
															<option value="0">เลื่อนนัด</option>
															<option value="1">ยกเลิกนัด</option>
														</select>
													</div>
												</div>	
												<div class="form-row">
													<button type="button" id="btn_fu" class="btn btn-primary" disabled>บันทึก</button>
													<input type="hidden" class="form-control" name="pla_edit_fu" id="pla_edit_fu" placeholder="">	
													<input type="hidden" class="form-control" name="planame_edit_fu" id="planame_edit_fu" placeholder="">	
													<input type="hidden" class="form-control" name="date_app" id="date_app" placeholder="">	
													<div id="calendar_edit"></div>
												</div>
											</div>
										</div>
									</div>									
								</div>
							</div>
							
						</div>
					</div>
					<div class="modal-footer">					
						<!-- <button type="button" id="btn_fu" class="btn btn-primary disabled">บันทึก</button>
						<button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
					</div>
				</div>
			</div>
		</div>

		<!--- modal ยืนยันการนัด ------>
		<div class="modal fade" id="modal_appoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">ยืนยันการนัด ?</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body" id="div_body">				
			  </div>
			  <input type="hidden" name="date_app" id="date_app">
			  <div class="modal-footer">
				<button type="button" class="btn btn-primary" id="btn_appoint">ยืนยัน</button>
				<button type="button" class="btn btn-secondary" id="btn_reset_appoint" data-dismiss="modal">ยกเลิก</button>
			  </div>
			</div>
		  </div>
		</div>

		<!--- modal นัดผู้ป่วย online ------>
		<div class="modal fade" id="modal_appoint_walkin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">นัดผู้ป่วย</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" id="div_body">
						<div class="row">
							<div class="col-md-12">
								<div class="panel  panel-danger">
									<div class="panel-heading">
										<h3 class="panel-title">ประวัตินัด</h3>											
									</div>
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<p class="font-weight-bold" id="ptname_appoint"></p>												
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<p class="font-weight-bold text-break" id="chif_appoint"></p>												
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table id="tbl_chk_appoint" class="table" data-toolbar="#toolbar_appoint_walkin" data-toggle="table" data-cache="false" data-url="" data-pagination="true" data-row-style="" data-locale="th-th" data-page-size="5" data-auto-refresh="true">
													<thead class="thead-light">	
														<tr>
															<th data-formatter="autonum">#</th>
															<th data-field="DATE_APP">วันที่นัด</th>
															<th data-field="APPOINT_NAME">เวลา</th>
															<th data-field="HALFPLACE">นัดแผนก</th>													
															<th data-field="DOC_NAME">แพทย์</th>													
															<th data-field="DATECREATE">วันที่บันทึกรายการ</th>													
														</tr>
													</thead>													
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="appoint_walkin_id" id="appoint_walkin_id">
					<input type="hidden" name="app_date" id="app_date">
					<input type="hidden" name="app_place" id="app_place">
					<input type="hidden" name="app_doc" id="app_doc">
					<input type="hidden" name="userid" id="userid">
					<input type="hidden" name="hn_walkin" id="hn_walkin">
					<input type="hidden" name="ptname_walkin" id="ptname_walkin">
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btn_update_appoint">บันทึก</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
					</div>
				</div>
			</div>
		</div>

		<!--- modal กำหนด slot------>
		<div class="modal fade" id="modal_slot" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">กำหนด slot และจำนวนนัด</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
			  	<div class="form-inline">
					<input type="hidden" class="form-control mb-2 mr-sm-2" id="slot_placecode" name="slot_placecode" disabled>
					<input type="text" class="form-control mb-2 mr-sm-2" id="slot_place_name" name="slot_place_name" disabled>
				</div>
			  	<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<a class="nav-item nav-link active" id="nav-slot-tab" data-toggle="tab" href="#nav-slot" role="tab" aria-controls="nav-slot" aria-selected="true">
							กำหนด slot
						</a>
						<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-holiday" role="tab" aria-controls="nav-holiday" aria-selected="false">
							กำหนดวันหยุด
						</a>
						<a class="nav-item nav-link" id="nav-message-tab" data-toggle="tab" href="#nav-message" role="tab" aria-controls="nav-message" aria-selected="false">
							ประชาสัมพันธ์
						</a>
					</div>
				</nav>
				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-slot" role="tabpanel" aria-labelledby="nav-slot-tab">
						<div class="form-inline">
							<label class="my-1 mr-2" for="opd_exam_open">เลือกวัน</label>
							<select class="custom-select my-3 mr-sm-3" id="opd_exam_open">
								<option value="1" selected>ทุกวัน</option>
								<option value="2">กำหนดวัน</option>
							</select>
						</div>
						<div id="div_opd_exam_day" hidden>
							<form class="form-inline">
								<div class="form-group">
									<div class="custom-control custom-checkbox my-3 mr-sm-3">
										<input type="checkbox" class="custom-control-input" id="day_2" name="opd_exam_day" value="2">
										<label class="custom-control-label" for="day_2">วันจันทร์ </label>
									</div>
								</div>
								<div class="form-group">
									<label for="day_2_time" class="mr-sm-2"> เวลารับ Refer : </label>
									<input type="text" class="form-control mb-2 mr-sm-2" id="day_2_time" placeholder="เช่น 10.00-11.45" name="day_2_time" disabled>
								</div>
								<div class="form-group">
									<label for="day_2_total" class="mr-sm-2"> จำนวนรับ Refer : </label>
									<input type="number" class="form-control mb-2 mr-sm-2" id="day_2_total" placeholder="เช่น 5" name="day_2_total" disabled>
								</div>
							</form>
							<form class="form-inline">
								<div class="form-group">
									<div class="custom-control custom-checkbox my-3 mr-sm-3">
										<input type="checkbox" class="custom-control-input" id="day_3" name="opd_exam_day" value="3">
										<label class="custom-control-label" for="day_3">วันอังคาร </label>
									</div>
								</div>
								<div class="form-group">
									<label for="day_3_time" class="mr-sm-2"> เวลารับ Refer : </label>
									<input type="text" class="form-control mb-2 mr-sm-2" id="day_3_time" placeholder="เช่น 10.00-11.45" name="day_3_time" disabled>
								</div>
								<div class="form-group">
									<label for="day_3_total" class="mr-sm-2"> จำนวนรับ Refer : </label>
									<input type="number" class="form-control mb-2 mr-sm-2" id="day_3_total" placeholder="เช่น 5" name="day_3_total" disabled>
								</div>
							</form>
							<form class="form-inline">
								<div class="form-group">
									<div class="custom-control custom-checkbox my-3 mr-sm-3">
										<input type="checkbox" class="custom-control-input" id="day_4" name="opd_exam_day" value="4">
										<label class="custom-control-label" for="day_4">วันพุธ </label>
									</div>
								</div>
								<div class="form-group">
									<label for="day_4_time" class="mr-sm-2"> เวลารับ Refer : </label>
									<input type="text" class="form-control mb-2 mr-sm-2" id="day_4_time" placeholder="เช่น 10.00-11.45" name="day_4_time" disabled>
								</div>
								<div class="form-group">
									<label for="day_4_total" class="mr-sm-2"> จำนวนรับ Refer : </label>
									<input type="number" class="form-control mb-2 mr-sm-2" id="day_4_total" placeholder="เช่น 5" name="day_4_total" disabled>
								</div>
							</form>
							<form class="form-inline">
								<div class="form-group">
									<div class="custom-control custom-checkbox my-3 mr-sm-3">
										<input type="checkbox" class="custom-control-input" id="day_5" name="opd_exam_day" value="5">
										<label class="custom-control-label" for="day_5">วันพฤหัสบดี </label>
									</div>
								</div>
								<div class="form-group">
									<label for="day_5_time" class="mr-sm-2"> เวลารับ Refer : </label>
									<input type="text" class="form-control mb-2 mr-sm-2" id="day_5_time" placeholder="เช่น 10.00-11.45" name="day_5_time" disabled>
								</div>
								<div class="form-group">
									<label for="day_5_total" class="mr-sm-2"> จำนวนรับ Refer : </label>
									<input type="number" class="form-control mb-2 mr-sm-2" id="day_5_total" placeholder="เช่น 5" name="day_5_total" disabled>
								</div>
							</form>
							<form class="form-inline">
								<div class="form-group">
									<div class="custom-control custom-checkbox my-3 mr-sm-3">
										<input type="checkbox" class="custom-control-input" id="day_6" name="opd_exam_day" value="6">
										<label class="custom-control-label" for="day_6">วันศุกร์ </label>
									</div>
								</div>
								<div class="form-group">
									<label for="day_6_time" class="mr-sm-2"> เวลารับ Refer : </label>
									<input type="text" class="form-control mb-2 mr-sm-2" id="day_6_time" placeholder="เช่น 10.00-11.45" name="day_6_time" disabled>
								</div>
								<div class="form-group">
									<label for="day_6_total" class="mr-sm-2"> จำนวนรับ Refer : </label>
									<input type="number" class="form-control mb-2 mr-sm-2" id="day_6_total" placeholder="เช่น 5" name="day_6_total" disabled>
								</div>
							</form>

						</div>

						<div id="div_opd_exam_all">
							<div class="form-group row">
								<label for="setup_time_app" class="col-sm-4 col-form-label">slot</label>
								<div class="col-sm-5">
								<input type="text" class="form-control" id="setup_time_app" placeholder="เช่น 10.00 - 10.30">
								</div>
							</div>
							<div class="form-group row">
								<label for="setup_total_app" class="col-sm-4 col-form-label">จำนวนนัดต่อวัน</label>
								<div class="col-sm-5">
									<input type="number" class="form-control" id="setup_total_app" placeholder="เช่น 5">
								</div>
							</div>
						</div>
						<button type="button" class="btn btn-primary" id="btn_slot">ยืนยัน</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					</div>
					<!---- tab กำหนดวันหยุด ----->
					<div class="tab-pane fade" id="nav-holiday" role="tabpanel" aria-labelledby="nav-holiday-tab">
						<form class="form-inline mt-2">
							<div class="form-group">
								<label for="startdate" class="mr-sm-2"> วันที่ : </label>
								<input type="text" class="form-control mb-2 mr-sm-2 datepicker" id="startdate" name="startdate">
							</div>
							<div class="form-group">
								<label for="enddate" class="mr-sm-2"> ถึงวันที่ : </label>
								<input type="text" class="form-control mb-2 mr-sm-2 datepicker" id="enddate" name="enddate">
							</div>
						</form>
						<input type="hidden" class="form-control mb-2 mr-sm-2" id="bid" name="bid">
						<button type="button" class="btn btn-primary" id="btn_holiday">บันทึก</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>

						<div class="row">
							<div class="col-md-12">
								<table id="tbl_holiday_doctor" class="table" data-toolbar="#toolbar_appoint_walkin" data-toggle="table" data-cache="false" data-url="" data-pagination="true" data-row-style="" data-locale="th-th" data-page-size="5" data-auto-refresh="true">
									<thead class="thead-light">	
										<tr>
											<th data-formatter="autonum">#</th>
											<th data-field="datestart_th">วันที่</th>
											<th data-field="dateend_th">ถึงวันที่</th>
											<th data-field="del">ลบ</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="nav-message" role="tabpanel" aria-labelledby="nav-message-tab">
						อยู่ระหว่างการพัฒนา ...
					</div>
				</div>
			  </div>
			  <div class="modal-footer">
				<!-- <button type="button" class="btn btn-primary" id="btn_slot">ยืนยัน</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button> -->
			  </div>
			</div>
		  </div>
		</div>
		
		<!--- modal pic------>
		<div class="modal fade" id="modal_pic_zoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">	
				<div id="pic_zoom"></div>		
			  </div>
			  
			</div>
		  </div>
		</div>