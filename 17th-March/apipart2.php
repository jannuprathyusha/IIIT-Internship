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
<style>
	.container {
		margin-top:25px;
	}
</style>

  
 </head>
 <body>

  <div class="container">
  
	<div class='row'>
		<div class='col-md-4 col-sm-6 col-xs-12' >
		   Exam Date: <input type="date" id="d1" name="date" onchange='getSelectedDateRoom();'>
		</div>
		<div class='col-md-4 col-sm-6 col-xs-12'>
		   Exam Start Time:  <input type="time" id="t1" name='t1' onchange='getSelectedRoom();'>
		</div>
		<div class='col-md-4 col-sm-6 col-xs-12'>
		  Exam End Time:  <input type="time"  id="t2" name='t2' onchange='getSelectedRoom();'>
		</div>
		<div class='col-md-12 col-sm-6 col-xs-12'>
			<label for="rooms">Pick Rooms</label>
			<select id='class_rooms' class="selectpicker" multiple data-live-search="true" onchange='getSelectedRoom();'>    
			  <option value="101" id="input1">101(Himalaya)</option>
			  <option value="102" id="input2">102(Himalaya)</option>
			  <option value="103" id="input3">103(Himalaya)</option>
			  <option value="104" id="input4">104(Himalaya)</option>
			  <option value="105" id="input5">105(Himalaya)</option>
			  <option value="201" id="input6">201(Himalaya)</option>
			  <option value="202" id="input7">202(Himalaya)</option>
			  <option value="203" id="input8">203(Himalaya)</option>
			 </select>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-12'><p id='validations' style='text-align:center'></p></div>
	</div>
  </div>
  <div id="rooms_id"></div>
	<p id='slots_message' style='text-align:center'></p>
  </div>
  <script>
  
  
  
  function getSelectedDateRoom() {
	  // when date change set resuult set table nuu, and room numbers null
	  $('.selectpicker').val( [] );
	  $('.filter-option-inner-inner').html("Nothing selected");
	  $('#rooms_id').html('');
  }
/* onclick function to get the table with the selected room number in each row*/
function getSelectedRoom() {
	    var d = $('#d1').val();
		var st = document.getElementById('t1').value;
	var et = $('#t2').val();
		var values = $('#class_rooms').val();
		var i;
		var list = {};
			for (i = 0; i < values.length; i++) {
			  var invi_dropdown = $('#'+values[i]).val();
			  list[values[i]] = invi_dropdown;
			}
		
		var request_type = 'getRooms';
		$.ajax({
			   type: 'POST',
			   url: 'invigilation_api.php', 
			   data: {requesttype:request_type, NoofRooms:values, examDate:d, selected_values:list,startTime:st,endTime:et},
			   success: function(response) {
					$('#rooms_id').html(response);
					$('.selectpicker').selectpicker();
				
			}, error: function() {
					  
			}
		  });
	  }

	  
function validations(d,st,et,values) {
	
	var bool = false;
	if(d=='') {
		bool = true;
	} else if( st=='' ) {
		bool = true;
	}else if( et=='' ) {
		bool = true;
	}else if( values.length ==0 ) {
		bool = true;
	}
	
	return bool;
}
function addRecord(){
	var date = $('#d1').val();
	var st = document.getElementById('t1').value;
	var et = $('#t2').val();
	var values = $('#class_rooms').val();
	
	
	var validations_bool = validations(date,st,et,values);
	if(validations_bool ) {
		$('#validations').html('<p style=color:red>Please select all the filters to create slots</p>');
		return false;
	} else {
		$('#validations').html('');
		//pass the data validations
	}
	
	var i;
	var list = {};
		for (i = 0; i < values.length; i++) {
		  var invi_dropdown = $('#'+values[i]).val();
		  list[values[i]] = invi_dropdown;
		}
	var request_type = 'savedata';
		$.ajax({
			   type: 'POST',
			   url: 'invigilation_api.php', 
			   data: {requesttype:request_type, NoofRooms:values, examDate:date, selected_values:list,startTime:st,endTime:et},
			   success: function(response) {
				$('#slots_message').html(response);
				
			}, error: function() {
					  
			}
		  });
}
  </script>
 </body>
</html>





