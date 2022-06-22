var ext = window.location.pathname.split('.').pop();
var extension;

if($.trim(ext) == 'php') {
	extension = ".php";
}
else {
	extension = "";
}


//Get SubBusiness
function getSubBusiness() {
	
	var sbid = $('#businessFilter').val();
	var encrptText = JSON.stringify(sbid+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		type: "POST",
		url: "ajax/subBusiness"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$("#subbusinessFilter").html(data);
		 $.uniform.update("#subbusinessFilter");
		}
		
	});
	
}


//Get SubSubBusiness
function getSubSubBusiness() {
	
	var ssbid = $('#subbusinessFilter').val();
	var encrptText = JSON.stringify(ssbid+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		type: "POST",
		url: "ajax/subSubBusiness"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$("#ssbusinessFilter").html(data);
		 $.uniform.update("#ssbusinessFilter");
		}
		
	});
	
}



//Get Segment
function getSegment() {
	getZone();
	
	var sbid = $('#businessFilter').val();
	var encrptText = JSON.stringify(sbid+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/segment"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			$("#segmentFilter").html(data);
		 $.uniform.update("#segmentFilter");
		}
		
	});
	
}

// getDesignation
function getDesignation() {
	//getZone();
	var sbid = $('#segmentFilter option:selected').val();
	var encrptText = JSON.stringify(sbid+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/designation_mrf"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			$("#posFilter").html(data);
		 $.uniform.update("#posFilter");
		}
		
	});
	
}

 function getDept(){
 	//getDesignation();
   var typeId = $("#Type option:selected").val();

	var encrptText = JSON.stringify(typeId+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/dept"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			
			var results = data.split('=**=');

			if(results[0] =='Y'){
				$("#businessFilter").html(results[1]);
			 	$.uniform.update("#businessFilter");
			}
			else{
				$('#errorMsg').text('Headcount yet to be allocated, kindly inform the Admin');
				$('#alertBox').show().delay(3000).fadeOut(1000);
				
			}
		}
		
	});
}


function getZone(){
	//getregion();
	var sbid = $("#businessFilter option:selected").val();

	var encrptText = JSON.stringify(sbid+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/zone"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			$("#zoneFilter").html(data);
		 $.uniform.update("#zoneFilter");
		}
		
	});
}

function getLocation(){
	//getregion();
	var cityId = $("#cityFilter option:selected").val();

	var encrptText = JSON.stringify(cityId+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/location"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			$("#LocFilter").html(data);
		 $.uniform.update("#LocFilter");
		}
		
	});
}

function getregion(){
	var sbid = $("#businessFilter option:selected").val();
	var zid = $('#zoneFilter').val();
	var encrptText = JSON.stringify(sbid+'=**='+zid+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/region"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			$("#regionFilter").html(data);
		 $.uniform.update("#regionFilter");
		}
		
	});
}

function noofOpinings(){
	//getLocation();
	var categoryId = $('#businessFilter option:selected').val();
	var zoneFilter = $('#zoneFilter option:selected').val();
	var stateId = $('#stateFilter option:selected').val();
	var cityId = $('#cityFilter option:selected').val();
	var type= $('#Type option:selected').val();
	var hiringFilter= $('#hiringFilter option:selected').val();
	var encrptText = JSON.stringify(categoryId+'=**='+zoneFilter+'=**='+stateId+'=**='+cityId+'=**='+type+'=**='+hiringFilter+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/noofOpinings"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			var res = base64_decode(data);
			var result = res.split('=**=');
			$("#noPos").val(result[0]);
			$("#totalRCount").val(result[0]);
			$('#offempId').val(result[1]);
			$('#totalremaingCount span').html('Total Remaining count : '+result[0]);
		 
		}
		
	});
}

