<?php
//print_r($_REQUEST);
$author = 'Free';
  include_once "pw_utils.php";
  echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>
  ";
$request_type = $_REQUEST['requesttype'];
switch( $request_type) {
	case "getRooms":
	$str = '';
	$x= getDropdown();
	         
			 for ($i = 0; $i < count($_REQUEST['NoofRooms']); $i++) {
				  $str .= "<div class='card'><div class='card-body'>".$x."</div></div>";
               }
			   	echo $str;	
		break;
	case 2:  break;
}


function getDropdown() {
	$str= "<!DOCTYPE html>
   <html>
   <head>
   <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js'></script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css' />
  </head>";
  
	$str .= "<div class='container' style='width:600px;'>
	<form method='post' id='framework_form1'>
    <div class='form-group'><select id='framework1' name='framework1[]' multiple class='form-control' >
      <option value='1' id='input-value1'>Radha</option>
      <option value='2' id='input-value2'>Madhu</option>
      <option value='3' id='input-value3'>Harry</option>
      <option value='4' id='input-value4'>Rohn</option>
      <option value='5' id='input-value5'>Jack</option>
      <option value='6' id='input-value6'>Jenny</option>
      <option value='7' id='input-value7'>will</option>
      <option value='8' id='input-value8'>Mark</option>
     </select></div></div>
   </form>

</html>";
return $str;
}
?>

<script>
console.log('hello');
$(document).ready(function(){
	console.log('hoiiii');
 $('#framework1').multiselect({ 
  nonSelectedText: 'Select Invigilators',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px',
 });
 $('#framework_form1').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:'invigilation_api.php',
   method:'POST',
   data:form_data,
   success:function(data)
   {
    $('#framework1 option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#framework1').multiselect('refresh');
    alert(data);
   }
  });
 });
 
});

</script>


