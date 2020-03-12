<?php
//print_r($_REQUEST);
$author = 'Free';
  //include_once "pw_utils.php";
  //include_once "invigilation_duties";
echo "
<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css' />
<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js'></script>
<script>$('.selectpicker').selectpicker();</script>
  ";
 
$request_type = $_REQUEST['requesttype'];
switch( $request_type) {
	case "getRooms":

	$x= getDropdown();
	         $str="<table class='table'><tr><th>Date</th><th>RoomNumbers</th><th>Select Invigilators</th></tr>";
			 for ($i = 0; $i < count($_REQUEST['NoofRooms']); $i++) {
				  $str .= "<tr><td>Date</td><td>".$_REQUEST['NoofRooms'][$i]."</td><td>".$x."</td></tr>";
               }
			   	echo $str .= "</table>";	
		break;
	case 2:  break;
}
            

function getDropdown() {
  
	$str = "
	<div class='container'>
		<select id='invigilators' class='selectpicker' multiple data-live-search='true'>
		  <option value='1' id='input-value1'>Radha</option>
		  <option value='2' id='input-value2'>Madhu</option>
		  <option value='3' id='input-value3'>Harry</option>
		  <option value='4' id='input-value4'>Rohn</option>
		  <option value='5' id='input-value5'>Jack</option>
		  <option value='6' id='input-value6'>Jenny</option>
		  <option value='7' id='input-value7'>will</option>
		  <option value='8' id='input-value8'>Mark</option>
		 </select>
	 </div>
	
";
return $str;
}
?>
