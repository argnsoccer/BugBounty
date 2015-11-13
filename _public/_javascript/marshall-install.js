$(document).ready(function () 
{
  $("#submitBountyForm").click(function(event) 
  {
    event.preventDefault();

    var jsonInfo = {}

    jsonInfo["name"] = $("#name").val();
    jsonInfo["link"] = $("#link").val();
    jsonInfo["description"] = $("#description").val();
    jsonInfo["payout"] = $("#payout").val();
	jsonInfo["date"] = $("#date").val();

    /*for (var property in userInfo)
    {
		if (!isSet(property, userInfo[property]))
        {
          $('input[type="text"].loginForm, input[type="password"].loginForm')
      .css("border","2px solid red");
          $('input[type="text"].loginForm,input[type="password"].loginForm')
      .css("box-shadow","0 0 3px red");
          return false;
        }
    }*/

	$.ajax({
		url: '/api/createBounty',
		data: jsonInfo,
		dataType: 'json',
		async: 'false',
		type: 'POST',
		success: function(response) {
		  
		  if (response['error'] == '0')
		  {
			window.location.href = "/";
		  }
		  else
		  {
			alert(response["message"]);
		  }
		},
		error: function (xhr, status, error) {
		  var err = eval("(" + xhr.responseText + ")");
		  //alert("Please Try Again, we had an internal error!");
		  alert(err.message);
		}
	});
  });
});