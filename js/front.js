// JavaScript Document


// $.AJAX Example Request
 $('.pagination a').live('click', function(eve){
  eve.preventDefault();
  
  var link = $(this).attr('href');
  //alert(link);
  //console.log(link);
  $.ajax({
   url: link,
   type: "POST",
   dataType: "html",
   beforeSend: function(){
    //showBusy();
   }, 
     success: function(result) {
       $('#listing').html(result);
    }
  });
  

 });