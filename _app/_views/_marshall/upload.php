<?php


?>

<!DOCTYPE html>

<html>
  <head>
    <title>BugBounty Post Bounty</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/default.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/upload.css" />

      {{include ('bootstrap_header.php')}}
  </head>
  <body>

    {{include ('header_marshal.php')}}

      <div class="row mainRow" >
            <h1>Post A Bounty</h1>
        <div class="col-lg-4">
           <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span><p id="requiredP">Required Field</p></strong></div>
           <div class="description">
            <p class="infoBox">
                Use this page to post your website to BugBounty. Once posted, your website can be searched by hunters for bugs.
            </p>

            <!--Implement a less janky fix if time allows.-->
            <p id="hidden_box" class="infoBox">BugBounty uses RSS so that hunters can follow marshals they choose.  Hunter's may want to get updates on a certain bounty or be told when a new bounty is posted from a marshal and RSS allows us to do that.  It also allows our content to be posted on a different website.</p>
           </div>
        </div>
        <div class="col-lg-8">
          <form role="form" data-user={{username}} id="createBountyForm">
            <div class="form-group">
                <label for="InputName">Enter Bounty Name</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                  <input type="text" class="form-control" id="bountyTitleForm" placeholder="Bounty Name" required>
                </div>
            </div>
            <div class="form-group">
                <label>Enter Link</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                  <input type="text" class="form-control left" id="bountyLinkForm" name="field"  name="rssCreateCategory" placeholder="URL">
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail">Enter End Date</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon"></span></span>
                  <!-- <input type="text" class="form-control" id="bountyEndDateForm" name="InputEmail" placeholder="YYYY-MM-DD"> -->
                  <input type="date" class="form-control" id="bountyEndDateForm" name="InputEmail" placeholder="YYYY-MM-DD">
                </div>
            </div>
            <div class="form-group">
                <label for="InputMessage">Enter Description</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                  <textarea  id="bountyDescriptionForm" class="form-control" rows="5" required></textarea>
                </div>
            </div>
            <button type="submit" id="bountyCreateSubmit" class="btn btn-primary pull-right submitSomething">Submit</button>
          </form>
        </div>
      </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/bounty_create.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>



    {{include ('bootstrap_footer.php')}}

  </body>

</html>

<!-- <form id="myform">
<label for="field">Required, URL: </label>
<input class="left" id="field" name="field">
<br/>
<input type="submit" value="Validate!">
</form> -->
