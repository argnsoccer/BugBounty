$(document).ready(function () 
{
  $("#submitSignUp").click(function() 
  {
      var emailSignUp = $("#signUpEmail").val()
      var usernameSignUp = $("#signUpUsername").val();
      var passwordSignUp = $("#signUpPassword").val();

      if(emailSignUp == '' || passwordSignUp == '' || usernameSignUp == '') 
      {
        $('input[type="text"].signUpForm, input[type="password"].signUpForm')
      .css("border","2px solid red");
        $('input[type="text"].signUpForm,input[type="password"].signUpForm')
      .css("box-shadow","0 0 3px red");
        alert("Please fill in all fields.");
        return false;
      }
      else
      {
        alert("filled");
      }
  });
});