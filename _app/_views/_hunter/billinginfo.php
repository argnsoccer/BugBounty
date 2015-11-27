<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/billinginfo.css">
    <title>Signin Template for Bootstrap</title>
    {{include ('bootstrap_header.php')}}
    <!-- Custom styles for this template -->
  </head>
  <body>
    <!-- {{ include ('header_login.php') }} -->
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">Please Sign Up!</h2>
        <label for="inputFirstName" class="sr-only">First Name</label>
        <input type="text" id="inputFirstName" class="form-control" placeholder="First Name" required autofocus>
        <label for="inputLastName" class="sr-only">Last Name</label>
        <input type="text" id="inputLastName" class="form-control" placeholder="Last Name" required autofocus>
        <label for="inputAddress" class="sr-only">Street Address</label>
        <input type="text" id="inputAddress" class="form-control" placeholder="Street Address" required>
        <label for="inputCity" class="sr-only">City</label>
        <input type="text" id="inputCity" class="form-control" placeholder="City" required>
        <button class="btn btn-lg btn-primary btn-block" id="submitSignUp" type="submit">Continue</button>
      </form>
    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="/../_javascript/signup.js"></script> -->
    {{include ('bootstrap_footer.php')}}
  </body>
</html>
