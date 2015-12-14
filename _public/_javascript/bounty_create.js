function validURL(url)
{
     return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
}

function validDate(bountyDate) {
 var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

    var bountyY = bountyDate.slice(0,4);
    var bountyM = bountyDate.slice(5,7);
    var bountyD = bountyDate.slice(8); 

    var bountyDate = Number(bountyY)+Number(bountyM)+Number(bountyD);
    console.log(bountyDate);
    var today = yyyy+mm+dd;

    // console.log(Number(bountyDate));
    // console.log(Number(today));

    // console.log(Number(bountyDate) > Number(today));

    if (today >= bountyDate) {
    	return false;
    }

    return true;
}

$(document).ready(function ()
{
  $("#bountyCreateSubmit").click(function(event)
  {
      event.preventDefault();

      var bountyInfo = {};

      bountyInfo['name'] = $("#bountyTitleForm").val();
      bountyInfo['link'] = $("#bountyLinkForm").val();

      if(!validURL(bountyInfo['link'])) {

				$.notify({
					// options
					message: "Link provided not valid",
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

      bountyInfo['endDate'] = $("#bountyEndDateForm").val(); 
      bountyInfo['desc']= $("#bountyDescriptionForm").val();

      // console.log(bountyInfo);

      if(!validDate(bountyInfo['endDate'])) {
		$.notify({
			// options
			message: "Please enter a valid ending date",
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

      $.ajax({
        url: '/api/createBounty',
        data: bountyInfo,
        dataType: 'json',
        async: 'false',
        type: 'POST',
        success: function(response)
        {
        	console.log(response);

	        $.notify({
	          // options
	          message: '  Bounty Created',
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

	        var bountyID = response.result.bountyID;

	        var newLink = "/_marshal/track/" + bountyID;

	        window.location.href = newLink;
        },
        error: function(xhr, status, error)
        {
        var err = eval("(" + xhr.responseText + ")");
        //alert("Please Try Again, we had an internal error!");
        alert(err.message);
        }
      });
    });
  });