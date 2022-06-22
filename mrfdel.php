<?php
include("config.php");
$pageName="mrfdel";
if(empty($_SESSION['BFLUserId']) && empty($_SESSION['BFLUserToken']) || $_SESSION['BFLUserMrf']=="N") {
	header("Location: logout".$extension);
	exit;
}
include("boardingFilter.php");


?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>MRF - Qconnect-Axis Bank</title>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="icon" href="images/favicon.ico" />

<link href="css/partner.css?v=<?php echo $cssversion;?>" rel="stylesheet" type="text/css">
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/fonts.css" rel="stylesheet" type="text/css">
<link href="css/font-icon.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/animate.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="css/bootstrap1.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/popup.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
<link rel="stylesheet" type="text/css" href="css/datetimepicker.css" />
<link rel="stylesheet" href="css/tinyscrollbar.css" type="text/css" />
<!-- <link rel="stylesheet" type="text/css" href="css/tooltip-classic.css" />
<link rel="stylesheet" type="text/css" href="css/tooltip.css" /> -->
<link href="css/bootstrap-select.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/jasny-bootstrap.css" type="text/css" />
 <link href="css/select2.css" rel="stylesheet" type="text/css">


<!-- <script>window.jQuery || document.write('<script src="js/jquery-3.3.1.js"><\/script>')</script> -->
<script>window.jQuery || document.write('<script src="js/jquery-3.3.1.js"><\/script>')</script>
<script src="js/fontsmoothie.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/aes.js"></script>
<script type="text/javascript" src="js/aes-json-format.js"></script>
</head>

<body>
    <input type="hidden" name="ser-id-page" id="ser-id-page" value="N">
    <div id="alertBox" class="alertBox">
    <div class="alert alert-block alert-danger fade in">
        <span id="errorMsg">Phone number already exits!!</span>
    </div>
</div>
<div id="successBox" class="alertBox">
    <div class="alert alert-success alert-block fade in">
        <h4>Success!</h4>
        <p></p>
    </div>
</div>
<div id="container">
	<header class="header">
		<?php include("header.php"); ?>
    </header>
    <div id="main-content">
    	<div class="wrapper">
         
        <div class="content-block">
        	<div class="dashTab"  style="display: none; background: none !important; ">
            <div class="filter-bxshadow">
                 
                 <div class="search_hfright">
                   <div class="searchCon clearfix">
                   <!--  <a href="mrf<?php echo $extension;?>" class="clrFilter1 clrFilter_new" style="display:none;"><img src="images/clear_search_icon.png" /></a> -->
                <div class="coupn_search clearfix"><div class="remove"><a href="mrf<?php echo $extension;?>" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a></div><input type="text" value="" name="searchKeyword" id="searchKeyword" onkeydown="if(event.keyCode == 13){ searchPhonenumber()}" class="srch_txtbox" placeholder="Search by MRF ID" ><a href="javascript:;" title="Search by MRF ID"></a></div><a href="javascript:;" class="list-search"  onClick="searchPhonenumber();"><i class="fas fa-search"></i>&nbsp;&nbsp;Search</a></div></div>
               
            	<div class="filter-container">
                
                <div class="dash-filter">
                    <h1 class="filterup">Filter by</h1>
                   
                     <div class="filter-text1">
                 <div id="regionList" style="position: relative;">
                            <select id="regionFilter" name="regionFilter[]" class="styled" multiple="multiple" onchange="getState();">
                                <?php
                    for($rt = 0; $rt < count($regionList); $rt++) {?>
                                <option value="<?php  echo $regionList[$rt]->RegionId;?>"><?php  echo $regionList[$rt]->RegionName;?></option>
                                 <?php }?> 
                        </select>
                        </div>
                </div>

                <div class="filter-text1">
                 <div id="stateList" style="position: relative;" >
                            <select id="stateFilter" name="stateFilter[]" class="styled sfilter" multiple="multiple" onchange="getCity();">
                                
                        </select>
                        </div>
                </div>
                 <div class="filter-text2">
                      <select class="js-example-basic-single" id="cityFilter" name="cityFilter"  style="width: 135px;">
                    <option value="">Branch</option>
      
                </select>
                            
                </div>
                
                 <div class="filter-text1" style="display: none;">
                            <select id="posFilter" name="posFilter" data-live-search="true" class="selectpicker styled">
                                <option value="">Designation</option>
                               
                        </select>
                </div>
                <div class="filter-text">
    <select id="dateFilter" name="dateFilter" class="styled">
                    <option value="all" selected>All Time</option>
                    <option value="today" >Today</option>
                    <option value="yesterday">Yesterday</option>
                    <option value="last7">Last 7 Days</option>
                    <option value="last30">Last 30 Days</option>
                    <option value="thismonth">This Month</option>
                    <option value="lastmonth">Last Month</option>
                    <option value="custom">Custom</option>


                </select>
                
    <div class="dateMenuBox jobsdate">
        <div class="dropdown-menudate extended notification">
          <a href="javascript:;" class="custom-date-btn"  onClick="applyDateFilter('add')">Apply</a>
            <div class="clear"></div>
            <div class="custom-filter-wrapper" id="custom-filter-wrapper">
                <input type="text" id="fromDate" name="fromDate" class="custom-filter-textbox" placeholder="YY-MM-DD">
                <span class="custom-date-seperator">to</span>
                <input type="text" id="toDate" name="toDate" class="custom-filter-textbox" placeholder="YY-MM-DD">
            </div>
        </div>
    </div>
