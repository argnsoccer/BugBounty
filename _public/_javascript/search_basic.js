function isSet(value)
{
  if (value == null || value == '')
  {
	$.notify({
	  // options
	  message: "Please include a query for us to search",
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

  $("#submitSearch").click(function(event) {

  	alert(testInfo['query']);

    var testInfo = {};

    testInfo['query'] = $("#searchText").val();

    if(!isSet(testInfo['query'])) {
      return false;
    }

    // $.ajax({
    //   url: '/api/basicSearch',
    //   data: testInfo,
    //   dataType: 'json',
    //   async: 'false',
    //   type: 'GET',
    //   success: function(response)
    //   {
    //   	alert(response.result);
    //   },
    //   error: function(xhr, status, error)
    //   {
    //   var err = eval("(" + xhr.responseText + ")");
    //   //alert("Please Try Again, we had an internal error!");
    //   alert(err.message);
    //   }
    // });
  });
});