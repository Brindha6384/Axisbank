var ext = window.location.pathname.split('.').pop();
var extension;

if($.trim(ext) == 'php') {
	extension = ".php";
}
else {
	extension = "";
}
function mrflist(){
    $('#mrflist').addClass("active");
    $('#mrfdel').removeClass("active");
    loadMrf(1);
}

function mrfdelete(){
    $('#mrflist').removeClass("active");
    $('#mrfdel').addClass("active");
    loadMrfdel(1);
}


function loadMrf(pgeNo) {
	
    //var posFilter = '';
	var comFilter = $('#comFilter').val();
    var posFilter = $('#posFilter').val();
    var catFilter = $('#catFilter').val();
    var clientFilter = $('#clientFilter').val();
   	var dateFilter = $('#dateFilter').val();
   	var expId = $('#expFilter').val();
    var cityFilter = $('#cityFilter').val();
    var execFilter = $('#execFilter').val();



    var regionId = [],stateId = []; 
    $('#regionFilter :selected').each(function(i, selected){ 
        regionId[i] = $(selected).val();
    });

    var stateId = []; 
    $('#stateFilter :selected').each(function(i, selected){ 
        stateId[i] = $(selected).val();
    });

	
	var pageNo = pgeNo;
	var searchKeyword = "";

	if(dateFilter == "today"){
		var today = moment();
		var toDate = today.format('YYYY-MM-DD');
		var fromDate = today.format('YYYY-MM-DD');
		
	}else if(dateFilter == "yesterday"){
		var today = moment();
		var yesterday = moment().subtract(1,'days');
		var toDate = yesterday.format('YYYY-MM-DD');
		var fromDate = yesterday.format('YYYY-MM-DD');
		
	}else if(dateFilter == "last7"){
		var today = moment();
		var last7 = moment().subtract(6,'days');
		var toDate = today.format('YYYY-MM-DD');
		var fromDate = last7.format('YYYY-MM-DD');
		
	}else if(dateFilter == "last30"){
		var today = moment();
		var last30 = moment().subtract(29,'days');
		var toDate = today.format('YYYY-MM-DD');
		var fromDate = last30.format('YYYY-MM-DD');
		$("#defaulttext").html('');
	}else if(dateFilter == "custom"){
		var today = moment();
		var toDate = $('#toDate').val();
		var fromDate = $('#fromDate').val();
		
	}else if(dateFilter == "thismonth"){
		var today = moment();
		var toDate = moment().endOf('month').format('YYYY-MM-DD');;
		var fromDate = moment().startOf('month').format('YYYY-MM-DD');;
		
	}else if(dateFilter == "lastmonth"){
		var today = moment();
		var toDate = moment().subtract(1,'months').endOf('month').format('YYYY-MM-DD');
		var fromDate = moment().subtract(1,'months').startOf('month').format('YYYY-MM-DD');
		
	}else{
		var today = moment();
		var toDate = "";
		var fromDate = "";
		
	}
	
	$('#loading').show();
	var encrptText = JSON.stringify(tabType + '=**=' + comFilter + '=**=' + posFilter + '=**=' + catFilter + '=**=' + clientFilter + '=**=' +cityFilter+'=**='+expId+'=**='+toDate+'=**='+fromDate+'=**='+pageNo+'=**='+regionId+'=**='+stateId+'=**='+execFilter+'=**='+searchKeyword);
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		type: "POST",
		url: "ajax/mrf"+extension+"?page=mrflist", 
		data: {
				valJson:valJson
			},
		success: function(data){
			     var result = base64_decode(data);
				$('#tabResults').html(result);
				$('#loading').hide();
				pagination();
                $('[data-toggle="tooltip"]').tooltip();   
		}
	});
}



