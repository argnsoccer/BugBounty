$(document).ready(function ()
{
  $("#submitProfileUpdate").click(function(event){
  	var userInfo = {};
  	userInfo['username'] = $("updateUsername").val();
  	userInfo['email'] = $("updateEmail").val();
  	userInfo['password'] = $("updateOldPassword").val();
  	userInfo['passwordNew'] = $("updateNewPassword").val();
  	userInfo['passwordMatch'] = $("updateNewPasswordConfirm").val();
	
   $.ajax({
	  url: '/api/updateUserInfo',
	  data: userInfo,
	  dataType: 'json',
	  async: 'false',
	  type: 'POST',
	  success: function(response){
		  
		  if(response['errorCode'] == '0'){
			  //Success
			  alert("Succesfully created bounty!");
			  window.location.href = "/";
		  }
		  else{
			  alert(response['errorInfo']);
		  }
	  }
	  error: function (xhr, status, error) {
		  var err = eval("(" + xhr.responseText + ")");
		  //alert("Please Try Again, we had an internal error!");
		  alert(err.message);
	  }
	});
  });
});
