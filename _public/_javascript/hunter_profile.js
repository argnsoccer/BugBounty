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

    var code = checkUpdate(userInfo);

    if (code == -2) {

      $('#changePassworldOldForm').val('');
      $('#changePasswordNewForm').val('');
      $('#changePasswordConfirmForm').val('');

      $.notify({
        // options
        message: "  " + "Please include your password!",
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
    else if (code == -1) {

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

//Payment -----------------------------------
  $("#submitChangePayment").click(function(event) {

    var userInfo = {}

    userInfo["option1"] = $("#changeOption1Form").val();
    userInfo["option2"] = $("#changeOption2Form").val();
    userInfo["password"] = $("#changePaymentPasswordForm").val();

    $('#paymentChangeModal').modal('hide');

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
    //       message: "  " + "Payment Info Updated",
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
    //     $('#changeOption1Form').val('');
    //     $('#changeOption2Form').val('');
    //     $('#changePaymentPasswordForm').val('');
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

  $(".detailsButton").click(function() { 

    var reportID = $(this).attr("data-ID");

    var reportURL = '/api/getReportFromReportID/' + reportID;

    $.ajax({
      url: reportURL,
      dataType: 'json',
      type: 'GET',
      success: function(response)
      {
        $('#errorReport').val(response.report.errorName);
        $('#descErrorReport').val(response.report.description);
        $('#pathErrorReport').val(response.report.pathToError);
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
  });

  $(".messageButton").click(function() { 

    var reportID = $(this).attr("data-ID");

    var reportURL = '/api/getReportFromReportID/' + reportID;

    $.ajax({
      url: reportURL,
      dataType: 'json',
      type: 'GET',
      success: function(response)
      {
        if (response.report.message == null) {
          response.report.message = "No message has been posted";
        }
        $('#messageReport').val(response.report.message);
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
  });

});
