//*** slide menu *******
	$('.leftmenutrigger').on('click', function (e) {			
	    $('.side-nav').toggleClass("open");
	    $('#wrapper').toggleClass("open");
	    e.preventDefault();
	});
	
	$('#referout_date,#report_date').datepicker({
		format: "dd-mm-yyyy",
		todayBtn: true,
		language: "th",
		forceParse: false,
		autoclose: true,
		//endDate: new Date,
		todayHighlight: true
	});

	
	//** reset form addpt ****
	function resetform(){
		$('#frm_profile')[0].reset();
		$("#blood,#mstatus,#rel,#eth,#native,#prov,#edu,#prof").selectpicker('val','');
		$("#amp,#amp1").empty();
		$("#amp,#amp1").selectpicker('refresh');
		$("#id_card").val('');
	
		$('#tbl_ptname').bootstrapTable('refresh', {silent: true});
		$('#tbl_appoint').bootstrapTable('removeAll');
		
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

	function getlookup(){
		//console.log('getlookup');
		$.ajax({
			url: 'get_lookup.php',
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
	
		$.ajax({
			url: 'get_lookup.php',
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
	
		$.ajax({
			url: 'get_lookup.php',
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

		$.ajax({
			url: 'get_lookup.php',
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
	
		$.ajax({
			url: 'get_lookup.php',
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
	
		$.ajax({
			url: 'get_lookup.php',
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
	
		$.ajax({
			url: 'get_lookup.php',
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
	
		$.ajax({
			url: 'get_lookup.php',
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
		
		/*
		$.ajax({
			url: 'get_lookup.php',
			type: "POST",
			dataType: "json",
			data : {q:"places",func:'get_lookup',q1:''},
			cache: false,
			success: function(data) {
				for (var i = 0; i < data.length; i++) {
					$("#pla,#pla-showapp").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');				
				}
				 $('#pla,#pla-showapp').selectpicker('refresh');
			}
		});
		*/
		$.ajax({
			url: 'client.php',
			type: "POST",
			dataType: "json",
			data : {q:"places",func:'get_lookup',q1:''},
			cache: false,						
			success: function(data) {
				//console.log('rel='+data.length);
				for (var i = 0; i < data.length; i++) {
				  $("#pla").append('<option value="' + data[i].id + '">' + data[i].text + '</option>');
				}
				 $('#pla').selectpicker('refresh');
			}
		});
		
	}

	function autonum(value, row, index) {
		return index+1;
		console.log(index);
	}
	
	function rowStyle(row, index) {
		//console.log(row.hn);
		if (row.hn==null || row.hn=='') { // ยังไม่ทำบัตร
			return {
				css: {
					//color:"#ffffcc",
					background:'#ff3333',
					//"font-weight": "bold" 
				}
			};
		}
		return {};
    }
	