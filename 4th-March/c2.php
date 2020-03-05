<?php



$request_type = $_REQUEST['requesttype'];
switch( $request_type) {
	case "getRooms":
		 $str = "<table class='table'><tr><th>RoomNumbers</th><th>Time</th></tr>";
			 for ($i = 0; $i < 1; $i++) {
				  $str .= "<tr><td>$_REQUEST[NoofRooms]</td></tr>";
               }
			   		echo $str .= "</table>";
		break;
	case 2:  break;
}



?>