$(document).ready(function () {

	$(".messageButton").click(function() { 

	  var reportID = $(this).attr("data-ID");

	  alert(reportID);

	   // $('#messageReport').val();

	  var reportURL = '/api/getReportFromReportID/' + reportID;

	  $.ajax({
	    url: reportURL,
	    dataType: 'json',
	    type: 'GET',
	    success: function(response)
	    {
	      if (response.result.report.message == null) {
	        response.result.report.message = "No message has been posted";
	      }
	      $('#messageReport').val(response.result.report.message);
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