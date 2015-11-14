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
<!-- 
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
 -->

 {{ include ('header_login.php') }}
    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">

      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <div class="carousel-inner" role="listbox">

        <div class="item active">
          <img class="slidePicture" src="/../_images/_logos/hunter_285x255.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Make Money For Using the Internet!</h1>
              <p>The internet needs people to find problems with their websites.  Put your time on the internet to use by helping our Marshal's find bugs on their websties.
                Best of all?  You get paid!</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Become a hunter</a></p>
            </div>
          </div>
        </div>

        <div class="item">
          <img class="slidePicture" src="/../_images/_logos/marshal_285x255.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Let others find Bugs!</h1>
              <p>All websites have their problems and its hard to find them all in testing.  How about use the power of the internet to let you find those pesky bugs?  Start focusing on more important matters.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Become a Marshall</a></p>
            </div>
          </div>
        </div>

        <div class="item">
          <div class="container">
            <div class="carousel-caption">
              <h1>Still unsure on signing up?</h1>
              <p>Click the button below to get more information about Bug Bounty.  Learn what its like to be a Bounty Hunter or the benefits of posting your websites bug bounties as a marshall.  Bug Bounty is all about making the best use of your time.</p>
              <p><a class="btn btn-lg btn-primary" href="/why" role="button">More Info</a></p>
            </div>
          </div>
        </div>

      </div>

      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">

        <div class="col-md-4">
          <img class="img-circle" src="" alt="Generic placeholder image" width="140" height="140">
          <h2>Heading</h2>
          <p></p>
<!--           <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
        </div>

        <div class="col-md-4">
          <img class="img-circle" src="" alt="Generic placeholder image" width="140" height="140">
          <h2>Heading</h2>
          <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
<!--           <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
        </div>

        <div class="col-md-4">
          <img class="img-circle" src="" alt="Generic placeholder image" width="140" height="140">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
<!--           <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> -->
        </div>

      </div>

    </div><!-- /.container -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/sign_up.js"></script>
    <script type="text/javascript" src="/../_javascript/search_bounty.js"></script>
    <script type="text/javascript" src="/../_javascript/login.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}} 

  </body>

</html>