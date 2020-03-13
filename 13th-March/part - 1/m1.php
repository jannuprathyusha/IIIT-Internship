<?php 
$author = 'Free';
  // include_once "pw_utils.php";
  // echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
  // echo "<script>framesizing('Top')</script>";
// echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
// echo "<script src='bootstrap/js/bootstrap.min.js'></script>";
    
?>

<!DOCTYPE html>
<html>
 <head>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css' />
<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js'></script>
<script>
/* onclick function to get the table with the selected room number in each row*/
function getSelectedRoom() {
	    var d = $('#d1').val();
		//console.log(d);
		var values = $('#class_rooms').val();
		//console.log(values);
		var request_type = 'getRooms';
		$.ajax({
			   type: 'POST',
			   url: 'invigilation_api.php', 
			   data: {requesttype:request_type, NoofRooms:values, examDate:d,},
			   success: function(response) {
					$('#rooms_id').html(response);
					$('.selectpicker').selectpicker();
				
			}, error: function() {
					  
			}
		  });
	  }


  </script>
  
 </head>
 <body>
  <br /><br />
   
  <div class="container">
   <label for="date"><b>Exam Date</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
   <input type="date" id="d1" name="date"><br><br><br>
   <label>Exam Start Time</label>
   <input type="time"/ id="t1">
   <label>Exam End Time</label>
   <input type="time"/ id="t2">
   <br>
   
   <br><br>
   <label for="rooms">Select Room Numbers</label>

    <select id='class_rooms' class="selectpicker" multiple data-live-search="true" onchange='getSelectedRoom();'>    
      <option value="101" id="input1">101(Himalaya)</option>
      <option value="102" id="input2">102(Himalaya)</option>
      <option value="103" id="input3">103(Himalaya)</option>
      <option value="104" id="input4">104(Himalaya)</option>
      <option value="105" id="input5">105(Himalaya)</option>
      <option value="201" id="input6">201(Himalaya)</option>
      <option value="202" id="input7">202(Himalaya)</option>
      <option value="203" id="input8">203(Himalaya)</option>
     </select><br>
   <br/>
       <p id='table'></p>
  </div>
  <div id="rooms_id">
  </div>

 </body>
</html>





