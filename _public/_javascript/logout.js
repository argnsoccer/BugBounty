$(document).ready(function () 
{
	$("#submitLogout").click(function(event) 
	{

    userInfo = {}

    alert("LOGOUT");

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
});