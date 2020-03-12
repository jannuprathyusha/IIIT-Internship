<?php 
$author = 'Free';
  // include_once "pw_utils.php";
  // echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
  // echo "<script>framesizing('Top')</script>";
  
    
?>

<!DOCTYPE html>
<html>
 <head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
/* onclick function to get the table with the selected room number in each row*/
function getSelectedRoom() {
		var values = $('#class_rooms').val();
		//console.log(values);
		var request_type = 'getRooms';
		$.ajax({
			   type: 'POST',
			   url: 'invigilation_api.php', 
			   data: {requesttype:request_type, NoofRooms:values, },
			   success: function(response) {
					$('#table').html(response);
				
			}, error: function() {
					  
			}
		  });
	  }
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/*Code for the multi select drop down for selecting room numbers.*/	  
$(document).ready(function(){ 
	
// $('#class_rooms').on('change', function() {
  // console.log($('#class_rooms').selectpicker()) ;
// });
 
 // ('#class_rooms').on('submit', function(event){
	 // alert('hi');
  // event.preventDefault();
  // var form_data = $(this).serialize();
  // $.ajax({
   // method:"POST",
   // data:form_data,
   // success:function(data)
   // {
    // $('#framework option:selected').each(function(){
     // $(this).prop('selected', false);
    // });
    // $('#class_rooms').multiselect('refresh');
    // alert(data);
   // }
  // });
 // });
 
 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 
/*Code for selecting the invigilators*/
// $('#invigilators').on('change', function() {
  // console.log($('#invigilators').selectpicker()) ;
// });
 // $('#invigilators').multiselect({ 
  // nonSelectedText: 'Select Invigilators',
  // enableFiltering: true,
  // enableCaseInsensitiveFiltering: true,
  // buttonWidth:'400px',
 // });
 // $('#invigilators').on('submit', function(event){
  // console.log('jackpot');
  // event.preventDefault();
  // var form_datas = $(this).serialize();
  // $.ajax({
   // method:'POST',
   // data:form_datas,
   // success:function(data)
   // {
    // $('#framework option:selected').each(function(){
     // $(this).prop('selected', false);
    // });
    // $('#invigilators').multiselect('refresh');
    // alert(data);
   // }
  // });
 // });
 
});

 
  </script>
  
 </head>
 <body>
  <br /><br />
   
  <div class="container">
   <br/><br/>
   <label for="date">Exam Date</label><br>
   <input type="date" id="d1" name="date"><br><br>
   <label for="rooms">Select Room Numbers</label>

    <select id='class_rooms' class="selectpicker" multiple data-live-search="true">    
      <option value="101" id="input1">101(Himalaya)</option>
      <option value="102" id="input2">102(Himalaya)</option>
      <option value="103" id="input3">103(Himalaya)</option>
      <option value="104" id="input4">104(Himalaya)</option>
      <option value="105" id="input5">105(Himalaya)</option>
      <option value="201" id="input6">201(Himalaya)</option>
      <option value="202" id="input7">202(Himalaya)</option>
      <option value="203" id="input8">203(Himalaya)</option>
     </select><br>
	 <input type="submit" value="submit" onclick='getSelectedRoom();'>
   <br/>
       <p id='table'></p>
  </div>
 </body>
</html>





