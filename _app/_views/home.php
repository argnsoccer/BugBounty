  <?php
  session_destroy();
  session_start();
  ?>

<html>
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/home.css">

    {{include ('bootstrap_header.php')}}
  </head>
  <body>

  {{ include ('header_login.php') }}

  <div class="container-fluid">
    <div class="row">

      <div class="col-sm-4">
        <h3>Hunters, Make Some Moeny For Using the Internet!</h3>
        <table>
          <tr>
            <td><img class="featureIcon" src="../_images/_icons/marshall-to-hunters.png"/></td>
            <td class="featureText">Get paid to discover problems on peoples websites.</td>
          </tr>
          <tr>
            <td><img class="featureIcon" src="../_images/_icons/get-paid.png"></td>
            <td class="featureText">Pick projects and websites you want to spend time on.</td>
          </tr>
        </table>
      </div>

      <div class="col-sm-4">
        <h3>Marshalls, use th Power of the People to Find Bugs!</h3>
        <table>
          <tr>
            <td><img class="featureIcon" src="../_images/_icons/marshall-to-hunters.png"/></td>
            <td class="featureText">Connect to a large base of bug hunters.</td>
          </tr>
          <tr>
            <td><img class="featureIcon" src="../_images/_icons/get-paid.png"></td>
            <td class="featureText">Spend less time focussing on finding problems.</td>
          </tr>
        </table>
      </div>

      <div class="col-sm-4">
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

    </div>

    <div class="row" id="bountyBoard">

      <div class="col-sm-4">
        <p>Wanted</p>
      </div>

      <div class="col-sm-4">
        <p>Wanted</p>
      </div>

      <div class="col-sm-4">
        <p>Wanted</p>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="/../_javascript/sign_up.js"></script>
  <script type="text/javascript" src="/../_javascript/search_bounty.js"></script>
  <script type="text/javascript" src="/../_javascript/login.js"></script>
  <script type="text/javascript" src="/../_javascript/logout.js"></script>
  {{include ('bootstrap_footer.php')}} 


  </body>

</html>