// getPostion
function getPosition() {
		
	var CategoryId = $('#catFilter').val();
	 var IndusId = $("#indFilter").val();
	var ClientId = $("#clientcodeFilter").val();
	var CompanyId = $("#comFilter").val();
	var encrptText = JSON.stringify(CategoryId+'=**='+IndusId+'=**='+ClientId+'=**='+CompanyId+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
		$.ajax({
		type: "POST",
		url: "ajax/positionlist"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		
		 $("#posFilter").html(data);
		 $.uniform.update("#posFilter");
		 
		
		}
		
	});
	
	
}

function tyeValue() {
		
	var posFilter = $('#posFilter option:selected').val();

	var encrptText = JSON.stringify(posFilter+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
		$.ajax({
		type: "POST",
		url: "ajax/typeValue"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		
		 $("#typeFilter").html(data);
		 $.uniform.update("#typeFilter");
		 
		
		}
		
	});
	
	
}

function getGrade() {
	
	var gradeId = $('#typeFilter option:selected').val();
	var canJobId = $('#posFilter option:selected').val();
	var encrptText = JSON.stringify(gradeId+'=**='+canJobId+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/getGrade"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
			$('#loading').hide();
			$("#gradeFilter").html(data);
		 $.uniform.update("#gradeFilter");
		}
		
	});
	
}








function confirmMrf () {
	
	ageFrom = $('#ageFrom').val();
	ageTo = $('#ageTo').val();

	businessFilter = $('#businessFilter').val();
	segmentFilter = $('#segmentFilter').val()
	zoneFilter = $('#zoneFilter').val();

	stateFilter = $('#stateFilter').val();
	cityFilter = $('#cityFilter').val();
	posFilter = $('#posFilter').val();

	qualiFilterFrom = $('#qualiFilterFrom').val();
	qualiFilterTo = $('#qualiFilterTo').val();
	var typeFilter = $('#typeFilter').val();
	var gradeFilter = $('#gradeFilter').val();
	noPos = $('#noPos').val();
	//offempId = $('#offempId').val();
	fexp = $('#workExp option:selected').val();
	
    var totalRCount = parseInt($('#totalRCount').val());
     
	if(ageFrom==""){
		$('#uniform-ageFrom').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-ageFrom').offset().top - 100, 500);
		return false;
	}else if(ageTo==""){
		$('#uniform-ageTo').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-ageTo').offset().top - 100, 500);
		return false;
	}
	
	
	else if(businessFilter==""){
		$('#uniform-businessFilter').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-businessFilter').offset().top - 100, 500);
		return false;
		
	}

	else if(segmentFilter==""){
		$('#uniform-segmentFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-segmentFilter').offset().top - 100, 500);
		return false;
	}

	else if(zoneFilter==""){
		$('#uniform-zoneFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-zoneFilter').offset().top - 100, 500);
		return false;
	}
	
	else if(stateFilter==""){
		$('#uniform-stateFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-stateFilter').offset().top - 100, 500);
		return false;
	}
	else if(cityFilter==""){
		$('#uniform-cityFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-cityFilter').offset().top - 100, 500);
		return false;
	}
	
	else if(posFilter==""){
		$('#uniform-posFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-posFilter').offset().top - 100, 500);
		return false;
	}
	

	else if(qualiFilterFrom==""){
		$('#uniform-qualiFilterFrom').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-qualiFilterFrom').offset().top - 100, 500);
		return false;
	}
	else if(qualiFilterTo==""){
		$('#uniform-qualiFilterTo').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-qualiFilterTo').offset().top - 100, 500);
		return false;
	}

	
	else if(fexp==""){
		$('#uniform-workExp').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-workExp').offset().top - 100, 500);
		return false;
	}
	else if(typeFilter==""){
		$('#uniform-typeFilter').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-typeFilter').offset().top - 100, 500);
		return false;
	}

	else if(gradeFilter==""){
		$('#uniform-gradeFilter').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-gradeFilter').offset().top - 100, 500);
		return false;
	}

	else if(noPos==""){
		$('#noPos').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#noPos').offset().top - 100, 500);
		return false;
	}
	
	else if(noPos > totalRCount){
         swal("Sorry!", "No of openings should not be greater than total remaining count", "info");
         return false;
      }
 
	else{

		$.ajax({
	        type: "POST",
	        url: "ajax/confirmCanmrf" + extension,
	        data: {},
	        success: function(data) {
	            $('#ConfirmationCanmrf .md-content').html(data);
	            openPopup('ConfirmationCanmrf');
	          
	        }
	    });

	}
}

