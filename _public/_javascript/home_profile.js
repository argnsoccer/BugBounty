var username = "testHunter1";

$(document).ready(function () {
  var testInfo = {};
  testInfo['username'] = username;
  $.ajax({
    url: '/api/newsfeed',
    data: userInfo,
    dataType: 'json',
    async: 'false',
    type: 'GET',
    success: function(response) {
      
    }
  });
});
