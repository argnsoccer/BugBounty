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
    <script type="text/javascript" src="_javascript/sign_up.js"></script>

  </head>
  <body>

{{include ('header_login.php')}}
    <div class="section1A" id="divSection1">
      <div id="features">
        <table>
          <tr>
            <td><img class="featureIcon" src="../_images/_icons/marshall-to-hunters.png"/></td>
            <td class="featureText">Connect to a large base of bug hunters.</td>
          </tr>
          <tr>
            <td><img class="featureIcon" src="../_images/_icons/get-paid.png"></td>
            <td class="featureText">Get paid for finding bugs.</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="section2A" id="divSection2A">
      <h3 id="signUpHeader">Sign Up Now!</h3>
      <form id="signUp" class="signUpForm" method="post">
        <input class="signUpForm" type="text" placeholder="Your email" id="signUpEmail">
        <input class="signUpForm" type="text" placeholder="Choose a username" id="signUpUsername">
        <input class="signUpForm" type="password" placeholder="Choose a password" id="signUpPassword">
        
        <span id="radioButtonsForm">
          Hunter<input type="radio" name="accountType" value="hunter" id="signUpHunter" />
          Marshall<input type="radio" name="accountType" value="marshall" id="signUpMarshall"/>
        </span>
        
        <input class="signUpForm" type="submit" value="Sign Up!" id="submitSignUp">
      </form>
    </div>
    
    <div class="section1B" id="divSection1B">
      <p>Wanted</p>
    </div>
    
    <div class="section2B" id="divSection2B">
      <p>Wanted</p>
    </div>
    
    <div class="section3B" id="divSection3B">
      <p>Wanted</p>
    </div>

<!-- {{include('footer.php')}} -->

  </body>

</html>