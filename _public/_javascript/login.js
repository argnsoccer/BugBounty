function isSet(key, value)
{
  if (value == null || value == '')
  {
    alert("Please check that properties are all filled in!");
    return false;
  }
  return true;
}

$(document).ready(function ()
{
  $("#submitLogin").click(function(event)
  {
      event.preventDefault();

      var userInfo = {}

      userInfo["username"] = $("#usernameLogin").val();
      userInfo["password"] = $("#passLogin").val();

      for (var property in userInfo)
      {
        if (!isSet(property, userInfo[property]))
        {
          $('input[type="text"].loginForm, input[type="password"].loginForm')
      .css("border","2px solid red");
          $('input[type="text"].loginForm,input[type="password"].loginForm')
      .css("box-shadow","0 0 3px red");
          return false;
        }
      }

      $.ajax({
        url: '/api/loginUser',
        data: userInfo,
        dataType: 'json',
        async: 'false',
        type: 'POST',
        success: function(response)
        {
          if (response['error'] == '0')
          {
            window.location.href = "/";
          }
          else if (response['error'] == '1')
          {
            // alert("Please try again, username and password combination not recognized!");

            $.notify({
              // options
              message: "Please try again, username and password combination not recognized!",
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

            $("#usernameLogin").val('');
            $("#passLogin").val('');
            return false;
          }
          else if (response['error'] == '2')
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
