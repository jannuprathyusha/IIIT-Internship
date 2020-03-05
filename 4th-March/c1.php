<?php 
$author = 'Free';
	include_once "pw_utils.php";
	echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
	echo "<script>framesizing('Top')</script>"; 

?>
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.css ">
  <script src="./bootstrap/js/jquery.min.js"></script>
  <script src="./bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <label for="Date"><b> Date </b></label>
    <input type="date" id="Date" name="Date">
	<p id="d1"></p>
	<label for="Time1"><b> Exam Start Time </b></label>
	<input type='time'/ id='t1' ></input>
	<label for="Time2"><b> Exam End Time </b></label>
	<input type='time'/ id='t2' ></input>
	<label for="Rooms"><b> Room Number </b></label>
	<input type='text' id='te'></input>
	<button onclick="addRoomNumber();">Add Room Number</button>
	<br><br>
	 <button onclick="myFunction()">Submit</button>
    <p id='table'></p>


<script>
function myFunction() {
	var d = '';
		$.ajax({
				   type: 'POST',
				   url: 'invigilation_api.php', //Relative or absolute path to response.php file
				   data: {},
				   success: function(response) {
				   response = JSON.parse(response);
				   
						
				}, error: function() {
								  
				}
			});
  
}
function addRoomNumber(){
	var r = document.getElementById('te').value;
	var request_type = 'getRooms';
	$.ajax({
				   type: 'POST',
				   url: 'invigilation_api.php', 
				   data: {requesttype:request_type, NoofRooms:r},
				   success: function(response) {
				        $('#table').html(response);
						
				}, error: function() {
								  
				}
			});
}
</script>
</body>
</html>



