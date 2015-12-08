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
        <div class="col-md-3">
          <div id="picture_upload">
            <input type="image" id="profile_picture" src="{{user.proPic}}" alt="Profile Picture" class="marshalBackground"/>
          </div>
          <div>
          	<button class="btn btn-default btn-sm buttonCustom">Subscribe</button>
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
                  <span class="input-group-addon addOnCustom">Company Name</span>
                  <p class="form-control formControlCustom">{{user.username}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Date Joined</span>
                  <p class="form-control formControlCustom">Active Bounties</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Active Bounties</span>
                  <p class="form-control formControlCustom">{{user.email}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Total Bounties</span>
                  <p class="form-control formControlCustom">{{user.dateJoined}}</p>
                </div>
            </div>
          </form>
        </div>

        <div class="col-md-5 tableTop tableCol">
          <h3 class="tableTitle">Past Bounties</h3>
          <table>
            <thead>
              <tr class="rowTable header">
                <th class="cell">Bounty Name</th>
                <th class="cell">Company</th>
              </tr>
            </thead>
            <tbody>
              {% for bounty in recentBounties %}
              <tr class="rowTable">
                <td class="cell"><a href="/_hunter/bounty/{{bounty.bountyID}}">{{bounty.name}}</a></td>
                <td class="cell"><a href="/_hunter/company/{{bounty.accountID}}">{{bounty.company}}</a></td>
              </tr> 
              {% endfor %}
            </tbody>
          </table>
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
                  <textarea id="errorReport" readonly>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Description of Error:</label>
                  <textarea id="descErrorReport" readonly>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Path to Error:</label>
                  <textarea id="pathErrorReport" readonly>
                  </textarea>
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
                  <textarea id="messageReport" readonly>
                  </textarea>
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
                  <div class="input-group input-group-Modal">
                    <span class="input-group-addon addOnCustom">Username</span>
                    <input type ="text" class="form-control modalInput" id="changeUsernameForm">
                  </div>
                  <div class="input-group input-group-Modal">
                    <span class="input-group-addon addOnCustom">Email</span>
                    <input type ="text" class="form-control modalInput" id="changeEmailForm">
                  </div>
                  <div class="input-group input-group-Modal">
                    <span class="input-group-addon addOnCustom">Old Password</span>
                    <input type ="password" class="form-control modalInput" id="changePassworldOldForm">
                  </div>
                  <div class="input-group input-group-Modal">
                    <span class="input-group-addon addOnCustom">New Password</span>
                    <input type ="password" class="form-control modalInput" id="changePasswordNewForm">
                  </div>
                  <div class="input-group input-group-Modal">
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
                  <div class="input-group input-group-Modal">
                    <span class="input-group-addon addOnCustom">Option 1</span>
                    <input type ="text" class="form-control modalInput" id="changePaymentOption1Form">
                  </div>
                  <div class="input-group input-group-Modal">
                    <span class="input-group-addon addOnCustom">Option 2</span>
                    <input type ="text" class="form-control modalInput" id="changePaymentOption2Form">
                  </div>
                  <div class="input-group input-group-Modal">
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
    <script type="text/javascript" src="/../_javascript/display_message.js"></script>
    <script type="text/javascript" src="/../_javascript/display_report.js"></script>
    <script type="text/javascript" src="/../_javascript/update_payment.js"></script>
    <script type="text/javascript" src="/../_javascript/update_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    {{include ('bootstrap_footer.php')}}    
  </body>
</html>