// CreateMrf
function createMrf(){


	ageFrom = $('#ageFrom').val();
	ageTo = $('#ageTo').val();

	businessFilter = $('#businessFilter').val();
	segmentFilter = $('#segmentFilter').val()
	zoneFilter = $('#zoneFilter').val();

	stateFilter = $('#stateFilter').val();
	cityFilter = $('#cityFilter').val();
	posFilter = $('#posFilter').val();

	qualiFilterFrom = $('#qualiFilterFrom').val();
	qualiFilterTo = $('#qualiFilterTo').val();
	var hiringFilter = $('#hiringFilter').val();
	noPos = $('#noPos').val();
	offempId = $('#offempId').val();
	fexp = $('#workExp option:selected').val();
	var typeFilter = $('#typeFilter').val();
	var gradeFilter = $('#gradeFilter').val();
    var totalRCount = parseInt($('#totalRCount').val());
    

			var encrptText = JSON.stringify(ageFrom+'=**='+ageTo+'=**='+businessFilter+'=**='+segmentFilter+'=**='+zoneFilter+'=**='+stateFilter+'=**='+cityFilter+'=**='+posFilter+'=**='+qualiFilterFrom+'=**='+qualiFilterTo+'=**='+noPos+'=**='+fexp+'=**='+offempId+'=**='+gradeFilter+'=**='+typeFilter+'=**='+hiringFilter+'=**=');
			var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
			$('#ConfirmationCanmrf #poploading').show();
			$.ajax({
			type: "POST",
			url: "ajax/addmrf"+extension, 
			data: {
			valJson : valJson
			},
			success: function(data){
			
			var res = base64_decode(data);
			var result = res.split('=**=');
			if(result[0] =="Y"){
				$('#ConfirmationCanmrf #poploading').hide();
				$('#successBox p').text(result[1]);
				$('#successBox').show().delay(3000).fadeOut(1000);
				closePopup('ConfirmationCanmrf');
				setTimeout(function() {
				window.location.href = 'mrf'+extension;
				}, 4000);
			}
			else {
				$('#ConfirmationCanmrf #poploading').hide();
				$('#errorMsg').text(result[1]);
				$('#alertBox').show().delay(3000).fadeOut(1000);
				closePopup('ConfirmationCanmrf');

			}
			
			}
			});
			

	
}