function loadMrfdel(pgeNo) {
    //var posFilter = '';
	var comFilter = $('#comFilter').val();
    var posFilter = $('#posFilter').val();
    var catFilter = $('#catFilter').val();
    var clientFilter = $('#clientFilter').val();
   	var dateFilter = $('#dateFilter').val();
   	var expId = $('#expFilter').val();
    var cityFilter = $('#cityFilter').val();
    var execFilter = $('#execFilter').val();

    var regionId = [],stateId = []; 
    $('#regionFilter :selected').each(function(i, selected){ 
        regionId[i] = $(selected).val();
    });

    var stateId = []; 
    $('#stateFilter :selected').each(function(i, selected){ 
        stateId[i] = $(selected).val();
    });

	
	var pageNo = pgeNo;
	var searchKeyword = "";

	if(dateFilter == "today"){
		var today = moment();
		var toDate = today.format('YYYY-MM-DD');
		var fromDate = today.format('YYYY-MM-DD');
		
	}else if(dateFilter == "yesterday"){
		var today = moment();
		var yesterday = moment().subtract(1,'days');
		var toDate = yesterday.format('YYYY-MM-DD');
		var fromDate = yesterday.format('YYYY-MM-DD');
		
	}else if(dateFilter == "last7"){
		var today = moment();
		var last7 = moment().subtract(6,'days');
		var toDate = today.format('YYYY-MM-DD');
		var fromDate = last7.format('YYYY-MM-DD');
		
	}else if(dateFilter == "last30"){
		var today = moment();
		var last30 = moment().subtract(29,'days');
		var toDate = today.format('YYYY-MM-DD');
		var fromDate = last30.format('YYYY-MM-DD');
		$("#defaulttext").html('');
	}else if(dateFilter == "custom"){
		var today = moment();
		var toDate = $('#toDate').val();
		var fromDate = $('#fromDate').val();
		
	}else if(dateFilter == "thismonth"){
		var today = moment();
		var toDate = moment().endOf('month').format('YYYY-MM-DD');;
		var fromDate = moment().startOf('month').format('YYYY-MM-DD');;
		
	}else if(dateFilter == "lastmonth"){
		var today = moment();
		var toDate = moment().subtract(1,'months').endOf('month').format('YYYY-MM-DD');
		var fromDate = moment().subtract(1,'months').startOf('month').format('YYYY-MM-DD');
		
	}else{
		var today = moment();
		var toDate = "";
		var fromDate = "";
		
	}
	
	$('#loading').show();
	var encrptText = JSON.stringify(tabType + '=**=' + comFilter + '=**=' + posFilter + '=**=' + catFilter + '=**=' + clientFilter + '=**=' +cityFilter+'=**='+expId+'=**='+toDate+'=**='+fromDate+'=**='+pageNo+'=**='+regionId+'=**='+stateId+'=**='+execFilter+'=**='+searchKeyword);
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		type: "POST",
		url: "ajax/mrf"+extension+"?page=mrfdel", 
		data: {
				valJson:valJson
			},
		success: function(data){
			     var result = base64_decode(data);
				$('#tabResults').html(result);
				$('#loading').hide();
				pagination();
                $('[data-toggle="tooltip"]').tooltip();   
		}
	});
}




function loadMrf1(pgeNo) {
    var tabType = "";
    var comFilter = "";
    var posFilter = "";
    var catFilter = "";
    var clientFilter = "";
    var dateFilter = "";
    var expId = "";
    var cityFilter = "";
    var execFilter = "";

    var regionId = ''; 
    var stateId = ''; 
    var toDate = '';
    var fromDate = '';
    
    var pageNo = pgeNo;
    var searchKeyword = $('#searchKeyword').val();;

    
    $('#loading').show();
    var encrptText = JSON.stringify(tabType + '=**=' + comFilter + '=**=' + posFilter + '=**=' + catFilter + '=**=' + clientFilter + '=**=' +cityFilter+'=**='+expId+'=**='+toDate+'=**='+fromDate+'=**='+pageNo+'=**='+regionId+'=**='+stateId+'=**='+execFilter+'=**='+searchKeyword);
    
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
    
    $.ajax({
        type: "POST",
        url: "ajax/mrf"+extension, 
        data: {
                valJson:valJson
            },
        success: function(data){
            var result = base64_decode(data);
                $('#tabResults').html(result);
                $('#loading').hide();
                pagination('search');
                $('[data-toggle="tooltip"]').tooltip();   
        }
    });
}


function delete_mrf(id){

    var jobid = base64_decode(id);

    var res_id = jobid.split('=**=');
    
    var encrptText = JSON.stringify(res_id+'=**=');
    
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
    
    $.ajax({
        type: "POST",
        url: "ajax/del_mrf"+extension, 
        data: {
            valJson : valJson
        },
        success: function(data){
        
         $('#remMRF .md-content').html(data);
            openPopup('remMRF');
        
        }
        
    });
}

function delete_mrfList(id) {
    
    var res = base64_decode(id);
    var results = res.split('=**=');

    var encrptText = JSON.stringify(results[0] + '=**=');
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

    $('#poploading').show();
    $.ajax({
        type: "POST",
        url: "ajax/delMRF" + extension,
        data: {
            valJson: valJson
        },
        success: function(data) {
          
            $('#remMRF .md-content').html('');
            closePopup('remMRF');
             $('#poploading').hide();
            $("#app_list_" + results[0]).remove();
            if($.trim(data) == 'Y'){
                $('#successBox p').text('MRF List Removed Sucessfully!');
                $('#successBox').show().delay(3000).fadeOut(1000);
                  setTimeout(function() {
                        window.location.href = 'mrf' + extension;
                    }, 4000);
            }
            else{
                $('#errorMsg').text('Please Try again later');
                $('#alertBox').show().delay(3000).fadeOut(1000);
            }
        }
    });

}



