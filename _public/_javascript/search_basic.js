// function isSet(value)
// {
//   if (value == null || value == '')
//   {
//     alert("Well we can't search for nothing!");
//     return false;
//   }
//   return true;
// }

// $(document).ready(function () {

//   $("#submitSearch").click(function(event) {

//     var testInfo = {};

//     testInfo['mainSearch'] = $("#searchText").val();

//     if(!isSet(testInfo['mainSearch'])) {
//       return false;
//     }

//     alert(testInfo['mainSearch']);

//     $.ajax({
//       url: '/api/basicSearch',
//       data: testInfo,
//       dataType: 'json',
//       async: 'false',
//       type: 'GET',
//       success: function(response)
//       {

//       },
//       error: function(xhr, status, error)
//       {
//       var err = eval("(" + xhr.responseText + ")");
//       //alert("Please Try Again, we had an internal error!");
//       alert(err.message);
//       }
//     });
//   });
// });