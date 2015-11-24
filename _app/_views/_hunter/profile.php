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
            <input type="image" id="profile_picture" src="{{user.proPic}}" alt="Profile Picture" class="hunterBackground"/>
          </div>
        </div>

        <div class="col-md-5">
         <h3>Recent Bounties<h3>
           <table class="w3-table-all" style="width:100%">
            <tbody>
              <tr>
                <th>Bounty Name</th>
                <th>Company</th>
              </tr>
              {% for report in paidReports %}
              <tr>
                <td>1</td>
                <td>Eve</td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>

        <div class="col-md-4">
          <form id="profileUpdateForm" method="post">
              <input type="text" class="profileInfo" placeholder="{{user.username}}" id="updateUsername" class="form-contol"/>
              <input type="email" class="profileInfo" placeholder="{{user.email}}" id="updateEmail" />
              <input type="password" class="profileInfo" placeholder="Old Password" id="updateOldPassword"/>
              <input type="password" class="profileInfo" placeholder="New Password" id="updateNewPassword"/>
              <input type="password" class="profileInfo" placeholder="Confirm New Password" id="updateNewPasswordConfirm" />
              <button class="btn btn-primary" id="submitUpdateProfile">Update</button>
          </form>
        </div>

      </div>

      <div class="row">
        <div class="col-md-12">
          <h3>Unpaid Reports</h3>
          <table class="w3-table-all" style="width:100%">
            <tbody>
              <tr>
                <th>Bounty Name</th>
                <th>Company</th>
                <th>Report Date</th>    
                <th>Points</th>
              </tr>
              {% for report in unPaidReports %}
              <tr>
                <td>1</td>
                <td>Eve</td>
                <td>Jackson</td>    
                <td>94</td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <h3>Past Reports</h3>
          <table class="w3-table-all" style="width:100%">
            <tbody>
              <tr>
                <th>Bounty Name</th>
                <th>Company</th>
                <th>Report Date</th>
                <th>Action Date</th>
                <th>Message</th>  
                <th>Pay Amount</th>
              </tr>
              {% for report in paidReports %}
              <tr>
                <td>1</td>
                <td>Eve</td>
                <td>Jackson</td>    
                <td>94</td>
              </tr>
              {% endfor %}
            </tbody>
          </table>
        </div>
      </div>


    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip_hunter_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/update_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    {{include ('bootstrap_footer.php')}}    
  </body>
</html>