function revokeMrf(id){

    var jobid = base64_decode(id);

    var res_id = jobid.split('=**=');
    
    var encrptText = JSON.stringify(res_id+'=**=');
    
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
    
    $.ajax({
        type: "POST",
        url: "ajax/revoke_mrf"+extension, 
        data: {
            valJson : valJson
        },
        success: function(data){
        
         $('#revMRF .md-content').html(data);
            openPopup('revMRF');
        
        }
        
    });
}

function MRFRevoke(id) {
    
    var res = base64_decode(id);
    var results = res.split('=**=');

    var encrptText = JSON.stringify(results[0] + '=**=');
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

    $('#poploading').show();
    $.ajax({
        type: "POST",
        url: "ajax/revMRF" + extension,
        data: {
            valJson: valJson
        },
        success: function(data) {
          
            $('#revMRF .md-content').html('');
            closePopup('revMRF');
            $('#poploading').hide();
            if($.trim(data) == 'Y'){
                $('#successBox p').text('MRF Revoked Sucessfully!');
                $('#successBox').show().delay(3000).fadeOut(1000);
                  setTimeout(function() {
                        window.location.href = 'mrf' + extension;
                    }, 4000);
            }
            else{
                $('#errorMsg').text('Please Try again later');
                $('#alertBox').show().delay(3000).fadeOut(1000);
            }
        }
    });

}

function getSubCat() {
		
	var CategoryId = $('#catFilter').val();
	
	var encrptText = JSON.stringify(CategoryId+'=**=');
	
	var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
	
	$.ajax({
		type: "POST",
		url: "ajax/subcategorylist1"+extension, 
		data: {
			valJson : valJson
		},
		success: function(data){
		
		 $("#indfilCont").html(data);
		 $("#indFilter").uniform();
		 
		
		}
		
	});
	
}

function applyFilter() {
	
	
    var userRegionId = []; 
    $('#regionFilter :selected').each(function(i, selected){ 
        userRegionId[i] = $(selected).val();
    });
  
        if((userRegionId.length)<1){
        $('#regionFilter').next('.btn-group').find('button.multiselect').addClass('error');
        $('#regionFilter').next('.btn-group').find('button.multiselect').trigger('click');
        $("html").getNiceScroll(0).doScrollTop($('#regionFilter').offset().top - 150, 500);
        return false;
    }

    loadMrf(1);
    $(".clrFilter").show();
}
function pagination(id) {
    $('.paginationNew a').click(function(e) {
        var selPage = $(this).attr("data-page");
        var sType = $("#ser-id-page").val();
        if (sType == 'N') {
            loadMrf(selPage);
        } else {
            loadMrf1(selPage);
        }

        $("html").getNiceScroll(0).doScrollTop($('.content-block').offset().top - 100, 500);
    });
}

function getState() {
    
    var regionId = []; 
    $('#regionFilter :selected').each(function(i, selected){ 
        regionId[i] = $(selected).val();
    });

    
    
    var encrptText = JSON.stringify(regionId+'=**=');
    
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
    
    $.ajax({
        type: "POST",
        url: "ajax/statelist"+extension, 
        data: {
            valJson : valJson
        },
        success: function(data){
        
         $("#stateFilter").html(data);

         $('#stateFilter').multiselect('rebuild');
        
        }
        
    });
    
}


 
function getCity() {

    var stateId = []; 
    $('#stateFilter :selected').each(function(i, selected){ 
        stateId[i] = $(selected).val();
    });


    var encrptText = JSON.stringify(stateId+'=**=');
    
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
    
    $.ajax({
        type: "POST",
        url: "ajax/cityList1"+extension, 
        data: {
            valJson : valJson
        },
        success: function(data){
        
         $("#cityFilter").html(data);

         $('#cityFilter').select2('refresh');
        
        }
        
    });

    
}
function getClient1() {

    var comId = $('#comFilter').val();

    var encrptText = JSON.stringify(comId + '=**=');

    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

    $.ajax({
        type: "POST",
        url: "ajax/clientlist3" + extension,
        data: {
            valJson: valJson
        },
        success: function(data) {

            $("#clientFilter").html(data);
            $("#clientFilter").selectpicker('refresh');
            
            getPosition1();
        }

    });

}

// function getPosition1() {
   
