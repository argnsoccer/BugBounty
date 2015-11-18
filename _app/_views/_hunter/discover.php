<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Discover Bounties</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <link rel="stylesheet" type="text/css" href="/../_css/discover.css">
    {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_hunter.php') }}
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
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
                    <h1></h1>
                    <p></p>
                    <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Become a hunter</a></p> -->
                  </div>
                </div>
              </div>

              <div class="item">
                <img class="slidePicture" src="/../_images/_logos/marshal_285x255.png">
                <div class="container">
                  <div class="carousel-caption">
                    <h1></h1>
                    <p></p>
                    <!-- <p><a class="btn btn-lg btn-primary" href="#" role="button">Become a Marshall</a></p> -->
                  </div>
                </div>
              </div>

              <div class="item">
                <div class="container">
                  <div class="carousel-caption">
                    <h1>Still unsure on signing up?</h1>
                    <p></p>
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
          <div class="masthead clearfix">
            <div class="inner">
              <!-- <h3 class="masthead-brand">Cover</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Features</a></li>
                  <li><a href="#">Contact</a></li>
                </ul>
              </nav> -->
            </div>
          </div>
          <div class="inner cover">
            <h1 class="cover-heading">Find Your Marks</h1>
            <p class="lead">Here you can view our most wanted bounties and search for bounties by keyword</p>
            <p class="lead">
              <a href="#" class="btn btn-lg btn-default">Learn more</a>
            </p>
          </div>
          <div class="mastfoot">
            <div class="inner">
              <p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    {{include ('bootstrap_footer.php')}}
  </body>
</html>
