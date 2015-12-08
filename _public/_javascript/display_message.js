$(document).ready(function () {

	$(".messageButton").click(function() { 

	  var reportID = $(this).attr("data-ID");

	  var reportURL = '/api/getReportFromReportID/' + reportID;

	  $.ajax({
	    url: reportURL,
	    dataType: 'json',
	    type: 'GET',
	    success: function(response)
	    {
	      if (response.report.message == null) {
	        response.report.message = "No message has been posted";
	      }
	      $('#messageReport').val(response.report.message);
	    },
	    error: function(xhr, status, error)
	    {
	    var err = eval("(" + xhr.responseText + ")");
	    //alert("Please Try Again, we had an internal error!");
	    $.notify({
	        // options
	        message: "  " + err + " \nsomething went wrong, please try again",
	        icon: 'glyphicon glyphicon-remove-circle'
	        },{
	        // settings
	        type: 'danger',
	        placement: {
	          from: "top",
	          align: "right",
	          allow_dismiss: true,
	        }
	      });
	    }
	  });
	});

});