<?php

//print_r($_REQUEST);
$request_type = $_REQUEST['requesttype'];
switch( $request_type) {
	case "getRooms":
		 $str = "<table class='table'><tr><th>RoomNumbers</th></tr>";
			 for ($i = 0; $i < count($_REQUEST['NoofRooms']); $i++) {
				  $str .= "<tr><td>".$_REQUEST['NoofRooms'][$i]."</td></tr>";
               }
			   		echo $str .= "</table>";
		break;
	case 2:  break;
}



?>

