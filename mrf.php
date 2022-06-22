<?php
include("../config.php");
$jsontext = $_REQUEST['jsontext'];
$secreatekey = '&asd$#nd%3424ndfdsj';

$valJson = $_REQUEST['valJson'];


$actualtext =  cryptoJsAesDecrypt($secreatekey, $valJson);
$splitStr =  explode("=**=",$actualtext);

$pageName = $_GET['page'];
if($pageName=="mrflist"){
	$appUrl = $service_domain."position/openinglist";
}else{
	$appUrl = $service_domain."position/deletedjoblist";
}



$page_number = $splitStr[9];

$appPostArray = array("PositionId" => $splitStr[2],"ClientId" => $splitStr[4],"CategoryId" => $splitStr[3],"CityId" => $splitStr[5], "RegionId" => $splitStr[10], "StateId" => $splitStr[11],"Experience" => $splitStr[6],"FromDate" => $splitStr[8],"ToDate" => $splitStr[7],"CompanyDivisionId" => '1', "Page" => $page_number, "Limit" => $item_per_page,"EmployeeId" =>$splitStr[12],"KeyWord" => $splitStr[13]);
$subPostArray = array_merge($appPostArray, $commonPostArray);
$jsonval = json_encode($subPostArray);
$encVar = helprenc($jsonval);
$appArray = array("HepUId" => $encVar);
$appData = getData($appUrl, $appArray);
$appJson = json_decode($appData);
$appResult = json_decode(helprdec($appJson->result));
$appList = $appResult->OpeningList;

$totalCount = $appResult->count;
$startCount = $appResult->start;
$endCount = $appResult->end;

$get_total_rows = $totalCount; 
$total_pages = ceil($get_total_rows/$item_per_page);
$page_position = (($page_number-1) * $item_per_page);


$showDelete = "N";
$showTypeArray = strtolower($_SESSION['BFLUserType']);// 
if(in_array($showTypeArray, $showArr)){

	$showDelete = "Y";
}
$showEditArr = "N";
if(in_array($showTypeArray, $showEdit)){

	$showEditArr = "N";
 }
// echo '<pre>';
// print_r($appResult);exit;

/* Mongo Audit Insert Start*/
if($auditLogger!='N'){
	include("../config/mongoconnection.php");
	$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	$appPostArray1 = array("PositionId" => $splitStr[2],"ClientId" => $splitStr[4],"CategoryId" => $splitStr[3],"CityId" => $splitStr[5], "RegionId" => $splitStr[10], "StateId" => $splitStr[11],"Experience" => $splitStr[6],"FromDate" => $splitStr[8],"ToDate" => $splitStr[7],"CompanyDivisionId" => $splitStr[1], "Page" => $page_number, "Limit" => $item_per_page,"EmployeeId" =>$splitStr[12],"KeyWord" => $splitStr[13], "EventName" => "Opening List".$tabType, "URL" => $actual_link);

	$mongoArray = array_merge($appPostArray1, $commonPostArrayEvent);
	$db_connect = new Mongo_Connect();
	 $db_connect->insert($mongoArray);
}
/* Mongo Audit Insert End*/

// echo "<pre>";
// print_r($appResult);
// exit;



