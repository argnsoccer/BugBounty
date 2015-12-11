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

	$.ajax({
      url: '/api/getClientToken',
      type: 'GET',
      dataType: 'json',
      async: 'true',
      success: function(response) {

      	console.log(response);

      	braintree.setup(response, "custom", {
		      container: "paypal-container",
					paypal: {
						singluUse: false,
						amount: 189.00,
						currency: 'USD'
					}
  		});

      },
      error: function(xhr, status, error)
      {
      var err = eval("(" + xhr.responseText + ")");
      }
    });

	$(".payButton").click(function(event) {

		var payInfo = [];

		event.preventDefault();

		payInfo.reportID = $(this).attr("data-ID");
		payInfo.bountyID = $(this).attr("data-bountyID");
		payInfo.hunterUsername = $(this).attr("data-hunterUsername");

		payInfo.amount = $(".payAmountForm[data-ID=" + $(this).attr("data-ID")+"]").val();

		if (!isNumber(payInfo.amount)) {
			return false;
		}

		$("#payAmountSubmit").text("Pay $" + payInfo.amount);
		$("#payAmountSubmit").attr('data-amount', payInfo.amount);
		$("#payAmountSubmit").attr('data-reportID', payInfo.reportID);
		$("#payAmountSubmit").attr('data-bountyID', payInfo.bountyID);
		$("#payAmountSubmit").attr('data-hunterUsername', payInfo.hunterUsername);

	});


	$("#payAmountSubmit").click(function(event) {

		var paymentInfo = {};

		paymentInfo['paymentMethodNonce'] = "fake-paypal-one-time-nonce";
		paymentInfo['amount'] = $("#payAmountSubmit").attr('data-amount');
		paymentInfo['reportID'] = $("#payAmountSubmit").attr('data-reportID');
		paymentInfo['bountyID'] = $("#payAmountSubmit").attr('data-bountyID');
		paymentInfo['hunterUsername'] = $("#payAmountSubmit").attr('data-hunterUsername');

		console.log(paymentInfo);

		    $.ajax({
      url: '/api/payReport',
      type: 'POST',
      dataType: 'json',
      data: paymentInfo,
      async: 'true',
      success: function(response) {
        	console.log(response);
      }
    });
<<<<<<< HEAD

	});

});
=======
	});
});
>>>>>>> c2c0dec8669b17e10aa56df68c7b5a7393aba0d2
