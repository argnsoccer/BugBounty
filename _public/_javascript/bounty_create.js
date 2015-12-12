function validURL(url)
{
	console.log(url);
     return url.match(/^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/);
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

      $.ajax({
        url: '/api/createBounty',
        data: bountyInfo,
        dataType: 'json',
        async: 'false',
        type: 'POST',
        success: function(response)
        {

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