$retData='<div id="loading" class="loading">
        <div class="loader">Loading...</div>
    </div>';
      
   $retData .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" class="queueTable">
  <tr class="thead">
   <td width="10%">MRF Id</td>
   <td width="12.5%">Grade - Designation</td>
   <td width="15%">Department</td>
	 <td width="12.5%">Branch</td>
	 <td width="12.5%">Location</td>

    <td width="4%">Role Type</td>
    <td width="4%">MRF Type</td>
	<td width="10%">Created</td>
	<td width="17%" style="text-align:center;">Action</td>
	
	</tr>';
     
   if(count($appList)>0){ 
	  
  for($i=0;$i<count($appList);$i++)
 {
	 
	 if((($i+1) %2) == 0){
		$oeclass ="even";
	}
	else{
		$oeclass ="odd";
	}
	if($appList[$i]->WorkExperience!=""){
	 $exp = $appList[$i]->WorkExperience;
	 
	 }
	 else{
	 	$exp = '';
	 }

	 if($appList[$i]->ApplicableGrade_Designation != ''){
  		$position_data = $appList[$i]->ApplicableGrade_Designation;
  		$str_arr_to = explode (",", $position_data); 
  		$data1= $str_arr_to[0];
  		$data2= $str_arr_to[1];
  	} else {
		$data1 ='-';
		$data2 ='';
  	}

  	if($appList[$i]->RevokeFlag == 'Y') {
  		$revoke = '<a href="javascript:;" data-toggle="tooltip" title="Revoke"  onclick="revokeMrf(\''.base64_encode($appList[$i]->JobId.'=**=').'\')"><span style="color:#000"><i class="fa fa-undo" aria-hidden="true"></i></span></a>';
  	}
  	else {
  		$revoke = '<a href="javascript:;" data-toggle="tooltip" title="Delete"  onclick="delete_mrf(\''.base64_encode($appList[$i]->JobId.'=**=').'\')"><span style="color:red"><i class="fa fa-trash" aria-hidden="true"></i></span></a>';
  	}
	
	if($appList[$i]->Executive==""){
		$assignTo = '<a href="javascript:;" onClick="pickassociate(\''.base64_encode($appList[$i]->JobId.'=**='.$appList[$i]->CompanyDivisionId.'=**='.$appList[$i]->ClientId.'=**='.$_SESSION['BFLUserId'].'=**=').'\')">Assign</a>';
	}else{
		$assignTo = $appList[$i]->Executive.' | <a href="javascript:;" onClick="pickassociate(\''.base64_encode($appList[$i]->JobId.'=**='.$appList[$i]->CompanyDivisionId.'=**='.$appList[$i]->ClientId).'\')">Assign</a>';
	}

	 $canencryval = helprenc($appList[$i]->JobId."=**="); 
	 $canUrl = "mrflist".$extension."?Id=".$canencryval;
	 $editUrl = "edit-mrf".$extension."?Id=".$canencryval;
	
      $retData .= '<tr style="height: 20px;" class="queueTableList '.$oeclass.'" id="app_list_'.$appList[$i]->JobId.'">
<td>'.htmlentities($appList[$i]->mrfid).'</td>
<td><span data-toggle="tooltip" title="'.$appList[$i]->ApplicableGrade_Designation.'">'.$data1.'</br> '.$data2.'</span></td>
<td>'.htmlentities($appList[$i]->department_name).'</td>
<td>'.ucwords(strtolower($appList[$i]->PSSGBranch)).'</td>
<td>'.ucwords(strtolower($appList[$i]->PostedLocation)).'</td>

<td>'.$appList[$i]->Mrftype.'</td>
<td>'.$appList[$i]->Roletype.'</td>
<td>'.date("d/m/Y", strtotime($appList[$i]->CreatedDate)).'</td>

<td><a href="'.$canUrl.'" class="view_btn" data-toggle="tooltip" title="View" ><i class="fa fa-eye" aria-hidden="true"></i></a>&nbsp;&nbsp';
$retData .= $revoke;

 $retData .='</td>

	</tr>';
                      
                   }
              
                   $retData .='</table>'; 
				   $retData .='<div class="pageWrapper"><div style="float:left; padding-top:27px; font-size:15px;">'.$endCount.' '.'of'.' '.$totalCount.' '.'items</div>';
					$retData .=  paginate_function($item_per_page, $page_number, $get_total_rows, $total_pages);
					$retData .='</div>';
              
                    }else{
						$retData .='<tr class="queueTableList"><td colspan="11" style="text-align:center"><div style="text-align:center;"><img src="images/data_notfound.png" style="width:200px;" /></div>No data found</td></tr>';
						 $retData .='</table>';
					}
					echo base64_encode($retData);
					
					?>
    
 

   