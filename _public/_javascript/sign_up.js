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
  $("#submitSignUp").click(function() 
  {
    var userInfo = {}

    userInfo["username"] = $("#signUpUsername").val();
    userInfo["password"] = $("#signUpPassword").val();
    userInfo["email"] = $("#signUpEmail").val()

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
      alert("heyoo");


  });
});