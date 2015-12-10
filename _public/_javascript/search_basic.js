function isSet(value)
{
  if (value == null || value == '')
  {
	  $.notify({
	  // options
	  message: "Please insert a query",
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
    return false;
  }
  return true;
}

$(document).ready(function () {

  $("#submitSearchForm").click(function(event) {

  	event.preventDefault();

    var testInfo = {};

    testInfo['query'] = $("#searchText").val();

    if(!isSet(testInfo['query'])) {
      return false;
    }

    $.ajax({
      url: '/api/basicSearch/' + testInfo['query'],
      data: testInfo,
      dataType: 'json',
      async: 'false',
      type: 'GET',
      success: function(response)
      {

      	for (var i =0; i < response.result.bounties.length; ++i) {
      		var bounty = response.result.bounties[i];
      		console.log(bounty);
			var element = "<tr class=\"rowTable\"><td class=\"cell\">" + bounty.dateEnding + "</td><td class=\"cell\"><a href=\"/_hunter/bounty/" + bounty.poolID + "\">" +bounty.bountyName + "</a></td><td class=\"cell\"><a href=\"/_hunter/company/" +bounty.companyUsername + "\">" +bounty.companyName + "</a></td></tr>";
	    	$("#basicSearchBody").append(element);
      	}

      	$("#searchText").val('');

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