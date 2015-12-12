function isNumber(value) {

  if (!isNaN(value)
    && value >= 0) {
    return true;
  }

  $.notify({
    // options
    message: "Pay Amount is not a number",
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

    return false;
}

$(document).ready(function () {


  $(".savePayButton").click(function() { 

    var reportID = $(this).attr("data-ID");

    alert(reportID);

     var payInfo = [];

     payInfo['paidAmount'] = $(".payAmountForm[data-ID=" + $(this).attr("data-ID")+"]").val();
     // alert(payInfo['paidAmount']);

    if (!isNumber(payInfo['paidAmount'])) {
      return false;
    }

    payInfo['reportID'] = reportID;
    payInfo['message'] = "";
    payInfo['changeCode'] = "2";

    $.ajax({
      url: '/api/updateReport',
      type: 'POST',
      dataType: 'json',
      data: payInfo,
      async: 'true',
      success: function(response) {

      $.notify({
        // options
        message: "Report payment saved",
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

      $(".payAmountForm[data-ID=" + $(this).attr("data-ID")+"]").val(payInfo['paidAmount']);

      }
    });


  });

});