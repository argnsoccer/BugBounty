$(document).ready(function () {

	$(".detailsButton").click(function() { 

	   // $('#messageReport').val();

	   var name;
	   var description;
	   var path;
	   var link;

	  for (var i = 0; i < submittedReports.length; ++i)
	  {
	  	if (submittedReports[i].reportID == $(this).attr('data-ID')){
	  		name = submittedReports[i].errorName;
	  		description = submittedReports[i].description;
	  		path = submittedReports[i].pathToError;
	  		link = submittedReports[i].link;
	  	}
	  }

	  $('#errorNameDisplay').val(name);
	  $('#errorDescriptionDisplay').val(description);
	  $('#errorPathDisplay').val(path);
	  $('#errorLinkDisplay').val(link);

	});

});