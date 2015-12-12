$(document).ready(function () 
{
	$("#submitLogout").click(function(event) 
	{

    userInfo = {}

      event.preventDefault();

      $.ajax({
        url: '/api/deleteSession',
        data: userInfo,
        dataType: 'json',
        async: 'false',
        type: 'GET',
        success: function(response)
        {
          //alert(response.error);

          if (response['error'] == '0')
          {
            window.location.href= "/";
          }
          else if (response['error'] == '1')
          {
            //alert("Please try again, an unknown error occurred!");
            alert(response['message']);
            return false;
          }
        },
        error: function(xhr, status, error) 
        {
        var err = eval("(" + xhr.responseText + ")");
        //alert("Please Try Again, we had an internal error!");
        alert(err.message);
        }
      });
  });

  $("#submitProfile").click(function(event) {
      userInfo = {};

      $.ajax({
        url: '/api/getLoggedInUser',
        data: userInfo,
        dataType: 'json',
        async: 'false',
        type: 'GET',
        success: function(response)
        {
          if (response['error'] == '0')
          {
            if (response['result']['userType'] == 'hunter')
            {
              var address = "/_hunter/profile/" + response['result']['username'];
              window.location.href = address;
            }
            else if (response['result']['userType'] == 'marshal' 
              || response['result']['userType'] == 'sheriff')
            {
              var address = "/_marshall/profile/" + response['result']['username'];
              window.location.href = address;
            }
          }
          else if(response['error'] == '1')
          {
            alert("bad username, no user type");
          }
          else
          {
            alert("Try again, internal error");
          }
        }
      });

  });
});