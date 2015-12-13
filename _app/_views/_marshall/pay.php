<html>
  <head>
    <title>BugBounty Pay</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/pay.css">
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/pay.css">
    <link rel="stylesheet" type="text/css" href="/../_css/options_dropdown.css">

    <link rel="stylesheet" type="text/css" href="/../_css/_modal/default_modal.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/_modal/display_details_modal.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/_modal/message_modal.css" />

    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


      {{include ('bootstrap_header.php')}}
  </head>
  <body>

    {{include ('header_marshal.php')}}

    <div class="row mainRow">
      <div class="col-md-2">
        <h3 class="text-center">Table Options</h3>
        <div id="options">
          <form id="optionForm">
            <ul id="accordion" class="accordion">
              <li class="filter-groups">
                <div class="link">Options<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                  <li class="check-item"><p>UnPaid Reports<input type="checkbox" class="pull-right checkOption" checked value="unPaidOption"></p></li>
                  <li class="check-item"><p>Paid Reports<input type="checkbox" class="pull-right checkOption" checked value="paidOption"></p></li>
                  <li class="check-item"><p>Active Bounties<input type="checkbox" class="pull-right checkOption" checked value="activeOption"></p></li>
                  <li class="check-item"><p>Past Bounties<input type="checkbox" class="pull-right checkOption" checked value="pastOption"></p></li>
                </ul>
              </li>
              <li class="filter-groups">
                <div class="link">Bounties<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                  {% for bounty in bounties %}
                  <li class="check-item"><p class="bountyName">{{bounty}}<input type="checkbox" class="pull-right checkOption" checked value="{{bounty}}"></p></li>
                  {% endfor %}
                </ul>
              </li>
              <li class="filter-groups">
                <div class="link">Messages<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                  <li class="check-item"><p>No Message<input type="checkbox" class="pull-right checkOption" checked value="messageOption"></p></li>
                </ul>
              </li>
              <li>
                <button class="btn btn-default pull-right" id="optionsSubmitForm">Update</button>
              </li>
            </ul>
          </form>
        </div>
      </div>
      <div class="col-md-10">
        <h3>Submitted Reports</h3>
        <div class="tableWrapper">
          <table>
            <thead>
              <tr class="rowTable header">
                <th class="cell">Date Submitted</th>
                <th class="cell">Bounty Name</th>
                <th class="cell">Report Name</th>
                <th class="cell">Details</th>
                <th class="cell">Message</th>
                <th class="cell">Amount</th>
                <th class="cell">Pay</th>
              </tr>
            </thead>
            <tbody id="bodyReports">
              {% for report in submittedReports.result %}
              <tr class="rowTable">
                <td class="cell">{{report.dateSubmitted}}</td>
                <td class="cell"><a href="/_marshal/track/{{report.bountyID}}">{{report.bountyName}}</a></td>
                <td class="cell">{{report.errorName}}</td>
                <td class="cell">
                  <button type="button" class="displayDetailsModal detailsButton" data-toggle="modal"
                  data-target="#displayDetailsModal" data-whatever="@getbootstrap"
                  data-ID={{report.reportID}}>
                    View
                  </button>
                </td>
                <td class="cell">
                  {% if report.paid == 0 %}
                  <button type="button" class="messageButton" data-toggle="modal"
                    data-target="#editMessageModal" data-whatever="@getbootstrap"
                    data-ID={{report.reportID}}>
                    Edit
                  </button>
                  {% else %}
                  <button type="button" class="messageButton" data-toggle="modal"
                    data-target="#messageModal" data-whatever="@getbootstrap"
                    data-ID={{report.reportID}}>
                    View
                  </button>
                  {% endif %}
                </td>
                <td class="cell">
                  <div class="input-group payInput">
                    <span class="input-group-addon">$</span>
                    {% if report.paid == 1 %}
                    <input type ="text" class="form-control payAmountForm" maxlength="11" data-ID="{{report.reportID}}" value="{{report.paidAmount}}" title="Report already paid" disabled>
                    {% elseif report.paidAmount < 0 %}
                    <input type ="text" class="form-control payAmountForm" maxlength="11" data-ID="{{report.reportID}}" value="NA" title="Not approved yet">
                    {% else %}
                    <input type ="text" class="form-control payAmountForm" maxlength="11" value={{report.paidAmount}}
                      data-ID="{{report.reportID}}">
                    {% endif %}
                  </div>
                </td>
                <td class="cell">
                    {% if report.paid == 0 %}
                    <button class="btn btn-success payButton" type="button" value="Pay" data-toggle="modal"
                      data-target="#payModal" data-whatever="@getbootstrap"
                      data-ID={{report.reportID}} data-bountyID={{report.bountyID}} data-hunterUsername={{report.username}}>
                      Pay
                    </button>
<!--                     <form>
                      <div id="paypal-container"></div>
                    </form> -->
                    {% else %}
                    <button data-id={{report.reportID}} class="btn btn-default payButton" type="button" value="Pay" title="Report already paid" disabled>Paid</button>
                    {% endif %}
                </td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>
    </div>

{{include ('_modals/payModal.php')}}
{{include ('_modals/editMessageModal.php')}}
{{include ('_modals/displayDetailsModal.php')}}
{{include ('_modals/messageModal.php')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://js.braintreegateway.com/v2/braintree.js"></script>

    <script>
        var submittedReports = {{ submittedReports.result|json_encode|raw }};
    </script>

    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/_javascript/pay_report.js"></script>
    <script type="text/javascript" src="/_javascript/options_dropdown.js"></script>
    <script type="text/javascript" src="/_javascript/pay_options.js"></script>
    <script type="text/javascript" src="/_javascript/options_filter.js"></script>
    <script type="text/javascript" src="/_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}}

  </body>

</html>
