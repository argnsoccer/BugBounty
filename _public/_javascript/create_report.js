$(document).ready(function ()
{
  $("#submitCreateReport").click(function(event){
  	var reportInfo = {};
  	reportInfo['bountyID'] = $("bountyID").val();
  	reportInfo['username'] = $("username").val();
  	reportInfo['reportText'] = $("reportText").val();
	
    $.ajax({
	  url: '/api/createReport',
	  data: reportInfo,
	  dataType: 'json',
	  async: 'false',
	  type: 'POST',
	  success: function(response){
		  
		  if(response['error'] == '0'){
			  //Success
			  alert("Succesfully created report!");
			  window.location.href = "/";
		  }
		  else if(response['error'] == '1'){
			  //Error inserting into DB
			  alert(response['message']);
		  }
		  else{
			  alert(response['message']);
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