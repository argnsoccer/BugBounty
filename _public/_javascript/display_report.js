$(document).ready(function () {

	$(".detailsButton").click(function() { 

	var reportID = $(this).attr("data-ID");

	var reportURL = '/api/getReportFromReportID/' + reportID;

	$.ajax({
	  url: reportURL,
	  dataType: 'json',
	  type: 'GET',
	  success: function(response)
	  {
	    $('#errorReport').val(response.report.errorName);
	    $('#descErrorReport').val(response.report.description);
	    $('#pathErrorReport').val(response.report.pathToError);
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