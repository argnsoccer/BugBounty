$(document).ready(function () {

//Profile -----------------------------------
  $("#submitChangeProfile").click(function(event) {

    var userInfo = {}

    userInfo["username"] = $("#changeUsernameForm").val();
    userInfo["email"] = $("#changeEmailForm").val();
    userInfo["oldPassword"] = $("#changePassworldOldForm").val();
    userInfo["newPassword"] = $("#changePasswordNewForm").val();
    userInfo["confirmPassword"] = $("#changePasswordConfirmForm").val();

    $('#profileChangeModal').modal('hide');

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

});
