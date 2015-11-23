<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/signup.css">
    <title>Signin Template for Bootstrap</title>
    {{include ('bootstrap_header.php')}}
    <!-- Custom styles for this template -->
  </head>
  <body>
    <!-- {{ include ('header_login.php') }} -->
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading">Please Sign Up!</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Choose a Password" required>
        <label for="confirmPassword" class="sr-only">Password</label>
        <input type="password" id="confirmPassword" class="form-control" placeholder="Confirm your Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" class="accountType" value="hunter"> Hunter
          </label>
          <label>
            <input type="checkbox" class="accountType" value="marshal"> Marshal
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" id="submitSignUp" type="submit">Continue</button>
      </form>
    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/signup.js"></script>
    {{include ('bootstrap_footer.php')}}
  </body>
</html>
