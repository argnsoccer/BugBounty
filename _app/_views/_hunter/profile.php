<!DOCTYPE html>
<html>
<head>
    <title>BugBounty Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/hunter-profile.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/profile.css" />

    {{include ('bootstrap_header.php')}}
</head>
<body>
    {{include ('header_hunter.php')}}
  <div class="container-fluid">

    <div class="row">

      <div class="col-md-4">
         <div id="picture_upload">
          <img id="profile_picture" src="/../_images/_profiles/_{{username}}/{{username}}_profile.png" alt="Profile Picture" />
          <input type="file" name="profilePicture" />
        </div>
      </div>

      <div class="col-md-4">
        <table class="bountyTable">
          <tr class="tableRow">
            <th>Dummy Company Name</th>
            <th>Dummy Bounty Name</th>
            <th>Dummy Report Number</th>
            <th>Dummy Report Date</th>
            <th>Dummy Paid Date</th>
            <th>Dummy Amount Paid</th>
          </tr>
        </table>
      </div>

      <div class="col-md-4">
        <form id="profileUpdateForm" method="post">
          <div id="profileInfo">
            <input type="text" placeholder="{{username}}" id="updateUsername" class="form-contol"/>
            <input type="email" placeholder="{{email}}" id="updateEmail" />
            <input type="password" placeholder="Old Password" id="updateOldPassword"/>
            <input type="password" placeholder="New Password" id="updateNewPassword"/>
            <input type="password" placeholder="Confirm New Password" id="updateNewPasswordConfirm" />
            <input type="submit" value="Update" id="submitProfileUpdate" />
          </div>
        </form>
      </div>

    </div>

    <div class="row">

      <div class="col-md-8">
         <div id="section2A">
        <table class="headerTable">
          <tr>
            <th>Company Name</th>
            <th>Bounty Name</th>
            <th>Report Number</th>
            <th>Report Date</th>
            <th>Paid Date</th>
            <th>Amount Paid</th>
          </tr>
        </table>

        <table class="paidtable">
          <tr class="tableRow">
            <th>Dummy Company Name</th>
            <th>Dummy Bounty Name</th>
            <th>Dummy Report Number</th>
            <th>Dummy Report Date</th>
            <th>Dummy Paid Date</th>
            <th>Dummy Amount Paid</th>
          </tr>
        </table>
      </div>
      </div>

    </div>

    <div class="row">

      <div class="col-md-12">
        <table class="headerTable">
          <tr>
            <th>Company Name</th>
            <th>Bounty Name</th>
            <th>Report Number</th>
            <th>Report Date</th>
            <th>Paid Date</th>
            <th>Amount Paid</th>
          </tr>
        </table>

        <table class="paidtable">
          <tr class="tableRow">
            <th>Dummy Company Name</th>
            <th>Dummy Bounty Name</th>
            <th>Dummy Report Number</th>
            <th>Dummy Report Date</th>
            <th>Dummy Paid Date</th>
            <th>Dummy Amount Paid</th>
          </tr>
        </table>
      </div>

    </div>


  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="/../_javascript/update_profile.js"></script>
  <script type="text/javascript" src="/../_javascript/logout.js"></script>
  <script type="text/javascript" src="/../_javascript/search_bounty.js"></script>
  {{include ('bootstrap_footer.php')}}    
</body>
</html>