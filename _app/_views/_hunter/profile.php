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
                  <p class="form-control formControlCustom">{{user.username}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Name</span>
                  <p class="form-control formControlCustom">{{user.name}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Email</span>
                  <p class="form-control formControlCustom">{{user.email}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Joined</span>
                  <p class="form-control formControlCustom">{{user.dateJoined}}</p>
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
                  <div><p class="form-control formControlCustom">{{user.paymnetType}}</p></div>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Money Collected</span>
                  <p class="form-control formControlCustom">${{user.moneyCollected}}</p>
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

        <div class="col-md-6 tableTop">
         <h3 class="tableTitle">Recent Bounties<h3>
           <table class="w3-table-all" style="width:100%">
            <tbody>
              <tr class="tableHeader">
                <th>Bounty Name</th>
                <th>Company</th>
              </tr>
              {% for bounty in recentBounties %}
              <tr class="tableRow">
                <td><a>{{bounty.name}}</a></td>
                <td><a>{{bounty.company}}</a></td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>

        <div class="col-md-6 tableBottom">
         <h3 class="tableTitle">Submitted Reports<h3>
           <table class="w3-table-all" style="width:100%">
            <tbody>
              <tr>
                <th>Date Submitted</th>
                <th>Bounty Name</th>
                <th>Company</th>
                <th>Paid</th>
                <th>Details</th>
                <th>Response</th>
              </tr>
              {% for report in recentReports %}
              <tr class="tableRow">
                <td>{{report.date}}</td>
                <td>{{report.name}}</td>
                <td>{{report.company}}</td>
                <td>{{report.amountPaid}}</td>
                <td>
                  <button type="button" class="messageButton" data-toggle="modal" 
                  data-target="#detailsModal" data-whatever="@getbootstrap" 
                  data-ID={{report.reportID}}>
                    Click to View
                  </button></td>
                <td>
                  <button type="button" class="messageButton" data-toggle="modal" 
                    data-target="#messageModal" data-whatever="@getbootstrap" 
                    data-ID={{report.reportID}}>
                    Click to View
                  </button>
                </td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>


      </div>

      <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Report Details</h4>
              <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Error:</label>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Description of Error:</label>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Path to Error:</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Message</h4>
               <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Message:</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade changeModal" id="profileChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Change Profile Details</h4>
              <form id="reportForm" data-ID={{bounty.id}} data-username={{username}}>
                <div class="modal-body">
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Username</span>
                    <input type ="text" class="form-control modalInput" id="changeUsernameForm">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Email</span>
                    <input type ="text" class="form-control modalInput" id="changeEmailForm">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Old Password</span>
                    <input type ="password" class="form-control modalInput" id="changePassworldOldForm">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">New Password</span>
                    <input type ="password" class="form-control modalInput" id="changePasswordNewForm">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Confirm Password</span>
                    <input type ="password" class="form-control modalInput" id="changePasswordConfirmForm">
                  </div>
                </div>
              </form>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submitChangeProfile">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="paymentChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Change Payment Details</h4>
              <form id="reportForm" data-ID={{bounty.id}} data-username={{username}}>
                <div class="modal-body">
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Option 1</span>
                    <input type ="text" class="form-control modalInput" id="changePaymentOption1Form">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Option 2</span>
                    <input type ="text" class="form-control modalInput" id="changePaymentOption2Form">
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon addOnCustom">Password</span>
                    <input type ="password" class="form-control modalInput" id="changePaymentPasswordForm">
                  </div>
                </div>
              </form>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submitChangePayment">Submit</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip_hunter_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/hunter_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    {{include ('bootstrap_footer.php')}}    
  </body>
</html>