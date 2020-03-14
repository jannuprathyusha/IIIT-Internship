<?php
$author = 'Free';
define('NOHEAD', 'YES');
 include_once "pw_utils.php";
  //include_once "invigilation_duties";

 
$request_type = $_REQUEST['requesttype'];
switch( $request_type) {
	case "getRooms":
	         $str="<div class='container'><div class='row'><table class='table table-bordered'><tr><th>S.No</th><th>RoomNumbers</th><th>Select Invigilators</th></tr>";
			 for ($i = 0; $i < count($_REQUEST['NoofRooms']); $i++) {
				 $selected_values = $_REQUEST['selected_values'][$_REQUEST['NoofRooms'][$i]];
				 $invi_dropdown= getDropdown($_REQUEST['NoofRooms'][$i],  $selected_values);
				  $str .= "<tr><td>".($i+1)."</td><td>".$_REQUEST['NoofRooms'][$i]."</td><td>".$invi_dropdown."</td></tr>";
               }
			   	echo $str .= "</table></div></div>";	
		break;
	case 2:  break;
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



function getDropdown( $id,  $selected_values ) {
	$result = getEmployeeList();
	$options = "";
	foreach( $result as $entitycode=>$entityname) {
		
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
