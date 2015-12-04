$(document).ready(function ()
{

  $("#rssAddSubmit").click(function(event) {

    $("#rssAddSubmit").attr("disabled", true);

    var rssInfo = {}

    rssInfo["title"] = $("#rssAddTitle").val();
    rssInfo["category"] = $("#rssAddCategory").val();
    rssInfo["description"] = $("#rssAddDescription").val();

    $.ajax({
      url: '/api/addRSS',
      data: rssInfo,
      dataType: 'json',
      async: 'false',
      type: 'POST',
      success: function(response)
      {
        $.notify({
          // options
          message: "  " + rssInfo["title"] + " Post Added",
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
        $('#rssAddTitle').val('');
        $('#rssAddCategory').val('');
        $('#rssAddDescription').val('');
        $("#rssAddSubmit").removeAttr("disabled");
      },
      error: function(xhr, status, error)
      {
      var err = eval("(" + xhr.responseText + ")");
      //alert("Please Try Again, we had an internal error!");
      $.notify({
          // options
          message: "  " + err + " \nsomething went wrong, please try again",
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
