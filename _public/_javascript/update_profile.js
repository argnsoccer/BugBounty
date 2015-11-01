$(document).ready(function ()
{
  $("#submitProfileUpdate").click(function(event)
  {
  	var userInfo = {};
  	userInfo['username'] = $("updateUsername").val();
  	userInfo['email'] = $("updateEmail").val();
  	userInfo['password'] = $("updateOldPassword").val();
  	userInfo['passwordNew'] = $("updateNewPassword").val();
  	userInfo['passwordMatch'] = $("updateNewPasswordConfirm").val();
  	alert(userInfo['username']);

  });
});
