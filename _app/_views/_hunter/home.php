
<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/home-hunter.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_hunter.php') }}

    <div class="container-fluid">
      <div class="row">

        <div class="col-md-4">
          <div class="box">
            <h3>Discover</h3>
            <p class="description">Dicover new bounties now!  Click the link above to get Started or the link in the Navigation Bar!</p>
            <a class="btn btn-default" href="/_hunter/discover">Discover Bounties Now!</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <h3>Track</h3>
            <p class="description">Quickly jump into past bounties!</p>

            <div id="myCarousel" class="carousel slide" data-ride="carousel">

              <div class="carousel-inner" role="listbox">

                <div class="item active">
                  <div class="container-trackBounty">
                    <h1>{{trackBounties[0].name}}</h1>
                    <a class="btn btn-lg btn-primary" href="/_hunter/hunt/{{trackBounties[0].id}}" role="button">Hunt Now</a>
                  </div>
                </div>

                <div class="item">
                  <div class="container-trackBounty">
                    <h1>{{trackBounties[1].name}}</h1>
                    <a class="btn btn-lg btn-primary" href="/_hunter/hunt/{{trackBounties[1].id}}" role="button">Hunt Now</a>
                  </div>
                </div>

                <div class="item">
                  <div class="container-trackBounty">
                    <h1>{{trackBounties[2].name}}</h1>
                    <a class="btn btn-lg btn-primary" href="/_hunter/hunt/{{trackBounties[2].id}}" role="button">Hunt Now</a>
                  </div>
                </div>

                <div class="item">
                  <div class="container-trackBounty">
                    <h1>{{trackBounties[3].name}}</h1>
                    <a class="btn btn-lg btn-primary" href="/_hunter/hunt/{{trackBounties[3].id}}" role="button">Hunt Now</a>
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

          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <h3>Search</h3>
            <p class="description">Enter a more advanced search with these options to find exactly the kind of boutnies that suit your style!</p>
            <form id="searchForm" class="form-group">
              <div>
                <label><input type="checkbox"> Option 1A  </label>
                <label><input type="checkbox"> Option 2A</label>
                <label><input type="checkbox"> Option 3A</label>
              </div>
              <div>
                <label><input type="checkbox"> Option 1B</label>
                <label><input type="checkbox"> Option 2B</label>
                <label><input type="checkbox"> Option 3B</label>
              </div>
              <input type="text" id="searchAdvancedText" placeholder="Search Now!">
              <button type="submit" class="btn btn-default" id="submitAdvancedSearch">Submit Search</button>
            </form>
          </div>
        </div>

      </div>

      <div class="row">

        <div class="col-md-8">
          <div class="col-md-8">
            <h3>New to BugBounty?</h3>
            <p>Bug Bounty is a website where companies pay you for finding bugs in their
              websites.  They post a bounty and you can either come to the site and press
              the report button in the navigation bar when you find a bug or you can 
              use our own search bar to find bounties and track them on our site.  Click
              "Why Us" in the navigation bar to find out more!  Happy Hunting, get them pesky bugs.
            </p>
          </div>
          <div class="col-md-8">
            <h3>Updates</h3>
            <p>dfsklajlkshdjkhgsflkdhgkljdfhgkjldhkjfshdakljfhksajdfhkjlasdhksadhkjfhsadkjlfhs
              sdkjfhskldjhfkjlshadkjfhsakljdfhslkdjfhkldjsahfsklajhfkjlsadhfkjasdhfklsajdhfklj
              sfdjklhkjlsadhlkjsadhfkjlsadhkjflhskdljahfkjlashkjlfhdsalkjhfkjlsadhkjfdsjaljfhl
            </p>
          </div>
          
        </div>

        <div class="col-md-4">
          <h3>Newsfeed</h3>
          <p>Stay up to date!</p>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
        </div>
      </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    <script type="text/javascript" src="/../_javascript/advanced_search.js"></script>

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
