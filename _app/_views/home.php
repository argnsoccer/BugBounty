<?php
session_destroy();
session_start();
?>


<html>
<head>
    <title>I ain't afraid of no bugs!</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../_css/home.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="_javascript/login.js"></script>
  <script type="text/javascript" src="_javascript/sign_up.js"></script>
</head>
<body>


<?php require 'header_login.php' ?>

    <div id="banner">
        <span class="vert-align-helper"></span>
        <img id="logo" src="../_images/_logos/logo_285x255.png" />
    </div>
    <div id="content_area">
        <div id="features">
            <table>
                <tr>
                    <td><img class="feature-icon" src="../_images/_icons/marshall-to-hunters.png"/></td>
                    <td class="feature-text">Connect to a large base of bug hunters.</td>
                </tr>
                <tr>
                    <td><img class="feature-icon" src="../_images/_icons/get-paid.png"></td>
                    <td class="feature-text">Get paid for finding bugs.</td>
                </tr>
            </table>
        </div>
          <form id="signUp" class="signUpForm" method="post">
          <input class="signUpForm" type="text" placeholder="Your email" id="signUpEmail">
          <input class="signUpForm" type="text" placeholder="Choose a username" id="signUpUsername">
          <input class="signUpForm" type="password" placeholder="Choose a password" id="signUpPassword">
          <input class="signUpForm" type="submit" value="Sign Up!" id="submitSignUp">
        </form>
    </div>

{{include('footer.php')}}

</body>

</html>