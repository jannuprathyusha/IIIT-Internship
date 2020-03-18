<?php
$author = 'Free';
define('NOHEAD', 'YES');
 include_once "pw_utils.php";
  //include_once "invigilation_duties";	
	
$request_type = $_REQUEST['requesttype'];
switch( $request_type) {
	case "getRooms":
	         $str="<div class='container'><div class='row'><table class='table table-bordered' ><tr style='background-color: cadetblue;color: white;'><th>S.No</th><th>RoomNumbers</th>
			 <th>Select Invigilators</th></tr>";
			 
			 $emplist = getEmployeeList();
			 
			 $date = $_REQUEST['examDate'];
			 $st =  $_REQUEST['startTime'];
			 $et =  $_REQUEST['endTime'];
			 for ($i = 0; $i < count($_REQUEST['NoofRooms']); $i++) {
				 $selected_values = $_REQUEST['selected_values'][$_REQUEST['NoofRooms'][$i]];
				 $invi_dropdown= getDropdown( $emplist, $_REQUEST['NoofRooms'][$i],  $selected_values, $date ,$st, $et );
				 
				  $str .= "<tr><td>".($i+1)."</td><td>".$_REQUEST['NoofRooms'][$i]."</td><td>".$invi_dropdown."</td></tr>";
               }
			   	echo $str .= "</table></div></div><br>
				<div class='col-md-12' style='text-align:center'><button type='submit' class='btn btn-primary center-block' onclick='addRecord()' style='margin-left:20px;'>Submit</button></div>";
               				
		break;
	case 'savedata':
	
		$result = checkClassing( $_REQUEST );
		if( $result['bool_status'] ) {
			echo $result['message'];
		} else {
			echo saveData($_REQUEST);
		}
		break;
}


 function checkClassing( $request ) {
	 $user_list = array();
	 foreach( $request['selected_values'] as $roomno=> $values) {
		 foreach( $values as $entity) {
			$exist = $user_list[$entity];
			if(count($exist)==0 ) {
				$exist = array();
				array_push( $exist, $roomno);
				$user_list [$entity] = $exist;
			} else {
				array_push( $exist, $roomno);
				$user_list [$entity] = $exist;
			}
		 }
	 }
	 
	 $message = "<div class='container'><div class='row'><table class='table table-bordered'><thead><tr style=' background-color: sienna;color: aliceblue;'><th colspan=2>Clashing Details</th></tr><tr><th>User Name</th><th>Clash Rooms</th></tr></thead><tbody>";
	 $bool = false;
	 $emp_list = getEmployeeList();
	 foreach( $user_list as $userid=> $rooms) {
		 if(count($rooms)>1 ) {
			 $bool = true;
			 $message .= "<tr><td>".$emp_list[$userid]."</td><td>".implode(",",$rooms)."</td></tr>";
		 }
	 }
	 $message .="</tbody></table></div></div>";
	 
	$finalresult = array('bool_status'=> $bool, 'message'=>$message);
	return $finalresult;
 }

function saveData( $request) {
		$invigilation_date = array('date'=> $request['examDate'],'start_time' => $request['startTime'],'end_time' => $request['endTime']);
		//insert data in to table
		// check if the record exist or not 
		
		$id = getValueForPS( " select id  from invigilation_duties where date='".$request['examDate']."' and 
												start_time= '".$request['startTime']."' and end_time = '".$request['endTime']."' ");
		if( $id =='' ) {
				ds2insert( $invigilation_date, 'invigilation_duties');
				saveInvigilatorsData($request, $id ) ;
				$message = "Data Saved";
		} else {
			$sql = " update invigilation_duties set date='".$request['examDate']."' , start_time= '".$request['startTime']."' , end_time = '".$request['endTime']."'  where id='".$id."'";
			PW_execute($sql );
			saveInvigilatorsData($request, $id ) ;
			$message = "Data Updated";
		}
		
		
		return $message;
}

function saveInvigilatorsData($request, $linkedid ) {
		
		
		//remove existing data 
		
		// keep data in log before delete the data
		$sql = " delete from invigilation_details  where linkedid='".$linkedid."' and linkedto='invigilation_duties' ";
		PW_execute($sql);
		$emp_list = getEmployeeList();
		foreach($request['selected_values'] as $roomno=> $values) {
			foreach( $values as $value) {
				$e_name = $emp_list[$value];
				
				$invigilation_details = array('linkedid'=> $linkedid,'linkedto'=>'invigilation_duties',
															'room_number' => $roomno,'invigilator_id' => $value,'invigilator_name' => $e_name);
				ds2insert( $invigilation_details, 'invigilation_details');
			}
		}
}

    /*
		-> this function is used to get the employee list 
		-> it will return array object with key and values
	*/        
function getEmployeeList() {
	$sql = " select entitycode,entityname from pw_entity where status='Active' and entitytype='EMPLOYEE' and hremptype in ('Staff', 'Faculty') limit 10";
	$result = PW_sql2rs( $sql);
	$listof_employees = array();
	while( $record = PW_fetch( $result) ) {
		$listof_employees[ $record['entitycode']] = $record['entityname'];
	}
	return $listof_employees;
}


function getDropdown( $emplist, $id,  $selected_values, $date,$st,$et ) {
	
	// if selected values empty check if the db already exist
	if ( count($selected_values)==0 ) {
		$exist_data = getValueForPS(" select id from invigilation_duties where date='".$date."' and start_time='".$st."' and end_time='".$et."'");
		$selected_values = array();
		if( $exist_data != '' ) {
			$data = PW_sql2rs(" select room_number,invigilator_id from invigilation_details where room_number='".$id."' and linkedid='".$exist_data."'  and linkedto='invigilation_duties' ");
			while($record = PW_fetch( $data) ) {
				array_push($selected_values, $record['invigilator_id']);
			}
		}
	}
	
	
	$options = "";
	foreach( $emplist as $entitycode=>$entityname) {
		
		$selectedtag = "";
		if(in_array( $entitycode, $selected_values)) {
			$selectedtag = 'Selected';
		}
		$options .= "<option value='".$entitycode."' ".$selectedtag.">".$entityname."</option>";
	}
	$str = "
	<div class='container'>
		<select id='".$id."' class='selectpicker' multiple data-live-search='true'>
		  ".$options."
		 </select>
	 </div>
	
";
return $str;
}
?>
