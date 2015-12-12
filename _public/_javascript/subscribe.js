$(document).ready(function ()
{

  $("#subscribeButton").click(function(event) {

    var subscriptionInfo = [];

    subscriptionInfo["marshalUsername"] = $("#subscribeButton").attr('data-username');

    // console.log(subscriptionInfo);

        console.log(subscriptionInfo);

    $.ajax({
      url: '/api/addSubscription',
      type: 'POST',
      dataType: 'json',
      data: subscriptionInfo,
      async: 'true',
      success: function(response) {

        console.log(response);

        if(response.error == 0) {
          $.notify({
            // options
            message: "Subscription Added",
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
        }
        else if (response.error == 3) {
          $.notify({
            // options
            message: "This user does not have an RSS feed!",
            icon: 'glyphicon glyphicon-remove-circle'
            },{
            // settings
            type: 'danger',
            z_indez: 1051,
            delay: 100,
            placement: {
              from: "top",
              align: "right",
              allow_dismiss: true,
            }
          });

        }
        else {
          $.notify({
            // options
            message: "Something went wrong, please try again!",
            icon: 'glyphicon glyphicon-remove-circle'
            },{
            // settings
            type: 'danger',
            z_indez: 1051,
            delay: 100,
            placement: {
              from: "top",
              align: "right",
              allow_dismiss: true,
            }
          });
        }
      }
    });
  });

});
