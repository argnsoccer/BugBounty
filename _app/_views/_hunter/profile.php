<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty Profile</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/hunter-profile.css" />

      {{include ('bootstrap_header.php')}}
  </head>
  <body>

      {{include ('header_hunter.php')}}
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <div id="picture_upload">
            <input type="image" id="profile_picture" src="{{user.proPic}}" alt="Profile Picture" class="hunterBackground"/>
          </div>
        </div>

        <div class="col-md-4">
          <h3>Profile Information</h3>
          <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" 
            data-target="#profileChangeModal" data-whatever="@getbootstrap">
                  Edit
          </button>
          <form id="profileUpdateForm" method="post">
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Username</span>
                  <p class="form-control formControlCustom">{{user.result.username}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Name</span>
                  <p class="form-control formControlCustom">{{user.result.name}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Email</span>
                  <p class="form-control formControlCustom">{{user.result.email}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Joined</span>
                  <p class="form-control formControlCustom">{{user.result.dateJoined}}</p>
                </div>
            </div>
          </form>
          <h3>Payment Information</h3>
          <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal" 
            data-target="#paymentChangeModal" data-whatever="@getbootstrap">
                  Edit
          </button>
           <form id="profileUpdateForm" method="post">
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Payment Type</span>
                  <div><p class="form-control formControlCustom">{{user.result.paymentType}}</p></div>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Money Collected</span>
                  <p class="form-control formControlCustom">$  {{user.result.moneyCollected}}</p>
                </div>
            </div>
          </form>
          <h3>Bounty Information</h3>
           <form id="profileUpdateForm" method="post">
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Reports Filed</span>
                  <p class="form-control formControlCustom">{{user.numReportsFiled}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Reports Approved</span>
                  <p class="form-control formControlCustom">{{user.numReportsApproved}}</p>
                </div>
            </div>
          </form>
        </div>

        <div class="col-md-6">
          <h3 class="tableTitle">Past Bounties</h3>
          <div class="tableWrapper">
            <table>
              <thead>
                <tr class="rowTable header">
                  <th class="cell">Date Ending</th>
                  <th class="cell">Bounty Name</th>
                  <th class="cell">Company</th>
                </tr>
              </thead>
              <tbody>
                {% for bounty in pastBounties.result %}
                <tr class="rowTable">
                  <td class="cell">{{bounty.dateEnding}}</td>
                  <td class="cell"><a href="/_hunter/bounty/{{bounty.poolID}}">{{bounty.bountyName}}</a></td>
                  <td class="cell"><a href="/_hunter/company/{{bounty.ownerUsername}}">{{bounty.companyName}}</a></td>
                </tr> 
                {% endfor %}
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-md-6 tableBottom">
          <h3 class="tableTitle">Submitted Reports</h3>
          <div class="tableWrapper">
            <table>
              <thead>
                <tr class="rowTable header">
                  <th class="cell">Date Submitted</th>
                  <th class="cell">Bounty Name</th>
                  <th class="cell">Company</th>
                  <th class="cell">Paid</th>
                  <th class="cell">Details</th>
                  <th class="cell">Response</th>
                </tr>
              </thead>
              <tbody>
                {% for report in submittedReports.result %}
                <tr class="rowTable">
                  <td class="cell">{{report.dateSubmitted}}</td>
                  <td class="cell"><a href="/_hunter/bounty/{{report.bountyID}}">{{report.bountyName}}</td>
                  <td class="cell"><a href="/_hunter/company/{{report.ownerUsername}}">{{report.companyName}}</a></td>
                  {% if report.paidAmount == -1 %}
                  <td title="Not Approved Yet" class="cell">NA</td>
                  {% else %}
                  <td class="cell">$ {{report.paidAmount}}</td>
                  {% endif %}
                  <td class="cell">
                    <button type="button" class="detailsButton" data-toggle="modal" 
                    data-target="#detailsModal" data-whatever="@getbootstrap" 
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

{{include ('_modals/profileModal.php')}}
{{include ('_modals/paymentModal.php')}}

    </div>

{{include ('_modals/detailModal.php')}}
{{include ('_modals/messageModal.php')}}
{{include ('_modals/basicSeachModal.php')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
        var submittedReports = {{ submittedReports.result|json_encode|raw }};
        console.log(submittedReports);
    </script>
    
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/display_message.js"></script>
    <script type="text/javascript" src="/../_javascript/display_report.js"></script>
    <script type="text/javascript" src="/../_javascript/update_payment.js"></script>
    <script type="text/javascript" src="/../_javascript/update_profile.js"></script> p
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/search_basic.js"></script>

    {{include ('bootstrap_footer.php')}}    
  </body>
</html>