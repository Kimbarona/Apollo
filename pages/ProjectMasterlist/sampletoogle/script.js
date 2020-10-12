$(document).ready(function(){
 
    $('#gender').bootstrapToggle({
     on: 'Male',
     off: 'Female',
     onstyle: 'success',
     offstyle: 'danger'
    });
   
    $('#gender').change(function(){
     if($(this).prop('checked'))
     {
      $('#hidden_gender').val('Male');
     }
     else
     {
      $('#hidden_gender').val('Female');
     }
    });
   
    
   
   });