//updateMrf()
function updateMrf(){

	var dDate = '';

	var temFilter = $('#temFilter').val();
	var ageFrom = $('#ageFrom').val();
	var ageTo = $('#ageTo').val();
	var Type = $('#Type').val();
	var businessFilter = $('#businessFilter').val();
	var subbusinessFilter = $('#subbusinessFilter').val();
	var ssbusinessFilter = $('#ssbusinessFilter').val();
	var segmentFilter = $('#segmentFilter').val();
	var zoneFilter = $('#zoneFilter').val();
	var regionFilter = $('#regionFilter').val();
	var stateFilter = $('#stateFilter').val();
	var cityFilter = $('#cityFilter').val();
	var posFilter = $('#posFilter').val();
	var qualiFilterFrom = $('#qualiFilterFrom').val();
	var qualiFilterTo = $('#qualiFilterTo').val();
	//var sourceFilter = $('#sourceFilter').val();
	var sourceFilter = '';
	var fctc = $('#fctc').val();
	var tctc = $('#tctc').val();
	var noPos = $('#noPos').val();
	var fexp = $('#workExp').val();
	var texp = '';
	var canjobid = $('#canJobId').val();
	/* for condition check */
	
	var reg1 = $('#reg1').val();
	  var totalVa  = $('#totalVa').val();
	/* end */
	
	 
	if(temFilter==""){
		$('#uniform-temFilter').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-temFilter').offset().top - 100, 500);
		return false;
	}else if(ageFrom==""){
		$('#uniform-ageFrom').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-ageFrom').offset().top - 100, 500);
		return false;
	}else if(ageTo==""){
		$('#uniform-ageTo').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-ageTo').offset().top - 100, 500);
		return false;
	}else if(Type==""){
		$('#uniform-Type').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-Type').offset().top - 100, 500);
		return false;
	}else if(businessFilter==""){
		$('#uniform-businessFilter').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-businessFilter').offset().top - 100, 500);
		return false;
		
	}else if(subbusinessFilter==""){
		$('#uniform-subbusinessFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-subbusinessFilter').offset().top - 100, 500);
		return false;
		
	}else if(ssbusinessFilter==""){
		$('#uniform-ssbusinessFilter').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-ssbusinessFilter').offset().top - 100, 500);
		return false;
	}else if(segmentFilter==""){
		$('#uniform-segmentFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-segmentFilter').offset().top - 100, 500);
		return false;
	}

	else if(zoneFilter==""){
		$('#uniform-zoneFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-zoneFilter').offset().top - 100, 500);
		return false;
	}
	else if(regionFilter==""){
		$('#uniform-regionFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-regionFilter').offset().top - 100, 500);
		return false;
	}
	else if(stateFilter==""){
		$('#uniform-stateFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-stateFilter').offset().top - 100, 500);
		return false;
	}
	else if(cityFilter==""){
		$('#uniform-cityFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-cityFilter').offset().top - 100, 500);
		return false;
	}
	else if(posFilter==""){
		$('#uniform-posFilter').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-posFilter').offset().top - 100, 500);
		return false;
	}
	else if(qualiFilterFrom==""){
		$('#uniform-qualiFilterFrom').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-qualiFilterFrom').offset().top - 100, 500);
		return false;
	}
	else if(qualiFilterTo==""){
		$('#uniform-qualiFilterTo').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#uniform-qualiFilterTo').offset().top - 100, 500);
		return false;
	}
	// else if(sourceFilter==""){
	// 	$('#uniform-sourceFilter').addClass('error');
	// 	$("html").getNiceScroll(0).doScrollTop($('#uniform-sourceFilter').offset().top - 100, 500);
	// 	return false;
	// }

	else if(fexp==""){
		
		$('#uniform-workExp').addClass('error');
		
		$("html").getNiceScroll(0).doScrollTop($('#uniform-workExp').offset().top - 100, 500);
		return false;
	}
	// else if(texp==""){
	// 	$('#uniform-texp').addClass('error');
		
	// 	$("html").getNiceScroll(0).doScrollTop($('#uniform-texp').offset().top - 100, 500);
	// 	return false;
	// }
	else if(fctc==""){
		$('#fctc').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#fctc').offset().top - 100, 500);
		return false;
	}else if(tctc==""){
		$('#tctc').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#tctc').offset().top - 100, 500);
		return false;
	}
	
	else if(noPos==""){
		$('#noPos').addClass('error');
		$("html").getNiceScroll(0).doScrollTop($('#noPos').offset().top - 100, 500);
		return false;
	}

	// else if(noPos > temp1){
 //         alert('Remaining Count Should not be greater than number of opening');
 //         return false;
         
 //      }
 //      else if(noPos > reg1){
 //         alert('Remaining Count Should not be greater than number of opening');
 //         return false;
         
 //      }
	else{

			var encrptText = JSON.stringify(dDate+'=**='+temFilter+'=**='+businessFilter+'=**='+subbusinessFilter+'=**='+ssbusinessFilter+'=**='+segmentFilter+'=**='+zoneFilter+'=**='+regionFilter+'=**='+stateFilter+'=**='+cityFilter+'=**='+posFilter+'=**='+qualiFilterFrom+'=**='+sourceFilter+'=**='+fctc+'=**='+tctc+'=**='+noPos+'=**='+fexp+'=**='+texp+'=**='+canjobid+'=**='+ageFrom+'=**='+ageTo+'=**='+Type+'=**='+qualiFilterTo);
			var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
			$('#loading').show();
			$.ajax({
			type: "POST",
			url: "ajax/editopenings"+extension, 
			data: {
			valJson : valJson
			},
			success: function(data){
			$('#loading').hide();
			var res = base64_decode(data);
			var result = res.split('=**=');
			
			if($.trim(result[0]) =="Y"){
				$('#successBox p').html(result[1]);
				$('#successBox').show().delay(3000).fadeOut(1000);
				setTimeout(function() {
				window.location.href = 'mrf'+extension;
				}, 4000);
			}else
			{
				$('#alertBox p').text('Please try again later');
				$('#alertBox').show().delay(3000).fadeOut(1000);
			}
			
			}
			});
			
	
	}
	
}

