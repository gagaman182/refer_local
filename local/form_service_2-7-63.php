<!-- Modal เพิ่มผู้ป่วยนัด-->
		<div class="modal fade" id="modal-service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" style="max-width: 90%;" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">รายละเอียดผู้ป่วยนัด</h5>
						<button type="button" id="btnX_close" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
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
																<input type="text" required class="form-control border-danger" name="cid" id="cid" placeholder="ค้นหา เลขบัตรประชาชน" autofocus>
															</div>
															<button type="submit" class="btn btn-primary mb-2" id="btn_search">ค้นหา</button>
														</form>
													</div>
												</div>
											</div>
											<form action="" method="post" name="frm_profile" id="frm_profile" role="form" >
											<div class="row">
												<div class="col-md-12">											
													<div class="form-row">
														<div class="col-md-1  mb-1">
															<label for="hn">HN</label>
															<input type="text" class="form-control" name="hn" id="hn" placeholder="" readonly>
														</div>										
														<div class="col-md-3 mb-1">
															<label for="ptname">ชื่อ สกุล</label>
															<input type="text" required class="form-control" name="ptname" id="ptname" placeholder="">
														</div>										
														<div class="col-md-1 mb-1">
															<label for="sex">เพศ</label>
															<select  required class="form-control" name="sex" id="sex">
																<option></option>
																<option value="M">ชาย</option>
																<option value="F">หญิง</option>
															</select>
														</div>										
														<div class="col-md-1 mb-1">
															<label for="dob">วันเกิด</label>
															  <input type="text" class="form-control" id="dob" name="dob">
												
															<!-- <input  required  type="date" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" placeholder="DD MM YYYY"  name="dob" id="dob" class="form-control"> -->
														</div>
														<div class="col-md-1 mb-1">
															<label for="blood">กรุ๊ปเลือด</label>
															<select class="selectpicker form-control" name="blood" id="blood"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>	
														<div class="col-md-1 mb-1">
															<label for="mstatus">สถานะ</label>
															<select required  class="selectpicker form-control" name="mstatus" id="mstatus"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>													
														<div class="col-md-2 mb-1">
															<label for="rel">ศาสนา</label>
															<select required  class="selectpicker form-control" name="rel" id="rel"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>
														<div class="col-md-2 mb-1">
															<label for="tel">เบอร์โทร</label>
															<input required  type="text" id="tel" name="tel" class="form-control">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-row">
														<div class="col-md-3 mb-1">
															<label for="eth">สัญชาติ</label>
															<select required  class="selectpicker form-control" name="eth" id="eth"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>	
														<div class="col-md-3 mb-1">
															<label for="native">เชื้อชาติ</label>
															<select required  class="selectpicker form-control" name="native" id="native"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>
														<div class="col-md-2 mb-1">
															<label for="edu">การศึกษา</label>
															<select  required class="selectpicker form-control" name="edu" id="edu"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>	
														<div class="col-md-3 mb-1">
															<label for="prof">อาชีพ</label>
															<select  required class="selectpicker form-control" name="prof" id="prof"  data-live-search="true" data-style="btn-new" title="&nbsp;" data-size="5">
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
															<input required  type="text" class="form-control" name="home" id="home" placeholder="">
														</div>
														<div class="col-md-1 mb-1">
															<label for="moo">หมู่</label>
															<input type="text" class="form-control" name="moo" id="moo" placeholder="">
														</div>
														<div class="col-md-2 mb-1">
															<label for="road">ถนน</label>
															<input type="text" class="form-control" name="road" id="road" placeholder="">
														</div>
														<div class="col-md-1 mb-1">
															<label for="soi">ซอย</label>
															<input type="text" class="form-control" name="soi" id="soi" placeholder="">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-row">
														<div class="col-md-2 mb-1">
															<label for="prov">จังหวัด</label>
															<select  required class="selectpicker form-control" name="prov" id="prov"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">
																<option value=""></option>
															</select>								
														</div>														
														<div class="col-md-2 mb-1">
															<label for="amp">อำเภอ</label>
															<select required  class="selectpicker form-control" name="amp" id="amp"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">														
															</select>								
														</div>
														<div class="col-md-2 mb-1">
															<label for="amp1">ตำบล</label>
															<select required  class="selectpicker form-control" name="amp1" id="amp1"  data-style="btn-new"  data-live-search="true" title="&nbsp;" data-size="5">														
															</select>								
														</div>
														<div class="col-md-2 mb-1">
															<label for="zip">รหัสไปรษณีย์</label>
															<input type="text" class="form-control" name="zip" id="zip" placeholder="">
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-row">												
														<div class="col-md-2 mb-1">
															<label for="father">บิดา</label>
															<input type="text" class="form-control" name="father" id="father" placeholder="">
														</div>
														<div class="col-md-2 mb-1">
															<label for="mother">มารดา</label>
															<input type="text" class="form-control" name="mother" id="mother" placeholder="">
														</div>
														<div class="col-md-2 mb-1">
															<label for="wifename">คู่สมรส</label>
															<input type="text" class="form-control" name="wifename" id="wifename" placeholder="">
														</div>												
													</div>
												</div>
											</div>
											
											<!-- <div class="row">
												<div class="col-md-12">	
													<input type="hidden" class="form-control" name="id_card" id="id_card" placeholder="">
													<button type="submit" class="btn btn-primary" id="btn_save">บันทึก</button> <button type="button" class="btn btn-primary" id="btn_reset">ยกเลิก</button>																						
												</div>																		
											</div> -->
										</div>
									</div>

								</div>									
							</div>
					</div>
					<div class="modal-footer">	
						<input type="hidden" class="form-control" name="id_card" id="id_card" placeholder="">
						<input type="hidden" class="form-control" name="ptname_appoint" id="ptname_appoint" placeholder="">

						<button type="submit" class="btn btn-primary" id="btn_save">บันทึก</button>
						<button type="button" id="btn_close" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
					</div>
					</form>
				</div>
			</div>
		</div>