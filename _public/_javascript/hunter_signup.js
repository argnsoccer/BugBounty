function isSet(key, value) {
  if (value === null 
    || value === '') {

    $.notify({
      // options
      message: "  " + "Please fill in all fields!",
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
  return true;
}

function passwordsMatch (password, confirmPassword) {
  if (password == confirmPassword) {
    return true;
  }

  $.notify({
    // options
    message: "  " + "Passwords do not match!",
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

function validateEmail(email) {
  var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
  return re.test(email);
}

$(document).ready(function ()
{

  var clicks = 0;

  var userInfo = {};
  userInfo['accountType'] = "hunter";

  $("#submitSignUp").click(function(event)
  {

    event.preventDefault();

    if (clicks == 0) {

      userInfo.username = $("#signUpUsername").val();
      userInfo.email = $("#signUpEmail").val();
      userInfo.password = $("#signUpPassword").val();
      userInfo.confirmPassword = $("#signUpConfirmPassword").val();

      if(!passwordsMatch(userInfo.password, userInfo.confirmPassword)) {
        return false;
      }

      for (var property in userInfo)
      {
        if (!isSet(property, userInfo[property]))
        {
          return false;
        }
      }

      //ajax call

      var usernameURL = '/api/usernameTaken/' + userInfo.username;

      $.ajax({
        url: usernameURL,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
          if (response.error === '0') {
            if (response.result.taken == '1') {
              $("#signUpUsername").val('');
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

            else if (response.result.taken == '0') {

              if (!validateEmail(userInfo.email)) {

                 $.notify({
                  // options
                      message: "  " + "Email is invalid!",
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

                 $("#signUpEmail").val('');

                return false;
              }


              var emailURL = '/api/emailTaken/' + userInfo.email;

              $.ajax({
                url: emailURL,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                  if (response.error === '0') {
                    if (response.result.taken == '1') {
                      $("#signUpEmail").val('');
                      $.notify({
                        // options
                        message: "  " + "This email is already in use!",
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
                    else if (response.result.taken == '0') {
                      
                      $("#signUpUsername").val('');
                      $("#signUpEmail").val('');
                      $("#signUpPassword").val('');
                      $("#signUpConfirmPassword").val('');

                      $("#signUpUsername").attr('placeholder', 'name');
                      $("#signUpEmail").hide();
                      $("#signUpPassword").hide();
                      $("#signUpConfirmPassword").hide()

                      $.notify({
                        // options
                        message: "  " + "Basic Details Saved",
                        icon: 'glyphicon glyphicon-info-sign'
                        },{
                        // settings
                        type: 'info',
                        placement: {
                          from: "top",
                          align: "right",
                          allow_dismiss: true,
                        }
                      });
                      $("#step1").removeClass("activeStepHunter");
                      $("#step2").addClass("activeStepHunter");
                      clicks = clicks + 1;
                    }

                    else {
                      alert("Una Problema");
                    }

                  }
                  else if (response.error === '1')
                  {
                    alert("Statement did not occur");
                  }
                }
              });
            }

            else {
              alert("Una Problema");
            }

          }
          else if (response.error === '1')
          {
            console.log(response.message);
              }
        }
      });
    }
    else if (clicks == 1) {

      userInfo.name = $("#signUpUsername").val();


      $("#signUpUsername").val('');
      $("#signUpEmail").val('');
      $("#signUpPassword").val('');
      $("#signUpConfirmPassword").val('');

      $("#signUpUsername").hide();
      $("#signUpPaymentType").show();
      // $("#signUpPassword").show();
      // $("#signUpEmail").show();
      // $("#signUpConfirmPassword").show();

      $("#submitSignUp").removeClass("btn-primary");
      $("#submitSignUp").addClass("btn-success");
      $("#submitSignUp").text("Sign Up");

      $.notify({
        // options
        message: "  " + "More Details Saved",
        icon: 'glyphicon glyphicon-info-sign'
        },{
        // settings
        type: 'info',
        placement: {
          from: "top",
          align: "right",
          allow_dismiss: true,
        }
      });
      $("#step2").removeClass("activeStepHunter");
      $("#step3").addClass("activeStepHunter");

      clicks = clicks + 1;
    }
    else if (clicks == 2) { 

      var payInfo = {};

      // payInfo.paymentType = $("#signUpUsername").val();
      // payInfo.option1 = $("#signUpEmail").val();
      // payInfo.option2 = $("#signUpPassword").val();
      payInfo.paymentType = $("#paymentType option:selected").text();

      for (var property in payInfo)
      {
        if (!isSet(property, payInfo[property]))
        {
          return false;
        }
      }

      userInfo.paymentType = payInfo.paymentType;

      console.log(userInfo);


    $.ajax({
      url: '/api/signUpHunter',
      type: 'POST',
      dataType: 'json',
      data: userInfo,
      async: 'true',
      success: function(response) {
        console.log(response);
        if (response.error == '0')
        {
          window.location = "/";
        }
        else if (response.error == '1')
        {
          alert("Please choose a different username!");
        }
      },
      error: function(xhr, status, error)
      {
      var err = eval("(" + xhr.responseText + ")");
      console.log(err);
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


    }
    else {
      alert("Lost count of clicks: " + clicks);
    }
  });
});
