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
  $("#submitSignUp").click(function(event) 
  {
    event.preventDefault();

    var userInfo = {}

    userInfo["username"] = $("#signUpUsername").val();
    userInfo["password"] = $("#signUpPassword").val();
    userInfo["email"] = $("#signUpEmail").val();
    userInfo["accountType"] = $("input[name='accountType']:checked").val();

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
        url: '/api/userSignUp',
        data: userInfo,
        dataType: 'json',
        async: 'false',
        type: 'POST',
        success: function(response) {
          
          if (response['error'] == '0')
          {
            window.location.href = "/";
          }
          else if (response['error'] == '1')
          {
            alert("Please choose a differnet username!");
          }
          else if (response['error'] == '2')
          {
            alert("An account already exists for this email!");
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