$(document).ready(function ()
{

  $("#rssCreateSubmit").click(function(event) {

    $("#rssCreateSubmit").attr("disabled", true);

    var rssInfo = {}

    rssInfo["title"] = $("#rssCreateTitle").val();
    rssInfo["category"] = $("#rssCreateCategory").val();
    rssInfo["copyright"] = $("#rssCreateCopyright").val();
    rssInfo["description"] = $("#rssCreateDescription").val();
    rssInfo["url"] = $("#rssCreateWebsite").val();

    console.log(rssInfo);

    $.ajax({
      url: '/api/createRSS',
      type: 'POST',
      dataType: 'json',
      data: rssInfo,
      async: 'true',
      success: function(response) {

      if(response.error == 0) {
        console.log(response);
        window.location = "/_marshal/rssadd/" + response.username;
      }

      }
    });


  });

});
