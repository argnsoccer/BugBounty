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

    $.ajax({
      url: '/api/createRSS',
      data: rssInfo,
      dataType: 'json',
      async: 'false',
      type: 'POST',
      success: function(response)
      {
        var username = $("#createForm").attr("data-user");
        var link = "/_marshal/rssadd/";
        link = link+username;
        $.notify({
          // options
          message: '  RSS Created',
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
        window.location.assign(link);
      },
      error: function(xhr, status, error)
      {
      var err = eval("(" + xhr.responseText + ")");
      //alert("Please Try Again, we had an internal error!");
      $("#rssCreateSubmit").removeAttr("disabled");
      $.notify({
          // options
          message: err + " \nsomething went wrong, please try again",
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
      }
    });
  });

});