</div>
                <div class="filter-text filter-right">
                    <a href="javascript:;" class="filterBtn" data-toggle="tooltip" title="Kindly Select the Region, State, Location and Date range to apply the filter" data-placement="bottom" onClick="applyFilter();">Filter</a>
                </div>
                
                <a href="mrf<?php echo $extension;?>" class="clrFilter" style="display:none;">Clear All</a>
               
                
                  <div class="filter-text1" style="display: none;">
                            <select id="catFilter" name="catFilter" data-live-search="true" class="selectpicker styled">
                                <option value="">Category</option>
                               <?php for($cat=0;$cat<count($catList);$cat++){?>
                                 <option value ="<?php echo $catList[$cat]->CategoryId;?>"><?php echo $catList[$cat]->CategoryName;?></option>
                                <?php }?> 
                        </select>
                </div>
                <div class="filter-text" style="display: none;">
                            <select id="expFilter" name="expFilter" class="styled">
                                <option value="">Experience</option>
                                 <option value="-0">Fresher</option>
                                 <option value="1-2">1 to 2 yrs</option>
                                <option value="2-4">2 to 4 yrs</option>
                                 <option value="4-6">4 to 6 yrs</option>
                                  <option value="5-7">5 to 7 yrs</option>
                                  <option value="7-50">7+ yrs</option>
                        </select>
                </div>
                
         <div class="clear"></div>  

                  </div>
                  </div>
                    <div class="clear"></div>
                </div>
                </div>
                
                <div class="dashContainer dash_bg" id="tabResults">
                	<div id="loading" class="loading">
                    	<div class="loader">Loading...</div>
                    </div>
                    
                   
                    
                </div>
            </div>
           
        </div>
    </div>
    <?php include("footer.php"); ?>
</div>

<div class="md-modal md-effect-1" id="uploadDialog" style="max-width: 400px !important;width:400px !important;overflow:hidden;">
    <div class="md-content">
         
    </div>
</div>
<div class="md-modal md-effect-1" id="remMRF" style="max-width: 400px !important;width:400px !important;overflow:hidden;">
    <div class="md-content">
         
    </div>
</div>
<div class="md-modal md-effect-1" id="revMRF" style="max-width: 400px !important;width:400px !important;overflow:hidden;">
    <div class="md-content">
         
    </div>
</div>
<div class="md-overlay"></div>
<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.uniform-3.3.1.js"></script>
<!-- <script type="text/javascript" src="js/jquery.uniform-3.3.1.js"></script> -->
<script type="text/javascript" src="js/bootstrap-datepicker1.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript" src="js/modalEffects.js"></script>
<script type="text/javascript" src="js/jquery.tinyscrollbar.js"></script>
<script type="text/javascript" src="js/common.js"></script>
<!-- <script type="text/javascript" src="js/mrfdel.js"></script> -->
<script type="text/javascript" src="js/mrf.js?v=<?php echo $cssversion;?>"></script>
<script src="js/bootstrap-select.js" type="text/javascript"></script>
<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css">
<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>
<script src="js/select2.js" type="text/javascript"></script>
<style>
#uniform-cityFilter span {
       width:121px !important; 
    }
</style>
<script type="text/javascript">


$(document).ready(function(e) {
  //$('.filterBtn').hide();
    // $('#regionFilter').change(function(){
    //    var regF = $('#regionFilter option:selected').text();
     
    //    if(regF == 'NorthSouthEastWestCentral'){
    //     $('.filterBtn').text('applyFilter');
    //    }
    //    else{
    //    // $('.filterBtn').hide();
    //    }
    // });
    loadMrfdel(1);
	$('select').not('#comFilter,#clientFilter,#posFilter,#catFilter').uniform();
   
    $("#comFilter,#clientFilter,#posFilter,#catFilter").selectpicker();
   $('.dashTab').show().delay(4000);
 
    $('#regionFilter').multiselect({
        buttonWidth: '180px',   
        maxHeight: 200,
        nonSelectedText: 'Region',
        numberDisplayed: 2,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        allSelectedText: 'All Regions',
        selectAllNumber: false,
        onChange: function(option, checked, select) {
      $('span.form-error-msg').hide();
      $('#regionFilter').next('.btn-group').find('button.multiselect').removeClass('error');
    }
    });
    $('#stateFilter').multiselect({
        buttonWidth: '180px',   
        maxHeight: 200,
        nonSelectedText: 'State',
        numberDisplayed: 2,
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        allSelectedText: 'All States',
        selectAllNumber: false
    });
    
	
});
    $('#dateFilter').change(function(e) {
        
        var selVal = $('#dateFilter option:selected').text();
        if($.trim(selVal) == 'Custom') {
            $('.dateMenuBox').removeClass('fadeOutDown').show().addClass('fadeInUp');
            $('#custom-filter-wrapper').show();
        }
        else {
            $('.dateMenuBox').addClass('fadeOutDown').hide().removeClass('fadeInUp');;
            $('#custom-filter-wrapper').hide();
            $('#fromDate').val('');
            $('#toDate').val('');
            
            
        }
        
        
    });
    
    $('#dateFilter').click(function(e) {
        var selVal = $('#dateFilter option:selected').text();
        if($.trim(selVal) == 'Custom') {
            $('.dateMenuBox').removeClass('fadeOutDown').show().addClass('fadeInUp');
            $('#custom-filter-wrapper').show();
        }
    });
    $('#fromDate, #toDate').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true 
    });

function applyDateFilter(action) {
    $('.dateMenuBox ').hide();
        loadMrfdel(1);
        $(".clrFilter").show();
        
}




</script>
</body>
</html>