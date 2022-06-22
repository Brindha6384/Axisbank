<?php

$activeclass = 'active';

$menuUrl = $service_domain."user/getmenuaccess";
$menuPostArray = array("LoginId" => $_SESSION['BFLUserId']);

$subPostArray = array_merge($menuPostArray, $commonPostArray);
$jsonval = json_encode($subPostArray);
$encVar = helprenc($jsonval);
$appArray = array("HepUId" => $encVar);
$appData = getData($menuUrl, $appArray);
$appJson = json_decode($appData);
$appResult = json_decode(helprdec($appJson->result));
$menuJson = $appResult->MenuSetting;

$admin = 'admin';
// echo "<pre>";
// print_r($appResult);
// exit;
   
if($appResult->success=='N'){
  header("Location: logout".$extension);
  exit;
}
$edit_flag = $_SESSION["EDITFLAG"];
$dashArray = $menuJson[0]->MenuList;

$dashCount = count($dashArray);

$_SESSION['MenuCheckSess']['Dashboard'] = $dashArray;
if($dashCount>0){
  $_SESSION['BFLUserDashboard'] = "Y";
}else{
  $_SESSION['BFLUserDashboard'] = "N";
}

$MrfArray = $menuJson[1]->MenuList;

$MrfCount = count($MrfArray);
$_SESSION['MenuCheckSess']['Mrf'] = $MrfArray;
if($MrfCount>0){
  $_SESSION['BFLUserMrf'] = "Y";
}else{
  $_SESSION['BFLUserMrf'] = "N";
}


$userArray = $menuJson[2]->MenuList;
$userCount = count($userArray);
$_SESSION['MenuCheckSess']['Usermanagement'] = $userArray;
if($userCount>0){
 $_SESSION['BFLUserManagement'] = "Y";
}else{
 $_SESSION['BFLUserManagement'] = "N";
}

$reportArray = $menuJson[3]->MenuList;
$reportCount = count($reportArray);
$_SESSION['MenuCheckSess']['Report'] = $reportArray;
if($reportCount>0){
  $_SESSION['BFLUserReport'] = "Y";
}else{
  $_SESSION['BFLUserReport'] = "N";
}

$aopArray = $menuJson[4]->MenuList;
$aopCount = count($aopArray);
$_SESSION['MenuCheckSess']['Aop'] = $aopArray;
if($aopCount>0){
 $_SESSION['BFLAop'] = "Y";
}else{
 $_SESSION['BFLAop'] = "N";
}

$canArray = $menuJson[5]->MenuList;
$canCount = count($canArray);
$_SESSION['MenuCheckSess']['Candidate'] = $canArray;
if($canCount>0){
 $_SESSION['BFLCandidate'] = "Y";
}else{
 $_SESSION['BFLCandidate'] = "N";
}

// $fincodeArray = $menuJson[5]->MenuList;
// $fincodeCount = count($fincodeArray);
// $_SESSION['MenuCheckSess']['Fincode'] = $fincodeArray;
// if($fincodeCount>0){
//  $_SESSION['BFLFincode'] = "Y";
// }else{
//  $_SESSION['BFLFincode'] = "N";
// }

// $emailArray = $menuJson[6]->MenuList;
// $emailCount = count($emailArray);
// $_SESSION['MenuCheckSess']['Email'] = $emailArray;
// if($emailCount>0){
//  $_SESSION['BFLEmail'] = "Y";
// }else{
//  $_SESSION['BFLEmail'] = "N";
// }



$cibilVerificationArray = $menuJson[8]->MenuList;
$cibilVerificationCount = count($cibilVerificationArray);
$_SESSION['MenuCheckSess']['CIBILVerification'] = $cibilVerificationArray;
if($cibilVerificationCount>0){
 $_SESSION['BFLCIBILVerification'] = "Y";
}else{
 $_SESSION['BFLCIBILVerification'] = "N";
}

if($dashCount>0){
	
		$linkName = 'dashboard';
		
}
else if($MrfCount>0){
		
		$linkName = 'mrf';
}else if($userCount>0){
		$linkName = 'users';
}else if($aopCount>0){
    $linkName = 'aop';
}else if($fincodeCount>0){
    $linkName = 'fincode';
}else if($emailCount>0){
    $linkName = 'email';
}else if($reportCount>0){
    $linkName = 'downloads';
}else if($cibilVerificationCount>0){
    $linkName = 'cibil-verification';
}else{
	$linkName = 'logout';
}

