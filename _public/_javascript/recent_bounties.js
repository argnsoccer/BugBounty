var bountyInfo = [];

setInterval(function() {

  bountyInfo['recentIDs'] = recentBountyIDs;

    $.ajax({
      url: '/api/getRecentPostedBounties',
      data: {bountyInfo : bountyInfo},
      dataType: 'json',
      async: 'false',
      type: 'GET',
      success: function(response)
      {

      	for (bounty in response.result) {
      		bountyInfo['recentIDs'].push(bounty.poolID);

      		var element = "<tr class=\"rowTable\"><td class=\"cell\"><a href=\"/_hunter/bounty/" + bounty.company + "/" + bounty.id + "\">" + bounty.name + "</a></td><td class=\"cell\"><a href=\"/_hunter/company/" + bounty.company + "\>" + bounty.company + "</a></td></tr>"

      		$("#recentBountiesBody").append(element);
      	}

      },
      error: function(xhr, status, error)
      {
      }
    });




}, 5000);