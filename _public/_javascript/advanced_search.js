function isSet(value)
{
  if (value == null || value == '')
  {
    alert("Well we can't search for nothing!");
    return false;
  }
  return true;
}

$(document).ready(function () {

  $("#submitAdvancedSearch").click(function(event) {

    var testInfo = {};

    testInfo['mainSearch'] = $("#searchAdvancedText").val();

    if(!isSet(testInfo['mainSearch'])) {
      return false;
    }

    alert(testInfo['mainSearch']);

    $.ajax({
      url: '/api/advancedSearch',
      data: testInfo,
      dataType: 'json',
      async: 'false',
      type: 'GET',
      success: function(response)
      {

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