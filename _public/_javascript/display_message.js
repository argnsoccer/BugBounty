$(document).ready(function () {


	$(".messageButton").click(function() { 

	  var reportID = $(this).attr("data-ID");

	   // $('#messageReport').val();

	   var message = "No message has been posted";

	  for (var i = 0; i < submittedReports.length; ++i)
	  {
	  	if (submittedReports[i].reportID == $(this).attr('data-ID')){
	  		message = submittedReports[i].message;
	  	}
	  }

	  if (message == null 
	  	|| message == '') {

	    message = "No message has been posted";
	  
	  }

	  $('#messageReport').val(message);

	});

});