// getState
function getState() {
	
	var regionId = []; 
	$('#selRegion :selected').each(function(i, selected){ 
		regionId[i] = $(selected).val();
	});

	var encrptText = JSON.stringify(regionId+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/statelist"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		$('#loading').hide();
		 $("#selState").html(data);

		 $('#selState').multiselect('rebuild');
		
		}
		
	});
	
}

// getCity
function getCity() {
	
	var stateId = []; 
	$('#selState :selected').each(function(i, selected){ 
		stateId[i] = $(selected).val();
	});

	var encrptText = JSON.stringify(stateId+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/cityList2"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		$('#loading').hide();
		 $("#selCity").html(data);

		$('#selCity').multiselect('rebuild');
		
		}
		
	});
	
}

// getState1
function getState1() {

	var regionId = $('#zoneFilter').val();
	var encrptText = JSON.stringify(regionId+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/statelist"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		$('#loading').hide();
		 $("#stateFilter").html(data);
 $('#stateFilter').selectpicker('refresh');
		}
		
	});
	
}


//getState2()
function getState2() {

	var regionId = $('#zoneFilter option:selected').val();
	var categoryId = $('#businessFilter option:selected').val();

	var encrptText = JSON.stringify(regionId+'=**='+categoryId+'=**=');
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/statelist1"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		$('#loading').hide();
		 $("#stateFilter").html(data);
		// $('#stateFilter').selectpicker('refresh');
		 	 $.uniform.update("#stateFilter");
		}
		
	});
	
}

function getHiringManger() {
	stateId = $('#stateFilter option:selected').val();
	categoryId = $('#businessFilter option:selected').val();
	regionId = $('#zoneFilter option:selected').val();
	cityFilter = $('#cityFilter option:selected').val();
	
	var encrptText = JSON.stringify(stateId+'=**='+categoryId+'=**='+regionId+'=**='+cityFilter+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/hiringList"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		$('#loading').hide();
		 $("#hiringFilter").html(data);
		   $.uniform.update("#hiringFilter");
		}
		
	});
}

// getCity1
function getCity1() {
	
	stateId = $('#stateFilter').val();
	categoryId = $('#businessFilter option:selected').val();
	regionId = $('#zoneFilter option:selected').val();
	var encrptText = JSON.stringify(stateId+'=**='+categoryId+'=**='+regionId+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	$('#loading').show();
	$.ajax({
		type: "POST",
		url: "ajax/cityList"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		$('#loading').hide();
		 $("#cityFilter").html(data);
		   $.uniform.update("#cityFilter");
		}
		
	});
	
}

// getClient
function getClient(){
		comFilter = $('#comFilter').val();
		clientCode = $('#clientcodeFilter').val();
	
	var encrptText = JSON.stringify(comFilter+'=**='+clientCode);
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		type: "POST",
		url: "ajax/clientlist4"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		
		 $("#clientFilter").html(data);
		  $.uniform.update("#clientFilter");

		
		}
		
	});
}