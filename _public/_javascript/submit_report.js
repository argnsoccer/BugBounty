function isSet(value) {
	if (value == null || value == "")
	{
    $.notify({
      // options
      message: "Please fill out all fields!",
      icon: 'glyphicon glyphicon-remove-circle'
      },{
      // settings
      type: 'danger',
      z_indez: 1050,
      delay: 100,
      placement: {
        from: "top",
        align: "right",
        allow_dismiss: true,
      }
    });

		return false;
	}

	return true;
}

$(document).ready(function () {

	$("#submitReportForm").click(function(event) {

		event.preventDefault();

		var reportInfo = {};

		reportInfo["errorName"] = $("#errorNameForm").val();
    reportInfo["description"] = $("#errorDescriptionForm").val();
    reportInfo["pathToError"] = $("#errorPathForm").val();
    reportInfo["link"] = $("#errorLinkForm").val();
    reportInfo["username"] = $("#reportForm").attr("data-username");
    reportInfo["bountyID"] = $("#reportForm").attr("data-ID");
    reportInfo["file"] = $("fileName").val();

    // alert(reportInfo['errorName']);
    // alert(reportInfo['errorDescription']);
    // alert(reportInfo['errorPath']);

    if (!isSet(reportInfo['errorName'])
    	|| !isSet(reportInfo['description'])
    	|| !isSet(reportInfo['pathToError']))
    {
    	return false;
    }

    $.ajax({
    	url: '/api/createReport',
      data: reportInfo,
      dataType: 'json',
      async: 'false',
      type: 'POST',
      success: function(response)
      {
        var newReport = "<tr class=\"rowTable\"><td class=\"cell\">" + response.report.dateSubmitted + "</td><td class=\"cell\">" + response.report.paid + "</td><td class=\"cell\"><button type=\"button\" class=\"detailsButton\" data-toggle=\"modal\" data-target=\"#detailsModal\" data-whatever=\"@getbootstrap\" data-ID=" + response.report.reportID + ">View</button></td><td class=\"cell\"><button type=\"button\" class=\"messageButton\" data-toggle=\"modal\" data-target=\"#messageModal\" data-whatever=\"@getbootstrap\" data-ID=" + response.report.reportID + ">View</button></td></tr>";


        $(newReport).insertBefore("#firstValue");

      	$.notify({
          // options
          message: " Report Submitted",
          icon: 'glyphicon glyphicon-ok'
          },{
          // settings
          type: 'success',
          placement: {
            from: "top",
            align: "right",
            allow_dismiss: true,
          }
        });

        $("#errorNameForm").val('');
        $("#errorDescriptionForm").val('');
        $("#errorPathForm").val('');
        $("#errorLinkForm").val('');

        $('#reportModal').modal('hide');
      },
      error: function(xhr, status, error)
      {
      	var err = eval("(" + xhr.responseText + ")");
        //alert("Please Try Again, we had an internal error!");
        alert(err.message);
        }
    });
  });
});