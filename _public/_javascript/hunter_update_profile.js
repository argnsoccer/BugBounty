function checkUpdate(userInfo) {
  var setVariables = {};
  var code = -3;

  if (userInfo["password"] == "") {
    code = -2;

    return code;
  }

  if(userInfo['username'] != '') {
      setVariables["username"] = 1;
  }
  if(userInfo['email'] != '') {
      setVariables["email"] = 1;
  }
  if(userInfo['newPassword'] != '') {
      if(userInfo['newPassword'] == userInfo["confirmPassword"]) {
          setVariables["newPassword"] = 1;
      }
      else {

          code = -1;
          return code;
      }
  }

  if (setVariables["username"]) {
      if (setVariables["email"]) {
          if (setVariables["newPassword"]) {
              code = 6;
          }
          else {
              code = 3;
          }
      }
      else if (setVariables["newPassword"]) {
          code = 4;
      }
      else {
          code = 0;
      }
  }
  else if (setVariables["email"]) {
      if (setVariables["newPassword"]) {
          code = 5;
      }
      else {
          code = 1
      }
  }
  else if(setVariables["newPassword"]) {
      code = 2;
  }

  return code;

}


$(document).ready(function () {

//Profile -----------------------------------
  $("#submitChangeProfile").click(function(event) {

    var userInfo = {}

    userInfo["username"] = $("#changeUsernameForm").val();
    userInfo["email"] = $("#changeEmailForm").val();
    userInfo["password"] = $("#changePassworldOldForm").val();
    userInfo["newPassword"] = $("#changePasswordNewForm").val();
    userInfo["confirmPassword"] = $("#changePasswordConfirmForm").val();

    userInfo.changeCode = checkUpdate(userInfo);

    if (userInfo.changeCode == -2) {

      $('#changePassworldOldForm').val('');
      $('#changePasswordNewForm').val('');
      $('#changePasswordConfirmForm').val('');

      $.notify({
        // options
        message: "  " + "Please include your old password!",
        icon: 'glyphicon glyphicon-alert'
        },{
        // settings
        type: 'danger',
        delay: 100,
        z_index: 1050,
        placement: {
          from: "top",
          align: "right",
          allow_dismiss: true,
        }
      });

      return false;
    }
    else if (userInfo.changeCode == -1) {

      $('#changePassworldOldForm').val('');
      $('#changePasswordNewForm').val('');
      $('#changePasswordConfirmForm').val('');

      $.notify({
        // options
        message: "  " + "New and Confirm do not match!",
        icon: 'glyphicon glyphicon-alert'
        },{
        // settings
        type: 'danger',
        delay: 100,
        z_index: 1050,
        placement: {
          from: "top",
          align: "right",
          allow_dismiss: true,
        }
      });

      return false;
    }
    else {

      $.ajax({
        url: '/api/updateUserDetailsHunter',
        data: userInfo,
        dataType: 'json',
        async: 'false',
        type: 'POST',
        success: function(response)
        {

          $('#changeUsernameForm').val('');
          $('#changeEmailForm').val('');
          $('#changePassworldOldForm').val('');
          $('#changePassworldNewForm').val('');
          $('#changePassworldConfirmForm').val('');

          console.log(userInfo);
          console.log(response);

          if(response.error.charAt(1) == 1) {

            $.notify({
              // options
              message: "  " + "Username Taken! Please choose another.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(3) == 1) {

            $.notify({
              // options
              message: "  " + "Email Taken! Please choose another.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(4) == 1) {

            //we
            $.notify({
              // options
              message: "  " + "Something went wrong, please try again.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(5) == 1) {

            //we
            $.notify({
              // options
              message: "  " + "Something went wrong, please try again.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(6) == 1) {

            $.notify({
              // options
              message: "  " + "The password you provided was incorrect.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(7) == 1) {

            //we
            $.notify({
              // options
              message: "  " + "Something went wrong, please try again.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(0) == 1) {

            $.notify({
              // options
              message: "  " + "Something went wrong, please try again.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }
          else if(response.error.charAt(2) == 1) {

            //we
            $.notify({
              // options
              message: "  " + "Something went wrong, please try again.",
              icon: 'glyphicon glyphicon-alert'
              },{
              // settings
              type: 'danger',
              delay: 100,
              placement: {
                from: "top",
                align: "right",
                allow_dismiss: true,
              }
            });

            return false;
          }


          $.notify({
            // options
            message: "  " + "Profile Info Updated",
            icon: 'glyphicon glyphicon-ok'
            },{
            // settings
            type: 'success',
            placement: {
              from: "top",
              align: "right",
              allow_dismiss: true,
            }
          });

          var newLink = "/_hunter/profile/" + userInfo.username;

          if(userInfo.username == '') {
            newLink = "/_hunter/profile/" + $('#usernameValue').text();
          }

          window.location.href = newLink;


        },
        error: function(xhr, status, error)
        {
        var err = eval("(" + xhr.responseText + ")");
        //alert("Please Try Again, we had an internal error!");
        $.notify({
            // options
            message: "  " + err + " \nsomething went wrong, please try again",
            icon: 'glyphicon glyphicon-remove-circle'
            },{
            // settings
            type: 'danger',
            placement: {
              from: "top",
              align: "right",
              allow_dismiss: true,
            }
          });
        }
      });




      $('#profileChangeModal').modal('hide');
      
    }

    // $.ajax({
    //   url: '/api/addRSS',
    //   data: rssInfo,
    //   dataType: 'json',
    //   async: 'false',
    //   type: 'POST',
    //   success: function(response)
    //   {
    //     $.notify({
    //       // options
    //       message: "  " + "Profile Info Updated",
    //       icon: 'glyphicon glyphicon-ok'
    //       },{
    //       // settings
    //       type: 'success',
    //       placement: {
    //         from: "top",
    //         align: "right",
    //         allow_dismiss: true,
    //       }
    //     });
    //     $('#changeUsernameForm').val('');
    //     $('#changeEmailForm').val('');
    //     $('#changePassworldOldForm').val('');
    //     $('#changePassworldNewForm').val('');
    //     $('#changePassworldConfirmForm').val('');
    //   },
    //   error: function(xhr, status, error)
    //   {
    //   var err = eval("(" + xhr.responseText + ")");
    //   //alert("Please Try Again, we had an internal error!");
    //   $.notify({
    //       // options
    //       message: "  " + err + " \nsomething went wrong, please try again",
    //       icon: 'glyphicon glyphicon-remove-circle'
    //       },{
    //       // settings
    //       type: 'danger',
    //       placement: {
    //         from: "top",
    //         align: "right",
    //         allow_dismiss: true,
    //       }
    //     });
    //   }
    // });
  });

});
