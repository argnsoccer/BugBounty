function isSet(key, value) {
	if (value == null || value == "")
	{
		alert("Please fill in all specefied fields");
		return false;
	}

	return true;
}

$(document).ready(function () {

	$("#submitReport").click(function(event) {

		event.preventDefault();

		var reportInfo = {};

		reportInfo["errorName"] = $("#errorName").val();
    reportInfo["errorDescription"] = $("#errorDescription").val();
    reportInfo["errorPath"] = $("#errorPath").val();
    reportInfo["username"] = $("#reportForm").attr("data-username");
    reportInfo["bountyID"] = $("#reportForm").attr("data-ID");
    reportInfo["file"] = $("fileName").val();

    if (!isSet(reportInfo['errorName'])
    	|| !isSet(reportInfo['errorDescription'])
    	|| !isSet(reportInfo['errorPath']))
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
      	//drop down success
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