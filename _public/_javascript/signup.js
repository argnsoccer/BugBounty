function isSet(key, value)
{
  if (value === null || value === '')
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
    var userInfo = {};

    userInfo.username = $("#inputUsername").val();
    userInfo.email = $("#inputEmail").val();
    userInfo.password = $("#inputPassword").val();
    userInfo.accountType = $('.accountType:checked').val();

      for (var property in userInfo)
      {
        if (!isSet(property, userInfo[property]))
        {
          /*$('input[type="text"].loginForm, input[type="password"].loginForm')
      .css("border","2px solid red");
          $('input[type="text"].loginForm,input[type="password"].loginForm')
      .css("box-shadow","0 0 3px red");*/
          return false;
        }
      }

    $.ajax({
      url: '/api/signUpUser',
      type: 'POST',
      dataType: 'json',
      data: {
        username: userInfo.username,
        email: userInfo.email,
        password: userInfo.password,
        accountType: userInfo.accountType
      },
      async: 'true',
      success: function(response) {
        if (response.error === '0')
        {
          alert("successfully created account");
          window.location.href = "/billinginfo";
        }
        else if (response.error === '1')
        {
          console.log(response.message);
          alert("Please choose a different username!");

        }
        else if (response.error === '2')
        {
          alert("An account already exists for this email!");
          console.log(response.message);
        }
        else
        {
          console.log(response);
          alert(response[':message']);
        }
      }
    });
  });
});
