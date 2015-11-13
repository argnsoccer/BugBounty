$(document).ready(function ()
{
  $("#submitBountyData").click(function(event){
  	var bountyInfo = {};
  	bountyInfo['name'] = $("bountyName").val();
  	bountyInfo['payout'] = $("payout").val();
  	bountyInfo['link'] = $("link").val();
  	bountyInfo['endDate'] = $("endDate").val();
  	bountyInfo['desc'] = $("description").val();
	
    $.ajax({
	  url: '/api/createBounty',
	  data: bountyInfo,
	  dataType: 'json',
	  async: 'false',
	  type: 'POST',
	  success: function(response){
		  
		  if(response['errorCode'] == '0'){
			  //Success
			  alert("Succesfully created bounty!");
			  window.location.href = "/";
		  }
		  else if(response['errorCode'] == '1'){
			  //Error inserting into DB
		  }
		  else if(response['errorCode'] == '2'){
			  //Not a Marshall
			  alert(response['errorInfo']);
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