if($pageName =='addmrf' || $pageName =='addcandidate' || $pageName =='candidate' || $pageName =='editmrf' || $pageName == 'aop_allocate' || $pageName == 'aop-bview'|| $pageName == 'downloads' ||$pageName =='inedge') 
  { 
  $topMenu_hide = "style='display:none;'";
  
 }
 else{
  $topMenu_hide = "style='display:block;'";

 }


?>

<div class="header-top clearfix">
<div class="header-left">
    <a href="<?php echo $linkName.$extension; ?>" class="logo-link"><img src="images/quess_logo.png" alt="Qconnect Axis-Bank" title="Qconnect Axis-Bank"></a>
</div>
<div class="header-right group">
    <ul class="leftMenu group">
     <?php if($dashCount>0){?>
            <li class="<?php if($pageName == 'dashboard') {echo $activeclass;} else {"";}?>" >
            <!-- 	<?php if(in_array('TEMPORARY',$_SESSION['MenuCheckSess']['Dashboard'])){?>
               	 <a href="dashboard<?php echo $extension; ?>" data-toggle="tooltip" title="Dashboard presents complete numerical  count of the MRF, Candidate and the complete count at each stage of onboarding" data-placement="bottom">Dashboard</a>
             <?php } else if(in_array('REGULAR',$_SESSION['MenuCheckSess']['Dashboard'])) {?>
             <a href="dashboard<?php echo $extension; ?>" data-toggle="tooltip" title="Dashboard presents complete numerical  count of the MRF, Candidate and the complete count at each stage of onboarding" data-placement="bottom">Dashboard</a>
             <?php } ?> -->
              <a href="dashboard<?php echo $extension; ?>" data-toggle="tooltip" title="Dashboard presents complete numerical  count of the MRF, Candidate and the complete count at each stage of onboarding" data-placement="bottom">Dashboard</a>
           </li>
            <?php }?>
             <?php if($canCount>0){?>
            <li class="<?php if($pageName == 'candidate' || $pageName == 'candidate-list') {echo $activeclass;} else {"";}?>">
                <?php if(in_array('CANDIDATELIST',$_SESSION['MenuCheckSess']['Candidate'])){?>
                <a href="candidate-list<?php echo $extension; ?>" data-toggle="tooltip" title="" data-placement="bottom">Candidate</a></li>
            <?php }} ?>
             <?php if($aopCount>0){?>
            <li class="<?php if($pageName == 'aop' || $pageName == 'aop-bview' || $pageName == 'aop_allocate' || $pageName == 'inedge') {echo $activeclass;} else {"";}?>" >
              <?php if(in_array('AOP',$_SESSION['MenuCheckSess']['Aop'])){?>
                 <a href="aop<?php echo $extension; ?>" data-toggle="tooltip" title="Annual Operating Plan displays the complete head count to be hired for the present month.Admin can upload the AOP and allot head count for each HM in the system" data-placement="bottom">AOP</a>
             <?php }?>
            </li>
            <?php }?>

            <?php if($MrfCount>0){?> 
            <li class="<?php if($pageName == 'mrf' || $pageName == 'addcandidate' || $pageName == 'editmrf' || $pageName == 'addmrf' || $pageName == 'applicantlist' || $pageName == 'deletemrf') {echo $activeclass;} else {"";}?>" >
              <?php if(in_array('SELECTED',$_SESSION['MenuCheckSess']['Mrf'])){?>
                 <a href="mrf<?php echo $extension; ?>" data-toggle="tooltip" title="Manpower Requisition Form displays the complete designation and the Head count to be hired against each MRF raised" data-placement="bottom">MRF</a>
                 <?php }else if(in_array('OPENINGLIST',$_SESSION['MenuCheckSess']['Mrf'])){?>
                  <a href="openings<?php echo $extension; ?>" >MRF</a>
                  <?php }?>
            </li>
             <?php }?>
             <?php if($MrfCount>0){?> 
            <li class="<?php if($pageName == 'mrf' || $pageName == 'addcandidate' || $pageName == 'editmrf' || $pageName == 'addmrf' || $pageName == 'applicantlist' || $pageName == 'mrfdel') {echo $activeclass;} else {"";}?>" >
              <?php if(in_array('DELETED',$_SESSION['MenuCheckSess']['Mrf'])){?>
                 <a href="mrf<?php echo $extension; ?>" data-toggle="tooltip" title="Manpower Requisition Form displays the complete designation and the Head count to be hired against each MRF raised" data-placement="bottom">MRF</a>
                 <?php }else if(in_array('OPENINGLIST',$_SESSION['MenuCheckSess']['Mrf'])){?>
                  <a href="openings<?php echo $extension; ?>" >MRF</a>
                  <?php }?>
            </li>
             <?php }?>


            <?php if($fincodeCount>0){?>
             <li class="<?php if($pageName == 'fincode') {echo $activeclass;} else {"";}?>" >
                 <a href="fincode<?php echo $extension; ?>" data-toggle="tooltip" title="Fincode to be updated for each onboarded candidate in the Axis Bank application" data-placement="bottom">Fincode</a>
            </li>
            <?php } ?>

             <?php if($emailCount>0){?>
             <li class="<?php if($pageName == 'email') {echo $activeclass;} else {"";}?>" >
                 <a href="email<?php echo $extension; ?>" data-toggle="tooltip" title="Email Ids to be updated for each onboarded candidate in the Axis Bank application" data-placement="bottom">Email</a>
            </li>
            <?php } ?>

       
           
           
           <?php if($userCount>0){?>
            <li class="<?php if($pageName == 'users' || $pageName == 'adduser' || $pageName == 'edituser' || $pageName == 'roles'|| $pageName == 'addrole'|| $pageName == 'editrole' || $pageName == 'newtransfer' || $pageName=="transfers") {echo $activeclass;} else {"";}?>" >
            
            	<a href="users<?php echo $extension; ?>" data-toggle="tooltip" title="User management enables admins to control user access and on-board and off-board users" data-placement="bottom">User Management</a>
              <?php }else if(in_array('RECRUITERMANAGEMENT',$_SESSION['MenuCheckSess']['Usermanagement'])){?>
              <a href="recruiters<?php echo $extension; ?>" title="User Management">User Management</a>
              <?php }?>
            </li>
            
           

            <?php if($reportCount>0){?>
            <li class="<?php if($pageName == 'downloads' || $pageName == 'payroll' || $pageName == 'payrollifmg' || $pageName == 'insurance' || $pageName == 'form11' || $pageName == 'download-applicant' || $pageName == 'profileimage' || $pageName == 'compliance') {echo $activeclass;} else {"";}?>" >
            	 <?php if(in_array('Report',$_SESSION['MenuCheckSess']['Report'])){?>
              <a href="downloads<?php echo $extension; ?>" title="Reports">Reports</a>
              <?php }else if(in_array('PAYROLLDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="payroll<?php echo $extension; ?>" title="Reports">Reports</a>
                <?php }else if(in_array('IFMGPAYROLLDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="payrollifmg<?php echo $extension; ?>" title="Reports">Reports</a>
                <?php }else if(in_array('INSURANCEDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="insurance<?php echo $extension; ?>" title="Reports">Reports</a>
               <?php }else if(in_array('COMPLAINCEDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="compliance<?php echo $extension; ?>" title="Reports">Reports</a>
               <?php }else if(in_array('FORM11DOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="form11<?php echo $extension; ?>" title="Reports">Reports</a>
               <?php }else if(in_array('APPLICANTDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="download-applicant<?php echo $extension; ?>" title="Reports">Reports</a>
               <?php }else if(in_array('PROFILEIMAGEDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
               <a href="download-profileimage<?php echo $extension; ?>" title="Reports">Reports</a>
                <?php }?>
            </li>
            <?php }?>
              <?php if(strtolower($_SESSION['BFLUserType'])== $admin){ ?>
             <?php if($cibilVerificationCount>0){?>
             <li class="<?php if($pageName == 'cibil-verification') {echo $activeclass;} else {"";}?>" >
                 <a href="cibil-verification<?php echo $extension; ?>" data-toggle="tooltip" title="" data-placement="bottom">Verification</a>
            </li>
            <?php }} ?>

             <?php if($masterCount>0){?>
             <li class="<?php if($pageName == 'industry' || $pageName == 'category' || $pageName == 'client'|| $pageName == 'designation'|| $pageName == 'wbs'|| $pageName == 'site' || $pageName == 'state' || $pageName == 'city') {echo $activeclass;} else {"";}?>" >
              <?php if(in_array('STATE',$_SESSION['MenuCheckSess']['Master'])){?>
              <a href="state<?php echo $extension; ?>" title="Master">Master</a>
              <?php }else{?>
               <a href="industry<?php echo $extension; ?>" title="Master">Master</a>
               <?php }?>
            </li>
             <?php }?>

            
        </ul>
</div>
   <div class="header-right-right group">
   
        <div class="header-user-name">
        Hello <span><?php if(!empty($_SESSION['BFLUserName'])) {
                   $custDesc = $_SESSION['BFLUserName'];
                  if(strlen($custDesc) > 20) {
                    echo substr($custDesc, 0, 20).'...';
                  }
                  else {
                    echo $custDesc;
                  }
                  
                }
                else {
                  echo "Admin";
                }
                ?></span><br><a href="logout<?php echo $extension; ?>">Logout</a>
      </div>
            <div class="header-user-img" style="background-image:url(<?php echo $_SESSION['BFLUserImage'];?>);"></div>
  </div>
</div>
<nav id="topMenu" <?php echo $topMenu_hide; ?>>
    		<ul class="submenu">
               <?php if($pageName == 'dashboard') {?>
               <?php if(in_array('REGULAR',$_SESSION['MenuCheckSess']['Dashboard'])){?>
                    <li class="active<?php if($tname == 'regular') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Regular" data-title="regular">Regular</a></li> 
                    <?php }?>
               <!-- <?php if(in_array('TEMPORARY',$_SESSION['MenuCheckSess']['Dashboard'])){?>
                 <li class="<?php if($tname == 'temp') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Temporary" data-title="temp">Temporary(season hire with limited days @ 150/day)</a></li> 
                    <?php }?>
                    
                    <?php if(in_array('MINIMUMWAGES',$_SESSION['MenuCheckSess']['Dashboard'])){?>
                    
                    <li  class="<?php if($tname == 'mwages') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Minimum wages" data-title="mwages">Minimum wages</a></li> 
                  <?php }?>-->
            <?php } ?> 
            <?php if($pageName == 'applicant') {?>
                <?php if(in_array('QUEUE',$_SESSION['MenuCheckSess']['Applicant'])){?>
                <li class="<?php if($tname == 'queue' || $tname == '') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Queue" data-title="queue">Queue</a></li> 
                    <?php }?>
                  <?php if(in_array('SELECTED',$_SESSION['MenuCheckSess']['Applicant'])){?>
                    <li class="<?php if($tname == 'selected') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="MRF List" data-title="selected">MRF List</a></li> 
                    <?php }?>

                   

            <?php }else if($pageName == 'applicantlist') {?>
                
                <li class="<?php if($tname == 'queue' || $tname == '') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Queue" data-title="queue">Queue</a></li> 
                  
                     <li style="display:none;" class="<?php if($tname == 'selected') {echo $activeclass;} else {"";}?>"><a href="javascript:;"  title="Selected" data-title="selected">Selected</a></li>

                     <li class="<?php if($tname == 'onboarding') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Onboarding" data-title="onboarding">Onboarding</a></li>

                      <li class="<?php if($tname == 'confirmation') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Confirmation" data-title="Confirmation">Confirmation</a></li>


                    <li class="<?php if($tname == 'rejected') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Rejected" data-title="rejected">Rejected</a></li> 
              
                <?php }
         else if($pageName == 'candidate-list') { ?>
          <li class="<?php if($pageName == 'candidate-list') {echo $activeclass;} else {"";}?>"><a href="candidate-list<?php echo $extension; ?>" title="Candidate List" data-title="Candidate List">Candidate List</a></li> 
       <?php  } 
         else if($pageName == 'mrf' || $pageName == 'mrfdel') {?>
             		<?php if(in_array('SELECTED',$_SESSION['MenuCheckSess']['Mrf'])){?>
                    <li id="mrflist" class="<?php if($pageName == 'mrf') {echo $activeclass;} else {"";}?>"><a onclick="mrflist()" title="Positions" data-title="positions">MRF List</a></li> 
                    <?php }?>

                    <?php if(in_array('SELECTED',$_SESSION['MenuCheckSess']['Mrf'])){?>
                    <li id="mrfdel" class="<?php if($pageName == 'mrfdel') {echo $activeclass;} else {"";}?>"><a onclick="mrfdelete()" title="deletemrf" data-title="deletemrf">MRF Deleted List</a></li> 
                  <?php } ?>
                    
                  <?php if(in_array('OPENINGLIST',$_SESSION['MenuCheckSess']['Mrf'])){?>
                    <li class="<?php if($pageName == 'openings') {echo $activeclass;} else {"";}?>"><a href="openings<?php echo $extension; ?>" title="MRF" data-title="openings">MRF</a></li> 
               		<?php }?>
                <?php }else if($pageName == 'fincode') {?>
                <?php if(in_array('FINCODEQUEUE',$_SESSION['MenuCheckSess']['Fincode'])){?>
                    <li class="active<?php if($tname == 'queue') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Queue" data-title="queue">Fincode Queue</a></li> 
                    <?php }?>
                    <?php if(in_array('FINCODEUPDATED',$_SESSION['MenuCheckSess']['Fincode'])){?>
                    <li class="fincodeupdate<?php if($tname == 'update') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Update" data-title="update">Fincode Update</a></li> 
                  <?php }?>
                <?php }else if($pageName == 'email') {?>
                <?php if(in_array('EMAILQUEUE',$_SESSION['MenuCheckSess']['Email'])){?>
                    <li class="active<?php if($pageName == 'queue') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Queue" data-title="queue">Email Queue</a></li> 
                    <?php }?>
                    <?php if(in_array('EMAILUPDATED',$_SESSION['MenuCheckSess']['Email'])){?>
                    <li class="emailupdate<?php if($tname == 'update') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="Update" data-title="update">Email Update</a></li> 
                  <?php }?>
                <?php }else if($pageName == 'users' || $pageName == 'adduser' || $pageName == 'edituser' || $pageName == 'roles'|| $pageName == 'addrole'|| $pageName == 'editrole' || $pageName == 'transfers' || $pageName == 'newtransfer') {?>
         <?php if(in_array('MANAGEUSERS',$_SESSION['MenuCheckSess']['Usermanagement'])){?>
             		<li class="<?php if($pageName == 'users' || $pageName == 'adduser' || $pageName == 'edituser') {echo $activeclass;} else {"";}?>"><a href="users<?php echo $extension; ?>" title="Active Users" data-title="users">Manage Users</a></li> 
              <?php } ?>
               <?php if(in_array('MANAGEROLES',$_SESSION['MenuCheckSess']['Usermanagement'])){?>
                    <li class="<?php if($pageName == 'roles' || $pageName == 'addrole' || $pageName == 'editrole') {echo $activeclass;} else {"";}?>"><a href="roles<?php echo $extension; ?>" title="Active Roles" data-title="roles">Manage Roles</a></li> 
                  <?php } ?>
                   <?php if(in_array('TRANSFERS',$_SESSION['MenuCheckSess']['Usermanagement'])){?>
                    <li class="<?php if($pageName == 'transfers' || $pageName == 'newtransfer') {echo $activeclass;} else {"";}?>"><a href="transfers<?php echo $extension; ?>" title="Active Transfers" data-title="roles">Transfers</a></li> 
                  <?php } ?>
                <?php }
                    
                
                
         else if($pageName == 'downloads'||$pageName == 'payroll' ||$pageName == 'payrollifmg' ||$pageName == 'insurance'||$pageName == 'form11'|| $pageName == 'download-applicant'|| $pageName == 'download-profileimage'|| $pageName == 'compliance') {?>
                  <?php if(in_array('DOWNLOADS',$_SESSION['MenuCheckSess']['Report'])){?>
             		<li class="<?php if($pageName == 'downloads') {echo $activeclass;} else {"";}?>"><a href="downloads<?php echo $extension; ?>" title="Downloads" data-title="downloads">Downloads</a></li>
                	<?php }?>
                  <?php if(in_array('PAYROLLDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'payroll') {echo $activeclass;} else {"";}?>"><a href="payroll<?php echo $extension; ?>" title="Payroll" data-title="payroll">Payroll</a></li>
                  <?php }?>

                  <?php if(in_array('IFMGPAYROLLDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'payrollifmg') {echo $activeclass;} else {"";}?>"><a href="payrollifmg<?php echo $extension; ?>" title="Payroll IFMG" data-title="payrollifmg">Payroll IFMG</a></li>
                  <?php }?>
                   <?php if(in_array('INSURANCEDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'insurance') {echo $activeclass;} else {"";}?>"><a href="insurance<?php echo $extension; ?>" title="Insurance" data-title="insurance">Insurance</a></li>
                  <?php }?>
                  <?php if(in_array('COMPLAINCEDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'compliance') {echo $activeclass;} else {"";}?>"><a href="compliance<?php echo $extension; ?>" title="Compliance" data-title="compliance">Compliance</a></li>
                  <?php }?>
                  <?php if(in_array('FORM11DOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'form11') {echo $activeclass;} else {"";}?>"><a href="form11<?php echo $extension; ?>" title="Form 11" data-title="form11">Form 11</a></li>
                  <?php }?>
                  <?php if(in_array('APPLICANTDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'download-applicant') {echo $activeclass;} else {"";}?>"><a href="download-applicant<?php echo $extension; ?>" title="Download Applicant" data-title="download-applicant">Download Applicant</a></li>
                  <?php }?>
                   <?php if(in_array('PROFILEIMAGEDOWNLOAD',$_SESSION['MenuCheckSess']['Report'])){?>
                <li class="<?php if($pageName == 'download-profileimage') {echo $activeclass;} else {"";}?>"><a href="download-profileimage<?php echo $extension; ?>" title="Download Profileimage" data-title="download-profileimage">Download Profileimage</a></li>
                  <?php }?>
				
         <?php }else if($pageName == 'industry' || $pageName == 'category' || $pageName == 'client' || $pageName == 'designation' || $pageName == 'wbs' || $pageName == 'site' || $pageName == 'state' || $pageName == 'city') {?>
         <?php if(in_array('STATE',$_SESSION['MenuCheckSess']['Master'])){?>
                <li class="<?php if($pageName == 'state') {echo $activeclass;} else {"";}?>"><a href="state<?php echo $extension; ?>" title="State" data-title="state">State</a></li>
                <?php }?>
                 <?php if(in_array('CITY',$_SESSION['MenuCheckSess']['Master'])){?>
                <li class="<?php if($pageName == 'city') {echo $activeclass;} else {"";}?>"><a href="city<?php echo $extension; ?>" title="City" data-title="city">City</a></li>
                <?php }?>
          <?php if(in_array('INDUSTRY',$_SESSION['MenuCheckSess']['Master'])){?>
                <li class="<?php if($pageName == 'industry') {echo $activeclass;} else {"";}?>"><a href="industry<?php echo $extension; ?>" title="Industry" data-title="industry">Industry</a></li>
                <?php }?>
                <?php if(in_array('CATEGORY',$_SESSION['MenuCheckSess']['Master'])){?>
                 <li class="<?php if($pageName == 'category') {echo $activeclass;} else {"";}?>"><a href="category<?php echo $extension; ?>" title="Category" data-title="category">Category</a></li>
                   <?php }?>
                <?php if(in_array('CLIENT',$_SESSION['MenuCheckSess']['Master'])){?>
                  <li class="<?php if($pageName == 'client') {echo $activeclass;} else {"";}?>"><a href="client<?php echo $extension; ?>" title="Client" data-title="client">Client</a></li>
                    <?php }?>
                    <?php if(in_array('WBS',$_SESSION['MenuCheckSess']['Master'])){?>
                   <li class="<?php if($pageName == 'wbs') {echo $activeclass;} else {"";}?>"><a href="wbs<?php echo $extension; ?>" title="WBS" data-title="wbs">WBS</a></li>
                <?php }?>
                <?php if(in_array('SITE',$_SESSION['MenuCheckSess']['Master'])){?>
                   <li class="<?php if($pageName == 'site') {echo $activeclass;} else {"";}?>"><a href="site<?php echo $extension; ?>" title="Site" data-title="site">Site</a></li>
                <?php }?>
                <?php if(in_array('DESIGNATION',$_SESSION['MenuCheckSess']['Master'])){?>
                   <li class="<?php if($pageName == 'designation') {echo $activeclass;} else {"";}?>"><a href="designation<?php echo $extension; ?>" title="Designation" data-title="designation">Designation</a></li>
                <?php }?>
                
                
                 
       <?php }else if($pageName == 'cibil-verification') {?>
                <?php if(in_array('CIBILVERIFICATION',$_SESSION['MenuCheckSess']['CIBILVerification'])){?>
                    <li class="active<?php if($tname == 'cverification') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="CIBIL Verification" data-title="cverification">CIBIL Verification</a></li> 
                    <?php }?>
                     <?php if(in_array('CTC',$_SESSION['MenuCheckSess']['CIBILVerification'])){?>
                    <li class="<?php if($tname == 'ctc') {echo $activeclass;} else {"";}?>"><a href="javascript:;" title="CTC" data-title="ctc">CTC</a></li> 
                    <?php }?>
                <?php }?>
				</ul>

        <?php if($pageName =="applicantlist") { ?>

        <div class="searchCon searchCon_app search_header clearfix"><a href="javascript:;" onclick="removeSearch()" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a>
                <div class="coupn_search clearfix"><input type="text" value="" name="searchKeyword" id="searchKeyword" class="srch_txtbox srch_txtbox_header" placeholder="Search by Name / Number"  onkeydown="if(event.keyCode == 13){ searchPhonenumber()}"><a href="javascript:;" title="Search by Name / Number / Email" onClick="searchPhonenumber();"></a></div><a href="javascript:;" class="list-search"  onClick="searchPhonenumber();"><i class="fas fa-search"></i>&nbsp;&nbsp;Search</a></div> 
            <?php } ?>    
<?php 
 if(in_array('ADDMRF',$_SESSION['MenuCheckSess']['Mrf'])){ 
if($pageName == 'mrf'){?>
<a href="add-mrf<?php //echo $extension; ?>" data-toggle="tooltip" title="Click here to fill the required details to add new MRF in the application" data-placement="bottom" class="subscr_crt_btn" id="mrfbtn">+&nbsp;&nbsp;Add New MRF</a>
<?php }}?>


<?php if($pageName == 'candidate-list'){?>
<div class="searchCon searchCon_app search_header_can clearfix">
  <!-- <a href="candidate-list<?php echo $extension;?>" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a> -->
                <!-- <div class="coupn_search clearfix"><div class="remove"><a href="candidate-list<?php echo $extension;?>" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a></div><input type="text" value="" name="searchKeyword" id="searchKeyword" class="srch_txtbox srch_txtbox_header" placeholder="Search by Name / Number"  onkeydown="if(event.keyCode == 13){ searchPhonenumber()}"><a href="javascript:;" title="Search by Name / Number / Email" onClick="searchPhonenumber();"></a></div><a href="javascript:;" class="list-search"  onClick="searchPhonenumber();"><i class="fa fa-search"></i>&nbsp;&nbsp;Search</a></div>  -->
<?php // if(in_array('ADDCANDIDATE',$_SESSION['MenuCheckSess']['Candidate'])){?> 
  
<!-- <a href="candidate<?php echo $extension; ?>" data-toggle="tooltip" title="" data-placement="bottom" class="subscr_crt_btn">+&nbsp;&nbsp;Add New Candidate</a> -->
<?php }?>




<?php if($userCount>0){
  if($pageName == 'users'){
    
    ?>
  <a href="javascript:;"  data-toggle="tooltip" title="" data-placement="bottom" onclick="uploadUser()" class="subscr_crt_btn" style="right:180px;">+&nbsp;&nbsp;Bulk Upload</a>
 <?php } ?>
<?php  if($pageName == 'users' && $edit_flag == 1){?>
<a href="add-user<?php echo $extension; ?>" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New User</a>
<?php }else if($pageName == 'roles' && $edit_flag == 1){ ?>

  <a href="addrole<?php echo $extension; ?>" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New Role</a>
  <?php }else if($pageName == 'transfers' && $edit_flag == 1){ ?>

  <a href="newtransfer<?php echo $extension; ?>" class="subscr_crt_btn" >New Transfer</a>
<?php }}?>
    
    <?php if($pageName == 'aop'){ ?>
      <a href="javascript:;"  data-toggle="tooltip" title="Annual Operation Planning (AOP) A detailed projection of all estimated Head counts to be hired for the current year.
Click here to view and download the template for AOP" data-placement="bottom" onclick="upload_AOP()" class="subscr_crt_btn" >+&nbsp;&nbsp;Upload AOP</a>
   <?php } ?>   
        
      <?php if($pageName == 'fincode'){ ?>
      <a href="javascript:;" onclick="fincode_bulk()" class="subscr_crt_btn" >+&nbsp;&nbsp;Bulk Upload</a>
   <?php } ?>
       <?php if($pageName == 'fincode'){ ?>

        <div class="searchCon searchCon_app search_header1 clearfix"><a href="fincode<?php echo $extension;?>" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a>
                <div class="coupn_search clearfix"><input type="text" value="" name="searchKeyword" id="searchKeyword" class="srch_txtbox srch_txtbox_header" placeholder="Search by Name / Number"  onkeydown="if(event.keyCode == 13){ searchPhonenumber()}"><a href="javascript:;" title="Search by Name / Number / Email" onClick="searchPhonenumber();"></a></div></div> 
            <?php } ?>   

             <?php if($pageName == 'cibil-verification'){ ?>

        <div class="searchCon searchCon_app search_headercibil clearfix"><a href="cibil-verification<?php echo $extension;?>" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a>
                <div class="coupn_search clearfix"><input type="text" value="" name="searchKeyword" id="searchKeyword" class="srch_txtbox srch_txtbox_header" placeholder="Search by Name"  onkeydown="if(event.keyCode == 13){ searchPhonenumber()}"><a href="javascript:;" title="Search by Name / Number / Email" onClick="searchPhonenumber();"></a></div></div> 
            <?php } ?>   

       <?php if($pageName == 'email'){ ?>
      <a href="javascript:;" onclick="email_bulkupload()" class="subscr_crt_btn" >+&nbsp;&nbsp;Bulk Upload</a>
   <?php } ?>  

     <?php if($pageName == 'email'){ ?>

        <div class="searchCon searchCon_app search_header1 clearfix"><a href="email<?php echo $extension;?>"" class="clrFilter1" style="display:none;"><img src="images/clear_search_icon.png" /></a>
                <div class="coupn_search clearfix"><input type="text" value="" name="searchKeyword" id="searchKeyword" class="srch_txtbox srch_txtbox_header" placeholder="Search by Name / Number / Email"  onkeydown="if(event.keyCode == 13){ searchPhonenumber()}"><a href="javascript:;" title="Search by Name / Number / Email" onClick="searchPhonenumber();"></a></div></div> 
            <?php } ?> 

<?php if(in_array('INDUSTRY',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'industry'){?>
<a href="javascript:;" onClick="addInd();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New Industry</a>
<?php }}?>
<?php if(in_array('CATEGORY',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'category'){?>
<a href="javascript:;" onClick="addCat();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New Category</a>
<?php }}?>
<?php if(in_array('CLIENT',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'client'){?>
<a href="javascript:;" onClick="addClient();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New Client</a>
<?php }}?>
<?php if(in_array('DESIGNATION',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'designation'){?>
<a href="javascript:;" onClick="addDesig();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New Designation</a>
<?php }}?>
<?php if(in_array('WBS',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'wbs'){?>
<a href="javascript:;" onClick="addWbs();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New WBS</a>
<?php }}?>
<?php if(in_array('SITE',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'site'){?>
<a href="javascript:;" onClick="addSite();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New Site</a>
<?php }}?>
<?php if(in_array('STATE',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'state'){?>
<a href="javascript:;" onClick="addState();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New State</a>
<?php }}?>
<?php if(in_array('CITY',$_SESSION['MenuCheckSess']['Master'])){if($pageName == 'city'){?>
<a href="javascript:;" onClick="addCity();" class="subscr_crt_btn" >+&nbsp;&nbsp;Add New City</a>
<?php }}?>
</nav>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

