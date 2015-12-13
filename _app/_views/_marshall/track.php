<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/default.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/track.css" />

    <link rel="stylesheet" type="text/css" href="/../_css/_modal/default_modal.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/_modal/display_details_modal.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/_modal/message_modal.css" />

    {{include ('bootstrap_header.php')}}
  </head>
  <body>

    {{ include ('header_marshal.php') }}

      <div class="row mainRow">

        <div class="col-md-6">
          <div class="row innerRow">

            <div class="col-sm-5">
              <div class="row innerRow picRow">
                <div class="col-md-12">
                  <input type="image" id="imagePicture" src="{{bounty.result.imageLoc}}" 
                    alt="Bounty Picture" class="marshalBackground"/>
                </div>
              </div>
              <div class="row innerRow">
                <div class="col-md-12">
                  <div id="bountyButtons">
                    <a class="btn btn-default btn-md buttonCustom center-block" title="Link to Website" href="{{bounty.result.bountyLink}}" target="_blank">Link</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-7">
              <h3>Bounty Information</h3>
              <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal"
                data-target="#profileChangeModal" data-whatever="@getbootstrap">
                      Edit
              </button>
              <form id="profileUpdateForm" method="post">
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Bounty Name</span>
                      <p class="form-control formControlCustom">{{bounty.result.bountyName}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Date Ending</span>
                      <p class="form-control formControlCustom">{{bounty.result.dateEnding}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Date Created</span>
                      <p class="form-control formControlCustom">{{bounty.result.dateCreated}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Reports</span>
                      <p class="form-control formControlCustom">{{numReports}}</p>
                    </div>
                </div>
              </form>            
            </div>

          </div>

          <div class="row innerRow">

            <div class="col-md-12">
              <div id="boutyDescription">
                <h3>Bounty Description</h3>
                <p class="form-control" id="bountyDesc">{{bounty.result.fullDescription}}</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-6 tableBottom">
        <h3>Submitted Reports</h3>
        <div class="tableWrapper">
          <table>
            <thead>
              <tr class="rowTable header">
                <th class="cell">Date Submitted</th>
                <th class="cell">Report Name</th>
                <th class="cell">Details</th>
                <th class="cell">Message</th>
                <th class="cell">Amount</th>
                <th class="cell">Save</th>
              </tr>
            </thead>
            <tbody id="bodyReports">
              {% for report in submittedReports.result %}
              <tr class="rowTable">
                <td class="cell">{{report.dateSubmitted}}</td>
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
                    <button class="btn btn-success savePayButton" type="button" data-toggle="modal" 
                      data-target="#payModal" data-whatever="@getbootstrap"
                      data-ID={{report.reportID}} data-bountyID={{report.bountyID}} data-hunterUsername={{report.username}}>
                      Save
                    </button>
<!--                     <form>
                      <div id="paypal-container"></div>
                    </form> -->
                    {% else %}
                    <button data-id={{report.reportID}} class="btn btn-success saveButton" type="button" title="Report already paid" disabled>Paid</button>
                    {% endif %}
                </td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
        </div>

      </div>

{{include ('_modals/editMessageModal.php')}}
{{include ('_modals/displayDetailsModal.php')}}
{{include ('_modals/messageModal.php')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        var submittedReports = {{ submittedReports.result|json_encode|raw }};
    </script>

    <script type="text/javascript" src="/../_javascript/_qtip/qtip.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/display_message.js"></script>
    <script type="text/javascript" src="/../_javascript/display_report.js"></script>

    <script type="text/javascript" src="/../_javascript/save_payment.js"></script>    

    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}}

  </body>
</html>
