$(document).ready(function () {
  $('#optionsSubmitForm').click(function(event) {
    var groups = [];
    var checked = [];
    var unchecked = [];
    $('.filter-groups').each(function() {
      $(this).find('li.check-item').each(function() {
        $(this).find('input:checkbox:not(:checked)').each(function () {
          unchecked.push($(this).parent().text());
        });
        $(this).find('input:checked').each(function () {
          checked.push($(this).parent().text());
        });
      });
      groups.push($(this));
    });

    for (var item of checked) {
      //console.log(item);
      $('#bodyReports').each(function() {
        $('.rowTable > td.cell').each(function() {
          if ($(this).text() === item) {
            $(this).parent().show();
          }
        });
      });
    }

    for (var item of unchecked) {
      //console.log(item);
      $('#bodyReports').each(function() {
        $('.rowTable > td.cell').each(function() {
          if ($(this).text() === item) {
            $(this).parent().hide();
          } else {
            if (item === 'UnPaid Reports') {
              console.log('in else statement');
              $(this).find('input.payAmountForm').each(function() {
                console.log($(this).attr('title'));
                if ($(this).attr('title') === 'Not approved yet') {
                  $(this).parent().parent().parent().hide();
                }
              });
            } else if (item === 'Paid Reports') {
              $(this).find('input.payAmountForm').each(function() {
                if ($(this).attr('title') === 'Report already paid') {
                  $(this).parent().parent().parent().hide();
                }
              });
            }
          }
        });
      });
    }
    console.log(unchecked);
    //console.log(checked);
  });
});
