$(document).ready(function (){
	$('#optFilter').change(function (){
		 $.get("function.php?func=loadoptbrand&typeid="+document.getElementById('optFilter').value,function(data,status){
             document.getElementById("optFilter2").innerHTML = data;

             	 $.get("function.php?func=loadoptmodel&brandid="+document.getElementById('optFilter2').value,function(data,status){
		             document.getElementById("optFilter3").innerHTML = data;

		             	
		          });
          });
	});


	$('#optFilter2').change(function (){

				$.get("function.php?func=loadoptmodel&brandid="+document.getElementById('optFilter2').value,function(data,status){
		             document.getElementById("optFilter3").innerHTML = data;

		             	
		          });
	});

	$('#optItemType').change(function (){
		 $.get("function.php?func=loadoptbrand&typeid="+document.getElementById('optItemType').value,function(data,status){
             
             document.getElementById("optItemBrand").innerHTML = data;

             $.get("function.php?func=loadoptmodel&brandid="+$('#optItemBrand').val(),function(data,status){
	               document.getElementById("optItemModel").innerHTML = data;
	         });

          });
	});

	$('#optMobileBrand').change(function (){

             $.get("function.php?func=loadoptmodel&brandid="+$('#optMobileBrand').val(),function(data,status){
	               document.getElementById("optMobileModel").innerHTML = data;
	         });

       
	});

	$('#optHBrand').change(function (){
		 $.get("function.php?func=loadoptmodel&brandid="+$('#optHBrand').val(),function(data,status){
	        document.getElementById("optHModel").innerHTML = data;

	        $.get("function.php?func=loadoptitem2&model="+$('#optHModel').val(),function(data,status){
		        document.getElementById("optHItem").innerHTML = data;
		     });

	     });
	});

	$('#optKBrand').change(function (){
		 $.get("function.php?func=loadoptmodel&brandid="+$('#optKBrand').val(),function(data,status){
	        document.getElementById("optKModel").innerHTML = data;

	        $.get("function.php?func=loadoptitem2&model="+$('#optKModel').val(),function(data,status){
		        document.getElementById("optKItem").innerHTML = data;
		     });

	     });
	});



	$('#optKModel').change(function (){
		 $.get("function.php?func=loadoptitem2&model="+$('#optKModel').val(),function(data,status){
	        document.getElementById("optKItem").innerHTML = data;
	     });
	});


	$('#optMMBrand').change(function (){
		 $.get("function.php?func=loadoptmodel&brandid="+$('#optMMBrand').val(),function(data,status){
	        document.getElementById("optMMModel").innerHTML = data;

	        $.get("function.php?func=loadoptitem2&model="+$('#optMMModel').val(),function(data,status){
		        document.getElementById("optMMItem").innerHTML = data;
		     });

	     });
	});

	$('#optMMModel').change(function (){
		 $.get("function.php?func=loadoptitem2&model="+$('#optMMModel').val(),function(data,status){
	        document.getElementById("optMMItem").innerHTML = data;
	     });
	});

	$('#optMBrand').change(function (){
		 $.get("function.php?func=loadoptmodel&brandid="+$('#optMBrand').val(),function(data,status){
	        document.getElementById("optMModel").innerHTML = data;

	        $.get("function.php?func=loadoptitem2&model="+$('#optMModel').val(),function(data,status){
		        document.getElementById("optMItem").innerHTML = data;
		     });

	     });
	});

	$('#optMModel').change(function (){
		 $.get("function.php?func=loadoptitem2&model="+$('#optMModel').val(),function(data,status){
	        document.getElementById("optMItem").innerHTML = data;
	     });
	});

	$('#optHModel').change(function (){
		 $.get("function.php?func=loadoptitem2&model="+$('#optHModel').val(),function(data,status){
	        document.getElementById("optHItem").innerHTML = data;
	     });
	});

	$('#optABrand').change(function (){
		 $.get("function.php?func=loadoptmodel&brandid="+$('#optABrand').val(),function(data,status){
	        document.getElementById("optAModel").innerHTML = data;

	        $.get("function.php?func=loadoptitem2&model="+$('#optAModel').val(),function(data,status){
		        document.getElementById("optAItem").innerHTML = data;
		     });

	     });
	});

	$('#optAModel').change(function (){
		 $.get("function.php?func=loadoptitem2&model="+$('#optAModel').val(),function(data,status){
	        document.getElementById("optAItem").innerHTML = data;
	     });
	});

	$('#optItemBrand').change(function (){
		 $.get("function.php?func=loadoptmodel&brandid="+$('#optItemBrand').val(),function(data,status){
	        document.getElementById("optItemModel").innerHTML = data;
	     });
	});

	$('#optCompany').change(function (){
		 $.get("function.php?func=loadoptl&companyid="+$('#optCompany').val(),function(data,status){
	        document.getElementById("optDispatchLoc").innerHTML = data;
	     });
	});

	$('#optType').change(function() {
		if($(this).val() == "Laptop"){
			$('#lbl').text("Service Tag");
			$('#txtRemarks').attr("placeholder","Enter Service Tag");
			$('#txtRemarks').attr("required","true");
		}else{
			$('#lbl').text("Remarks");
			$('#txtRemarks').attr("placeholder","Enter Remarks");
			$('#txtRemarks').removeAttr("required");
		}
	});

	$("#chkReturn").change(function() {

		if(document.getElementById('chkReturn').checked){
			$('#txtReason').val("");
			$('#txtReason').removeAttr('readonly');
		}else{
			$('#txtReason').val("");
			$('#txtReason').attr('readonly','true');

		}
	});


$("#txtWSerial").keypress(function() {

		if($(this).val().length>0){

			 $.get("function.php?func=valwserial&serial="+$('#txtWSerial').val(),function(data,status){
	        		if(data.length>0){
						$("#validateSerial").removeClass("has-success").addClass("has-error");
						$("#feedIcon").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addWorkstation').attr("disabled","true");
					}else{
						$("#validateSerial").removeClass("has-error").addClass("has-success");
						$("#feedIcon").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
						$('#addWorkstation').removeAttr("disabled");
					}
	        });
			
			 
			validateAll();
		}else{
			$("#validateSerial").removeClass("has-error");
			$("#feedIcon").removeClass("glyphicon glyphicon-remove");
			$("#validateSerial").removeClass("has-success");
			$("#feedIcon").removeClass("glyphicon glyphicon-ok");
			$('#addWorkstation').removeAttr("disabled");
		}
	});

	$("#txtLicense").click(function() {
		document.getElementById("txtLicense").value = document.getElementById("txtLicense").value.replace(/-/gi,'');
	});


	$("#txtLicense").blur(function() {
		if($(this).val().length>0){

			if($(this).val().length==25){
				$("#validateLicense").removeClass("has-error").addClass("has-success");
				$("#feedIcon3").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
				$('#addWorkstation').removeAttr("disabled");
				var lic = $(this).val();
				var flic = [lic.slice(0,5),'-',
							lic.slice(5,10),'-',
							lic.slice(10,15),'-',
							lic.slice(15,20),'-',
							lic.slice(20,25)].join('');
				document.getElementById("txtLicense").value = flic.toUpperCase();
			}else{
				$("#validateLicense").removeClass("has-success").addClass("has-error");
				$("#feedIcon3").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addWorkstation').attr("disabled","true");
			}
			
			validateAll();
		}else{
			$("#validateLicense").removeClass("has-error");
			$("#feedIcon3").removeClass("glyphicon glyphicon-remove");
			$("#validateLicense").removeClass("has-success");
			$("#feedIcon3").removeClass("glyphicon glyphicon-ok");

		}


	});

	$("#txtLicense").keypress(function() {
		if($(this).val().length>0){

			if($(this).val().length==25){
				$("#validateLicense").removeClass("has-error").addClass("has-success");
				$("#feedIcon3").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
				$('#addWorkstation').removeAttr("disabled");
				var lic = $(this).val();
				var flic = [lic.slice(0,5),'-',
							lic.slice(5,10),'-',
							lic.slice(10,15),'-',
							lic.slice(15,20),'-',
							lic.slice(20,25)].join('');
				document.getElementById("txtLicense").value = flic.toUpperCase();
			}else{
				$("#validateLicense").removeClass("has-success").addClass("has-error");
				$("#feedIcon3").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addWorkstation').attr("disabled","true");
			}


			validateAll();
		}else{
			$("#validateLicense").removeClass("has-error");
			$("#feedIcon3").removeClass("glyphicon glyphicon-remove");
			$("#validateLicense").removeClass("has-success");
			$("#feedIcon3").removeClass("glyphicon glyphicon-ok");

		}
	});

	$("#txtMac").click(function() {
		document.getElementById("txtMac").value = document.getElementById("txtMac").value.replace(/-/gi,'');
	});

	$("#txtMac").blur(function() {
		if($(this).val().length>0){

			if($(this).val().length==12){
				$("#validateMac").removeClass("has-error").addClass("has-success");
				$("#feedIcon2").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
				var mac = $(this).val();
				var fmac = [mac.slice(0,2),'-',
							mac.slice(2,4),'-',
							mac.slice(4,6),'-',
							mac.slice(6,8),'-',
							mac.slice(8,10),'-',
							mac.slice(10,12)].join('');
				document.getElementById("txtMac").value = fmac.toUpperCase();
				$('#addWorkstation').removeAttr("disabled");
			}else{
				$("#validateMac").removeClass("has-success").addClass("has-error");
				$("#feedIcon2").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addWorkstation').attr("disabled","true");
			}


			validateAll();
		}else{
			$("#validateMac").removeClass("has-error");
			$("#feedIcon2").removeClass("glyphicon glyphicon-remove");
			$("#validateMac").removeClass("has-success");
			$("#feedIcon2").removeClass("glyphicon glyphicon-ok");

		}
	});

	$("#txtMac").keypress(function() {
		if($(this).val().length>0){

			if($(this).val().length==12){
				$("#validateMac").removeClass("has-error").addClass("has-success");
				$("#feedIcon2").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
				var mac = $(this).val();
				var fmac = [mac.slice(0,2),'-',
							mac.slice(2,4),'-',
							mac.slice(4,6),'-',
							mac.slice(6,8),'-',
							mac.slice(8,10),'-',
							mac.slice(10,12)].join('');
				document.getElementById("txtMac").value = fmac.toUpperCase();
				$('#addWorkstation').removeAttr("disabled");
			}else{
				$("#validateMac").removeClass("has-success").addClass("has-error");
				$("#feedIcon2").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
				$('#addWorkstation').attr("disabled","true");

			}


			validateAll();
		}else{
			$("#validateMac").removeClass("has-error");
			$("#feedIcon2").removeClass("glyphicon glyphicon-remove");
			$("#validateMac").removeClass("has-success");
			$("#feedIcon2").removeClass("glyphicon glyphicon-ok");
			$('#addWorkstation').removeAttr("disabled");

		}
	});	

	$('input[name="rbtnApps"]').change(function() {
		$.get("function.php?func=loadapps&type="+$('input[name="rbtnApps"]:checked').val(),function(data,status){
		        document.getElementById("optApps").innerHTML = data;
		});
	});

	$("#txtWSerial").blur(function() {

		if($(this).val().length>0){

			 $.get("function.php?func=valwserial&serial="+$('#txtWSerial').val(),function(data,status){
	        		if(data.length>0){
						$("#validateSerial").removeClass("has-success").addClass("has-error");
						$("#feedIcon").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addWorkstation').attr("disabled","true");
					}else{
						$("#validateSerial").removeClass("has-error").addClass("has-success");
						$("#feedIcon").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
						$('#addWorkstation').removeAttr("disabled");
					}
	        });
			validateAll();

		}else{
			$("#validateSerial").removeClass("has-error");
			$("#feedIcon").removeClass("glyphicon glyphicon-remove");
			$("#validateSerial").removeClass("has-success");
			$("#feedIcon").removeClass("glyphicon glyphicon-ok");
			$('#addWorkstation').removeAttr("disabled");
		}
		
		var text = document.getElementById("txtWSerial").value;
		document.getElementById("txtWSerial").value = text.toUpperCase();
	});


	
	function validateAll(){
		if($('#validateSerial').hasClass("has-error")||
		   $('#validateMac').hasClass("has-error")||
		   $('#validateLicense').hasClass("has-error")){
			$('#addWorkstation').attr("disabled","true");
		}else{
			$('#addWorkstation').removeAttr("disabled");
		}
	}

	$("#txtSerial").keypress(function() {

		if($(this).val().length>0&&$("#rbtnCat1").attr('checked')){

			 $.get("function.php?func=valserial&serial="+$('#txtSerial').val(),function(data,status){
	        		if(data.length>0){
						$("#validateSerial").removeClass("has-success").addClass("has-error");
						$("#feedIcon").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addInventory').attr("disabled","true");
					}else{
						$("#validateSerial").removeClass("has-error").addClass("has-success");
						$("#feedIcon").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
						$('#addInventory').removeAttr("disabled");
					}
	        });
			

		}else{
			$("#validateSerial").removeClass("has-error");
			$("#feedIcon").removeClass("glyphicon glyphicon-remove");
			$("#validateSerial").removeClass("has-success");
			$("#feedIcon").removeClass("glyphicon glyphicon-ok");
			$('#addInventory').removeAttr("disabled");
		}
	});


	$('#appendall').click(function(){
		$("#optApps option").each(function(){
			$('#listapps').append('<a class="list-group-item" name="optApps" id="'+$(this).val()+'">'+$(this).text()+'<input type="hidden" name="application[]" id="'+$(this).val()+'" value="'+$(this).val()+'"></a>');
			
		});
		$("#optApps option").remove();
	});

	$("#txtSerial").blur(function() {

		if($(this).val().length>0&&$("#rbtnCat1").attr('checked')){

			 $.get("function.php?func=valserial&serial="+$('#txtSerial').val(),function(data,status){
	        		if(data.length>0){
						$("#validateSerial").removeClass("has-success").addClass("has-error");
						$("#feedIcon").removeClass("glyphicon glyphicon-ok").addClass("glyphicon glyphicon-remove");
						$('#addInventory').attr("disabled","true");
					}else{
						$("#validateSerial").removeClass("has-error").addClass("has-success");
						$("#feedIcon").removeClass("glyphicon glyphicon-remove").addClass("glyphicon glyphicon-ok");
						$('#addInventory').removeAttr("disabled");
					}
	        });
			

		}else{
			$("#validateSerial").removeClass("has-error");
			$("#feedIcon").removeClass("glyphicon glyphicon-remove");
			$("#validateSerial").removeClass("has-success");
			$("#feedIcon").removeClass("glyphicon glyphicon-ok");
			$('#addInventory').removeAttr("disabled");
		}

		var text = document.getElementById("txtSerial").value;
		document.getElementById("txtSerial").value = text.toUpperCase();
	});


	$("#chkSerialNA").change(function() {

		if(document.getElementById('chkSerialNA').checked){
			$('#txtSerial').val("N/A");
			$('#txtSerial').attr('readonly','true');
		}else{
			$('#txtSerial').val("");
			$('#txtSerial').removeAttr('readonly');

		}
	});

	$("#chkDispatch").change(function() {

		if(document.getElementById('chkDispatch').checked){
			$('#optDispatchTo').removeAttr('disabled');
			$('#optDispatchLoc').removeAttr('disabled');
		}else{
			$('#optDispatchTo').attr('disabled','true');
			$('#optDispatchLoc').attr('disabled','true');

		}
	});


	$('.listrem').on('click','a',function(){
		if(confirm("Are you sure you want to remove this item?")){
			$(this).remove();
			$('#'+$(this).attr("name")).append('<option value="'+$(this).attr("id")+'">'+$(this).text()+'</option>');
		}
	});

	$('.listr').on('click','a',function(){
		if(confirm("Are you sure you want to remove this item?")){
			$('#listritem').append('<a class="list-group-item disabled">'+$(this).text()+'<input type="hidden" name="ritem[]" id="ritem'+$(this).attr('name')+'" value="'+$(this).attr('name')+'"> <div class="pull-right">Reason <select name="optReason[]"><option value="Defective">Defective</option><option value="Upgrade">Upgrade</option><option value="Resigned">Resigned</option></select></div>&nbsp;&nbsp;<div class="pull-right">Status <select name="optRStatus[]"><option value="1">Healthy</option><option value="2">For Repair</option><option value="3">Scrap</option></select></div></a>');
			$(this).remove();
		}
	});

	$("input[name=rbtnCat]:radio").change(function () {

		if($(this).val()==1){
			$('#txtQuantity').val("1");
			$('#txtQuantity').attr('readonly','true');
			$('#txtSerial').attr('required');
			$('#txtSerial').val("");
			$('#txtSerial').removeAttr('readonly');
			$('#txtQuantity').removeAttr('required');
			$('#chkSerialNA').removeAttr('checked');
			$('#na').css('visibility','hidden');
		}else{
			$('#txtQuantity').val("1");
			$('#txtQuantity').removeAttr('readonly');
			$('#txtQuantity').attr('required');
			$('#txtSerial').removeAttr('required');
			$('#na').css('visibility','visible');
		}

		$.get("function.php?func=loadopttype&typecat="+$(this).val(),function(data,status){
             document.getElementById("optItemType").innerHTML = data;
             
             $.get("function.php?func=loadoptbrand&typeid="+$('#optItemType').val(),function(data,status){
            	 document.getElementById("optItemBrand").innerHTML = data;

            	 $.get("function.php?func=loadoptmodel&brandid="+$('#optItemBrand').val(),function(data,status){
	            	 document.getElementById("optItemModel").innerHTML = data;
	        	 });
        	 });
        });


		
	});


	

	$('#pclear').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		if(confirm("Are you sure you want to remove all the items?")){
			$('#'+document.getElementById('pclear').value+' > a').remove();
			$.get("function.php?func=loadproc",function(data,status){
		        document.getElementById("optPItem").innerHTML = data;
		    });
		}
	});

	$('#mclear').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		if(confirm("Are you sure you want to remove all the items?")){
			$('#listmem > a').remove();
			$.get("function.php?func=loadoptitem2&model="+$('#optMModel').val(),function(data,status){
		        document.getElementById("optMItem").innerHTML = data;
		    });
		}
	});

	$('#kclear').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		if(confirm("Are you sure you want to remove all the items?")){
			$('#listkb > a').remove();
			$.get("function.php?func=loadoptitem2&model="+$('#optKModel').val(),function(data,status){
		        document.getElementById("optKItem").innerHTML = data;
		    });
		}
	});

	$('#hclear').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		if(confirm("Are you sure you want to remove all the items?")){
			$('#listhdd > a').remove();
			$.get("function.php?func=loadoptitem2&model="+$('#optHModel').val(),function(data,status){
		        document.getElementById("optHItem").innerHTML = data;
		    });
		}
	});

	$('#mmclear').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		if(confirm("Are you sure you want to remove all the items?")){
			$('#listmouse > a').remove();
			$.get("function.php?func=loadoptitem2&model="+$('#optMMModel').val(),function(data,status){
		        document.getElementById("optMMItem").innerHTML = data;
		    });
		}
	});

	$('#clear').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		if(confirm("Are you sure you want to remove all the items?")){
			$('#'+document.getElementById('clear').value+' > a').remove();
			$.get("function.php?func=loadapps&type="+$('input[name="rbtnApps"]:checked').val(),function(data,status){
		        document.getElementById("optApps").innerHTML = data;
		    });
		}
	});

	$('#aclear').on('click',function(){
		if(confirm("Are you sure you want to remove all the items?")){
			$('#listmonitor > a').remove();
			$.get("function.php?func=loadoptitem2&model="+$('#optAModel').val(),function(data,status){
		        document.getElementById("optAItem").innerHTML = data;
		    });
		}
	});

	$('#mappend').on('click',function(){
		if($('#mem'+$("#optMItem").val()).length<=0){
			$('#listmem').append('<a class="list-group-item" name="optMItem" id="'+$('#optMItem').val()+'">'+$("#optMItem option:selected").text()+'<input type="hidden" name="mem[]" id="mem'+$('#optMItem').val()+'" value="'+$('#optMItem').val()+'"></a>');
			$("#optMItem option[value='"+$('#optMItem').val()+"']").remove();
		}
	});

	$('#mmappend').on('click',function(){
		if($('#mouse'+$("#optMMItem").val()).length<=0){
			$('#listmouse').append('<a class="list-group-item" name="optMMItem" id="'+$('#optMMItem').val()+'">'+$("#optMMItem option:selected").text()+'<input type="hidden" name="mouse[]" id="mouse'+$('#optMMItem').val()+'" value="'+$('#optMMItem').val()+'"></a>');
			$("#optMMItem option[value='"+$('#optMMItem').val()+"']").remove();
		}
	});

	$('#happend').on('click',function(){
		if($('#hdd'+$("#optHItem").val()).length<=0){
			$('#listhdd').append('<a class="list-group-item" name="optHItem" id="'+$('#optHItem').val()+'">'+$("#optHItem option:selected").text()+'<input type="hidden" name="hdd[]" id="hdd'+$("#optHItem").val()+'" value="'+$("#optHItem").val()+'"></a>');
			$("#optHItem option[value='"+$('#optHItem').val()+"']").remove();
		}
	});

	$('#kappend').on('click',function(){
		if($('#kb'+$("#optKItem").val()).length<=0){
			$('#listkb').append('<a class="list-group-item" name="optKItem" id="'+$('#optKItem').val()+'">'+$("#optKItem option:selected").text()+'<input type="hidden" name="kb[]" id="kb'+$("#optKItem").val()+'" value="'+$("#optKItem").val()+'"></a>');
			$("#optKItem option[value='"+$('#optKItem').val()+"']").remove();
		}
	});



	$('#append').on('click',function(){
		$('#listapps').append('<a class="list-group-item" name="optApps" id="'+$('#optApps').val()+'">'+$("#optApps option:selected").text()+'<input type="hidden" name="application[]" id="'+$('#optApps').val()+'" value="'+$('#optApps').val()+'"></a>');
		$("#optApps option[value='"+$('#optApps').val()+"']").remove();
	});

	$('#aappend').on('click',function(){
		$('#listmonitor').append('<a class="list-group-item" name="optAItem" id="'+$('#optAItem').val()+'">'+$("#optAItem option:selected").text()+'<input type="hidden" name="monitor[]" id="'+$('#optAItem').val()+'" value="'+$('#optAItem').val()+'"></a>');
		$("#optAItem option[value='"+$('#optAItem').val()+"']").remove();
	});

	$('#pappend').on('click',function(){

		//if ($('#'+document.getElementById('pappend').value+' a:contains("' + $("#"+$('#pappend').attr('class').split(' ')[0]+" option:selected").text() + '")').length) {
		//}else
		$('#'+document.getElementById('pappend').value).append('<a class="list-group-item" name="'+$('#pappend').attr('class').split(' ')[0]+'" id="'+$('#'+$('#pappend').attr('class').split(' ')[0]).val()+'">'+$("#"+$('#pappend').attr('class').split(' ')[0]+"  option:selected").text()+'<input type="hidden" name="processor[]" value="'+document.getElementById($('#pappend').attr('class').split(' ')[0]).value+'"></a>');
		$("#"+$('#pappend').attr('class').split(' ')[0]+" option[value='"+$('#'+$('#pappend').attr('class').split(' ')[0]).val()+"']").remove();

	});

});



	function runIt(str){
		 $.get("function.php?func=loadoptbrand&typeid="+document.getElementById('optItemTypeU'+str).value,function(data,status){
             document.getElementById("optItemBrandU"+str).innerHTML = data;
          });
	}