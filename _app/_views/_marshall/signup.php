<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/qtip.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/sign-up.css">
    <title>Signin Template for Bootstrap</title>
    {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_login.php') }}
    <div class="container">
      <div class="row stepRow">
        <div class="col-12-md displayContainer">
          <div id="stepDisplay">
            <span id="step1" class="stepBlock activeStepMarshal">
              <h3 class="headerStep">Step 1</h3>
              <p class="descStep">Basic Details</p>
            </span>
            <span id="step2" class="stepBlock">
              <h3 class="headerStep">Step 2</h3>
              <p class="descStep">More Details</p>
            </span>
            <span id="step3" class="stepBlock">
              <h3 class="headerStep">Step 3</h3>
              <p class="descStep">Payment Details</p>
            </span>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-12-md">

          <form class="form-signin">
            <h2 class="form-signin-heading">Marshal Sign Up!</h2>
            <input type="text" id="signUpUsername" class="form-control" placeholder="Username" autofocus>
            <input type="email" id="signUpEmail" class="form-control" placeholder="Email address">
            <input type="password" id="signUpPassword" class="form-control" placeholder="Choose a Password">
            <input type="password" id="signUpConfirmPassword" class="form-control" placeholder="Confirm your Password">
            <input type="button" class="btn btn-default form-control" value="Company Description" data-toggle="modal" 
            data-target="#descriptionModal" data-whatever="@getbootstrap" id="descButton" style="display:none">

            <button class="btn btn-lg btn-primary btn-block" id="submitSignUp" type="submit">Continue</button>
            <a href="/_hunter/signup">Not a Marshal?</a>
          </form>

        </div>
      </div>
    </div>


    <div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="exampleModalLabel">Company Description</h4>
          </div>
          <div class="modal-body">
             <div class="form-group">
                <label for="recipient-name" class="control-label">Description:</label>
                <textarea class="form-control" id="signUpDescription"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip.js"></script>
        <script type="text/javascript" src="/../_javascript/login.js"></script>
    <script type="text/javascript" src="/../_javascript/marshal_signup.js"></script>
    {{include ('bootstrap_footer.php')}}
  </body>
</html>
