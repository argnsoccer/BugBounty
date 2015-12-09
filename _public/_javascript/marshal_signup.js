$(window).load(function () {
  $("#descButton").hide();
  // $('#countriesDropwDown').hide();
});

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

$("#signUpUsername").qtip({ // Grab some elements to apply the tooltip to
    content: {
        text: 'Please make Username at least 5 characters'
    },
    style: {
      classes: 'qtip-blue'
    },
    events: {
      blur: function(event, api) {
        // For more information on the API object, check-out the API documentation

        if ($("#signUpUsername").val().length < 5) {
          api.set('style.classes', 'qtip-red');;
          api.set('content.text', "Please make Username at least 5 characters");
        }
        else {
          // api.elements.tooltip.toggleClass('qtip-green qtip-cream');
          api.set('style.classes', 'qtip-green');
          api.set('content.text', "Username long enough");
        }
      }
    }
});


$("#signUpPassword").qtip({ // Grab some elements to apply the tooltip to
    content: {
        text: 'Please make Passwords at least 8 characters'
    },
    style: {
      classes: 'qtip-blue'
    },
    events: {
      blur: function(event, api) {
        // For more information on the API object, check-out the API documentation

        if ($("#signUpPassword").val().length < 5) {
          api.set('style.classes', 'qtip-red');;
          api.set('content.text', "Please make Passwords at least 8 characters");
        }
        else {
          // api.elements.tooltip.toggleClass('qtip-green qtip-cream');
          api.set('style.classes', 'qtip-green');
          api.set('content.text', "Username long enough");
        }
      }
    }
});


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
            if (response.taken == '1') {
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

            else if (response.taken == '0') {

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
                    if (response.taken == '1') {
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
                    else if (response.taken == '0') {
                      
                      $("#signUpUsername").val('');
                      $("#signUpEmail").val('');
                      $("#signUpPassword").val('');
                      $("#signUpConfirmPassword").val('');

                      $("#signUpUsername").attr('placeholder', 'Company Name');
                      $("#signUpEmail").attr('placeholder', 'Compay Type');
                      // $("#signUpPassword").attr('placeholder', 'Country');
                      $("#descButton").show();
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
                      $("#step1").removeClass("activeStepMarshal");
                      $("#step2").addClass("activeStepMarshal");

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
      userInfo.type = $("#signUpEmail").val();
      userInfo.description = $("#signUpDescription").val();

      if (userInfo.name == '' || userInfo.name == null)
      {

        $.notify({
          // options
          message: "Please fill in a Company Name!",
          icon: 'glyphicon glyphicon-remove-circle'
          },{
          // settings
          type: 'danger',
          z_indez: 1050,
          delay: 100,
          placement: {
            from: "top",
            align: "right",
            allow_dismiss: true,
          }
        });

        return false;
        
      }

      userInfo.name = $("#signUpUsername").val();
      userInfo.type = $("#signUpEmail").val();
      userInfo.description = $("#signUpDescription").val();


      $("#signUpUsername").val('');
      $("#signUpEmail").val('');
      $("#signUpPassword").val('');
      $("#signUpConfirmPassword").val('');

      $("#signUpUsername").attr('placeholder', 'Payment Type');
      $("#signUpEmail").attr('placeholder', 'I dont know');
      $("#signUpPassword").attr('placeholder', 'I dont know');
      $("#signUpConfirmPassword").attr('placeholder', 'I dont know');
      $("#signUpConfirmPassword").show();
      $("#descButton").hide();

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
      $("#step2").removeClass("activeStepMarshal");
      $("#step3").addClass("activeStepMarshal");

      clicks = clicks + 1;
    }
    else if (clicks == 2) { 

      var payInfo = {};

      payInfo.paymentType = $("#signUpUsername").val();
      payInfo.option1 = $("#signUpEmail").val();
      payInfo.option2 = $("#signUpPassword").val();
      payInfo.option3 = $("#signUpConfirmPassword").val();

      for (var property in payInfo)
      {
        if (!isSet(property, payInfo[property]))
        {
          return false;
        }
      }

      userInfo.paymentType = payInfo.paymentType;
      userInfo.option1 = payInfo.option1;
      userInfo.option2 = payInfo.option2;
      userInfo.option3 = payInfo.option3;

    }
    else {
      alert("Lost count of clicks: " + clicks);
    }

    // $.ajax({
    //   url: '/api/signUpUser',
    //   type: 'POST',
    //   dataType: 'json',
    //   data: {
    //     username: userInfo.username,
    //     email: userInfo.email,
    //     password: userInfo.password,
    //     accountType: userInfo.accountType
    //   },
    //   async: 'true',
    //   success: function(response) {
    //     if (response.error === '0')
    //     {
    //       alert("successfully created account");
    //       window.location.href = "/billinginfo";
    //     }
    //     else if (response.error === '1')
    //     {
    //       console.log(response.message);
    //       alert("Please choose a different username!");

    //     }
    //     else if (response.error === '2')
    //     {
    //       alert("An account already exists for this email!");
    //       console.log(response.message);
    //     }
    //     else
    //     {
    //       console.log(response);
    //       alert(response[':message']);
    //     }
    //   }
    // });

  });
});
