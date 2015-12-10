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

        <div class="item active hunterBackground">
          <img class="slidePicture" src="/../_images/_logos/hunter_285x255.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Make Money For Using the Internet!</h1>
              <p>The internet needs people to find problems with their websites.  Put your time on the internet to use by helping our Marshal's find bugs on their websties.
                Best of all?  You get paid!</p>
              <p><a class="btn btn-lg btn-primary" href="/_hunter/signup" role="button">Become a Hunter</a></p>
            </div>
          </div>
        </div>

        <div class="item marshalBackground">
          <img class="slidePicture" src="/../_images/_logos/marshal_285x255.png">
          <div class="container">
            <div class="carousel-caption">
              <h1>Let others find Bugs!</h1>
              <p>All websites have their problems and its hard to find them all in testing.  How about use the power of the internet to let you find those pesky bugs?  Start focusing on more important matters.</p>
              <p><a class="btn btn-lg btn-primary" href="/_marshal/signup" role="button">Become a Marshal</a></p>
            </div>
          </div>
        </div>

        <div class="item whiteBackground">
          <img id="slidePicture-Q" src="/../_images/_icons/home_question_mark-formatted.png">
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

      <div id="bountyBoard">

        <div class="row">

          <div class="col-md-4">
            <div class="cycle-slideshow bountyWall" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> div"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[0].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[0].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[1].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[1].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[2].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[2].bountyName}}</h3>
              </div>
            </div>

            <div class="cycle-slideshow" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> h3"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
                <h3 class="bountyDescription">{{result.bounties[0].lineDescription}}</h3>
                <h3 class="bountyDescription">{{result.bounties[1].lineDescription}}</h3>
                <h3 class="bountyDescription">{{result.bounties[2].lineDescription}}</h3>
            </div>
          </div>

          <div class="col-md-4">
            <div class="cycle-slideshow bountyWall" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> div"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[3].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[3].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[4].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[4].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[5].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[5].bountyName}}</h3>
              </div>
            </div>

            <div class="cycle-slideshow" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> h3"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
                <h3 class="bountyDescription">{{result.bounties[3].lineDescription}}</h3>
                <h3 class="bountyDescription">{{result.bounties[4].lineDescription}}</h3>
                <h3 class="bountyDescription">{{result.bounties[5].lineDescription}}</h3>
            </div>
          </div>

          <div class="col-md-4">
            <div class="cycle-slideshow bountyWall" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> div"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[6].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[6].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[7].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[7].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{result.bounties[8].imageLoc}}>
                <h3 class="bountyName">{{result.bounties[8].bountyName}}</h3>
              </div>
            </div>

            <div class="cycle-slideshow" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> h3"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
                <h3 class="bountyDescription">{{result.bounties[6].lineDescription}}</h3>
                <h3 class="bountyDescription">{{result.bounties[7].lineDescription}}</h3>
                <h3 class="bountyDescription">{{result.bounties[8].lineDescription}}</h3>
            </div>
          </div>


        </div>
      </div>

    </div><!-- /.container -->

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <h1>Benefits for a Marshal</h1>
          <h3>Who makes a marshal?</h3>
          <p>Anyone with a website!  Whether you are a start up, a big business, or just a guy in a basement hacking away,
            Running a website is hard.  Making sure all the bugs people find are fixed is part of the difficulty, but 
            BugBounty makes it easier for you.  Here are some of the benefits a Marshal receives by using BugBounty.
          </p>
        </div>
          <div class="col-md-4">
          <div class="cycle-slideshow" 
          data-cycle-fx=fade 
          data-cycle-timeout=3500 
          data-cycle-caption="#adv-custom-caption"
          data-cycle-slides="> div"
          data-cycle-center-horz=true
          data-cycle-center-vert=true>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/marshal_world-formatted.png">
              <p class="marshalBenefit">As a website developer, you cannot always create every error a user or viewer may see.
                So, let the entire world have a way to contact you when they do see that elusive error.  Let the entire internet 
                community make your website better!
              </p>
            </div>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/marshal_target-formatted.png">
              <p class="marshalBenefit">Pin point the exact errors your userbase is experiencing so you can ensure the best user
                experience.  If everyone is experiencing an error, you will quickly loose users.  With a location for them to post to
                you will have quick access to find what errors are the most important to fix.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cycle-slideshow" 
          data-cycle-fx=fade 
          data-cycle-timeout=3700 
          data-cycle-caption="#adv-custom-caption"
          data-cycle-slides="> div"
          data-cycle-center-horz=true
          data-cycle-center-vert=true>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/marshal_people-formatted.png">
              <p class="marshalBenefit">The more people to test your website and find errors with it the better.  
                You can only hire so many employees to test a website.  With BugBounty, you can employ the world
                affordably.  The power of ther internet is at your disposal!
              </p>
            </div>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/marshal_health-formatted.png">
              <p class="marshalBenefit">A second opinion is always important.  When you get diagnosed, always see
                more than one doctor.  Why should you website be any different?  You have had you inhouse doctor take a look.
                Now get that second, third, fourth, infinte opinion!
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="row benefitRow">
        <div class="col-md-4">
          <div class="cycle-slideshow" 
          data-cycle-fx=fade 
          data-cycle-timeout=2900 
          data-cycle-caption="#adv-custom-caption"
          data-cycle-slides="> div"
          data-cycle-center-horz=true
          data-cycle-center-vert=true>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/hunter_money-formatted.png">
              <p class="hunterBenefit">You see whats wrong with websites.  Instead of simply ignoring theses problems, 
                why not report them and get paid for it.  Add to your bank account while you surf the web.  Easy money.
              </p>
            </div>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/hunter_time-formatted.png">
              <p class="hunterBenefit">Let's be honest, you probably spend a lot of time on the internet.  Start benefitting from it!
                You are here anyway, why not capitalize?  You know what they say, time is money!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="cycle-slideshow" 
          data-cycle-fx=fade 
          data-cycle-timeout=3300 
          data-cycle-caption="#adv-custom-caption"
          data-cycle-slides="> div"
          data-cycle-center-horz=true
          data-cycle-center-vert=true>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/hunter_prize-formatted.png">
              <p class="hunterBenefit">Grow you skills on the interent and let companies take notice.  Websites have problems, 
                you find these problems, so build of your repotation so you these companies knwo you are here to help!
              </p>
            </div>
            <div class="benefit">
              <img class="img-circle imageBenefit" src="/../_images/_icons/hunter_tool-formatted.png">
              <p class="hunterBenefit">Whether you have been trained in web technologies or are just an avid user of the internet, 
                you have the skills and tools to help these websites be better.  And as you hunt, these skills will only grow!
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <h1>Benefits for a Hunter</h1>
          <h3>Who makes a Bug Hunter?</h3>
          <p>Literally anyone with an internet connnection.  Websites are targeted at people and the owner's of those websites
            want to keep their user's invested.  But a bug can turn them off from that.  That's why Marshal's are so interested
            in you!  You provide a solution to a problem they themselves can't solve, mass testing and bug reporting!  Here are 
            some of the benefits of being a hunter.
        </div>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/_jquery/cycle.js"></script>
    <script type="text/javascript" src="/../_javascript/sign_up.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    <script type="text/javascript" src="/../_javascript/login.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}} 

  </body>

</html>