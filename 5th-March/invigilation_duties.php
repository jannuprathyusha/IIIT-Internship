<?php 
$author = 'Free';
  include_once "pw_utils.php";
  echo "<link href='bootstrap/css/bootstrap.min.css' rel='stylesheet'>";
  echo "<script>framesizing('Top')</script>"; 
?>

<!DOCTYPE html>
<html>
 <head>
  <title></title>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:600px;">
   <br /><br />
   <form method="post" id="framework_form">
    <div class="form-group">
     <select id="framework" name="framework[]" multiple class="form-control" >
      <option value="101" id="input-value">101(Himalaya)</option>
      <option value="102" id="input-value">102(Himalaya)</option>
      <option value="103" id="input-value">103(Himalaya)</option>
      <option value="104" id="input-value">104(Himalaya)</option>
      <option value="105" id="input-value">105(Himalaya)</option>
      <option value="201" id="input-value">201(Himalaya)</option>
      <option value="202" id="input-value">202(Himalaya)</option>
      <option value="203" id="input-value">203(Himalaya)</option>
     </select>
    </div>
    <div class="form-group">
     <input type="submit" class="btn btn-info" name="submit" value="Submit" onclick='getSelectedData();' />
    </div>
   </form>
   <br />
       <p id='table'></p>
  </div>
  
  <script>
  
  function getSelectedData() {
    var values = $('#framework').val();
    var request_type = 'getRooms';
  $.ajax({
           type: 'POST',
           url: 'invigilation_api.php', 
           data: {requesttype:request_type, NoofRooms:values},
           success: function(response) {
                $('#table').html(response);
            
        }, error: function() {
                  
        }
      });
  }
  </script>
 </body>
</html>

<script>
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Select Room Numbers',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
 $('#framework_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"invigilation_api.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#framework option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#framework').multiselect('refresh');
    alert(data);
   }
  });
 });
 
 
});
</script>


