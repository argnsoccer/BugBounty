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
                <img class="img-circle" src={{bountyArray[0].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[0].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{bountyArray[1].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[1].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{bountyArray[2].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[2].bountyName}}</h3>
              </div>
            </div>

            <div class="cycle-slideshow" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> div"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[0].lineDescription}}</h3>
              </div>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[1].lineDescription}}</h3>
              </div>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[2].lineDescription}}</h3>
              </div>
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
                <img class="img-circle" src={{bountyArray[3].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[3].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{bountyArray[4].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[4].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{bountyArray[5].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[5].bountyName}}</h3>
              </div>
            </div>

            <div class="cycle-slideshow" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> div"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[3].lineDescription}}</h3>
              </div>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[4].lineDescription}}</h3>
              </div>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[5].lineDescription}}</h3>
              </div>
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
                <img class="img-circle" src={{bountyArray[6].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[6].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{bountyArray[7].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[7].bountyName}}</h3>
              </div>
              <div class="bounty">
                <img class="img-circle" src={{bountyArray[8].imageLoc}}>
                <h3 class="bountyName">{{bountyArray[8].bountyName}}</h3>
              </div>
            </div>

            <div class="cycle-slideshow" 
            data-cycle-fx=fade 
            data-cycle-timeout=3000 
            data-cycle-caption="#adv-custom-caption"
            data-cycle-slides="> div"
            data-cycle-center-horz=true
            data-cycle-center-vert=true>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[6].lineDescription}}</h3>
              </div>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[7].lineDescription}}</h3>
              </div>
              <div class="bounty">
                <h3 class="bountyDescription">{{bountyArray[8].lineDescription}}</h3>
              </div>
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
              <img class="img-circle imageBenefit" src="/../_images/_icons/hunter_time-formatted.png">
              <p class="hunterBenefit">Let's be honest, you probably spend a lot of time on the internet.  Start benefitting from it!
                You are here anyway, why not capitalize?
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
                You are here anyway, why not capitalize?
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
    <script type="text/javascript" src="/../_javascript/_jquery/cycle.js"></script>
    <script type="text/javascript" src="/../_javascript/sign_up.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    <script type="text/javascript" src="/../_javascript/login.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}} 

  </body>

</html>