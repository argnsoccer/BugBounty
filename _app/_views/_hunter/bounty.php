<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty Profile</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/bounty.css" />

      <link rel="stylesheet" type="text/css" href="/../_css/_modal/default_modal.css" />
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/display_details_modal.css" />
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/message_modal.css" />

      {{include ('bootstrap_header.php')}}
  </head>
  <body>

      {{include ('header_hunter.php')}}

      <div class="row mainRow">

        <div class="col-md-7">
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
                    {% if bounty.expired == 0 %}
                    <button class="btn btn-success btn-lg buttonCustom center-block" type="button" data-toggle="modal" 
                      data-target="#submitReportModal" data-whatever="@getbootstrap">
                      Submit Report
                    </button>
                    {% else %}
                    <button class="btn btn-default btn-lg buttonCustom center-block" type="button" disabled>
                      Report Expired
                    </button>
                    {% endif %}

                    <a class="btn btn-default btn-md buttonCustom center-block" title="Link to Website" href="{{bounty.result.bountyLink}}" target="_blank">Track Bounty</a>
                    <button class="btn btn-default btn-sm buttonCustom center-block" title="Subscribe to Company RSS" id="subscribeButton">Subscribe</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-7">
              <h3>Bounty Information</h3>
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
                      <span class="input-group-addon addOnCustom">Bounty Owner</span>
                      <p class="form-control formControlCustom"><a href="/_hunter/company/{{bounty.result.companyUsername}}">{{bounty.result.companyName}}</a></p>
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
                      <span class="input-group-addon addOnCustom">Date Ending</span>
                      <p class="form-control formControlCustom">{{bounty.result.dateEnding}}</p>
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

        <div class="col-md-5 tableBottom">
          <h3 class="tableTitle">Submitted Reports</h3>
          <div class="tableWrapper">
            <table>
              <thead>
                <tr class="rowTable header">
                  <th class="cell">Date Submitted</th>
                  <th class="cell">Paid</th>
                  <th class="cell">Details</th>
                  <th class="cell">Response</th>
                </tr>
              </thead>
              <tbody id="submitedReports">
                {% for report in submittedReports.result %}
                {% if report.index!= 0 %}
                <tr class="rowTable">
                {% else %}
                <tr class="rowTable" id="firstValue">
                {% endif %}
                  <td class="cell">{{report.dateSubmitted}}</td>
                  {% if report.paidAmount == -1 %}
                  <td title="Not Approved Yet" class="cell">NA</td>
                  {% else %}
                  <td class="cell">$ {{report.paidAmount}}</td>
                  {% endif %}
                  <td class="cell">
                    <button type="button" class="detailsButton" data-toggle="modal" 
                    data-target="#displayDetailsModal" data-whatever="@getbootstrap" 
                    data-ID={{report.reportID}}>
                      View
                    </button>
                  </td>
                  <td class="cell">
                    <button type="button" class="messageButton" data-toggle="modal" 
                      data-target="#messageModal" data-whatever="@getbootstrap" 
                      data-ID={{report.reportID}}>
                      View
                    </button>
                  </td>
                </tr> 
                {% endfor %}
              </tbody>
            </table>
          </div>
        </div>

      </div>


{{include ('_modals/submitReportModal.php')}}
{{include ('_modals/displayDetailsModal.php')}}
{{include ('_modals/messageModal.php')}}
{{include ('_modals/basicSeachModal.php')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        var submittedReports = {{ submittedReports.result|json_encode|raw }};
    </script>

    <script type="text/javascript" src="/../_javascript/_qtip/qtip.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/submit_report.js"></script>
    <script type="text/javascript" src="/../_javascript/display_message.js"></script>
    <script type="text/javascript" src="/../_javascript/subscribe.js"></script>
    <script type="text/javascript" src="/../_javascript/display_report.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/search_basic.js"></script>
    {{include ('bootstrap_footer.php')}}    
  </body>
</html>