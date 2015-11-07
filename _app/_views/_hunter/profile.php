<!DOCTYPE html>
<html>
<head>
    <title>BugBounty Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="/../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/hunter-profile.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/profile.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/../_javascript/update_profile.js"></script>
</head>
<body>
    {{include ('header_logout.php')}}
    <h1>Edit Your Profile</h1>

    <div id="section1">

      <div id="section1A">
        <div id="picture_upload">
          <img id="profile_picture" src="/../_images/_profiles/_{{username}}/{{username}}_profile.png" alt="Profile Picture" />
          <input type="file" name="profilePicture" />
        </div>
      </div>

      <div id = "section1B">
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

        <div id = "section1C">
        <form id="profileUpdateForm" method="post">
          <div id="profileInfo">
            <input type="text" placeholder="{{username}}" id="updateUsername"/>
            <input type="text" placeholder="{{email}}" id="updateEmail" />
            <input type="password" placeholder="Old Password" id="updateOldPassword"/>
            <input type="password" placeholder="New Password" id="updateNewPassword"/>
            <input type="password" placeholder="Confirm New Password" id="updateNewPasswordConfirm" />
            <input type="submit" value="Update" id="submitProfileUpdate" />
          </div>
        </form>
      </div>

    </div>

    <div id="section2">

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

    <div id="section3">

      <div id="section3A">
         <table class="headerTable">
          <tr>
            <th>Company Name</th>
            <th>Bounty Name</th>
            <th>Expected Pay Date</th>
            <th>Report Number</th>
            <th>Report Date</th>
          </tr>
        </table>

        <table id="currentTable">
          <tr class="tableRow">
            <th>Dummy Company Name</th>
            <th>Dumm Bounty Name</th>
            <th>Dummy Expected Pay Date</th>
            <th>Dummy Report Number</th>
            <th>Dummy Report Date</th>
          </tr>

        </table>
      </div>

    </div>


   <!--  <div id="content_area">
        
    </div> -->
    
</body>
</html>