//     var CompanyId = $('#comFilter').val();
//     var ClientId = $("#clientFilter").val();
//     var encrptText = JSON.stringify(CompanyId + '=**=' + ClientId + '=**=');

//     var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

//     $.ajax({
//         type: "POST",
//         url: "ajax/getposition1" + extension,
//         data: {
//             valJson: valJson
//         },
//         success: function(data) {
//             $("#posFilter").html(data);
//             $('#posFilter').selectpicker('refresh');

//         }

//     });

// }

function pickassociate(id) {
    var res = base64_decode(id);
    var results = res.split('=**=');

    $('#loading').show();

    var encrptText = JSON.stringify(results[0] + '=**=' + results[1] + '=**='+ results[2] + '=**=');

    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

    $.ajax({
        type: "POST",
        url: "ajax/fillassociatemandate" + extension,
        data: {
            valJson: valJson
        },
        success: function(data) {
            $('#loading').hide();
            $('#pickassociate .md-content').html(data);
            $('#lead_associate_id').uniform();
        }
    });

    openPopup('pickassociate');
}

function updateassociate(id) {

    var res = base64_decode(id);
    var results = res.split('=**=');
     var uid = $('#lead_associate_id').val();
    var uname = $('#lead_associate_id option:selected').text();

    $('#loading').show();

    var encrptText = JSON.stringify(results[0] + '=**=' + uid + '=**=' + uname + '=**=');

    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

    $.ajax({
        type: "POST",
        url: "ajax/updateassociatemandate" + extension,
        data: {
            valJson: valJson
        },
        success: function(data) {
            $('#loading').hide();
            closePopup('pickassociate');
            id = base64_encode(results[0] + '=**=' + results[1] + '=**=')
                //init();
            $('#associatelist_' + results[0]).html(uname + " | <a href=\"javascript:;\" onClick=\"pickassociate('" + id + "')\">Assign</a></span>");
        }
    });
}

function loadExe(){
    
    var comFilter = $('#comFilter').val();
    var ClientId = $("#clientFilter").val();
    var encrptText = JSON.stringify(comFilter+'=**='+ClientId);
    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', {format: CryptoJSAesJson}).toString();
    $.ajax({
        type: "POST",
        url: "ajax/recuriterlist"+extension, 
        data: {
                valJson:valJson
            },
        success: function(data){
            $("#execFilter").html(data);
            $.uniform.update("#execFilter");
            
        }
    });
}

function uploadMandate(){
	
	$('#uploadDialog .md-content').html('');
	
	
	$.ajax({
		type: "POST",
		url: "ajax/uploadMandate"+extension, 
		data: {
			
		},
		success: function(data){
			
			$('#uploadDialog .md-content').html(data);
			openPopup('uploadDialog');
			$('#mandate_compnay').uniform();

			 $('#mandate_compnay').on('change',function(){
  var mandate_compnay =  $('#mandate_compnay').val();
    if(mandate_compnay!=""){
      $('#uniform-mandate_compnay').removeClass('error');
    }
});
		}
	});
}

function manbulkup(){
	var manCan = $('#mandate_compnay').val();
	var manFile = $('#manbulkhidden').val();

	if(manCan==""){
		$('#uniform-mandate_compnay').addClass('error');
		return false;
	}else if(manFile==""){
		alert('Select CSV file');
		return false;
	}else{

		$('#poploading').show();

    var encrptText = JSON.stringify(manCan + '=**=' + manFile );

    var valJson = CryptoJS.AES.encrypt(encrptText, '&asd$#nd%3424ndfdsj', { format: CryptoJSAesJson }).toString();

    $.ajax({
        type: "POST",
        url: "ajax/mandatebulkupload" + extension,
        data: {
            valJson: valJson
        },
        success: function(data) {
        	
             setTimeout( function() {
             	$('#poploading').hide();
            	 closePopup('uploadDialog');
				}, 2000);

             setTimeout( function() {
             		$('#successBox p').text('File updated successfully, status will be send via email');
    		$('#successBox').show().delay(3000).fadeOut(1000);
				}, 2000);

             setTimeout( function() {
             			loadOpenings(1);
				}, 3000);

     		
            
           
        }
    });
	}
}

function searchPhonenumber() {

    var searchKeyword = $('#searchKeyword').val();
    $("#ser-id-page").val('Y');
    if (searchKeyword == "") {
        $('#searchKeyword').focus();
        exit;
    } else {
        $('.dash-filter').hide();
        $('.filter-container h1').html('Search results for <span>' + searchKeyword + '</span>');
        $(".clrFilter1").show();
        loadMrf1(1);

    }
}
