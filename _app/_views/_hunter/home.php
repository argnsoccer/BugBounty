
<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/home.css">

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
            <form id="discoverButton" action="/_hunter/discover" class="contentSection">
              <input type="submit" value="Discover Bounties Now!" />
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <h3>Track</h3>
            <p class="description">Quickly jump into past bounties!</p>
            <table id="trackTable" class="contentSection">
              <tr>
                <td><a href="https://www.google.com">Google 1</a></td>
              </tr>
              <tr>
                <td><a href="https://www.google.com">Google 2</a></td>
              </tr>
              <tr>
                <td><a href="https://www.google.com">Google 3</a></td>
              </tr>
              <tr>
                <td><a href="https://www.google.com">Google 4</a></td>
              </tr>
            </table>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <h3>Search</h3>
            <p class="description">Enter a more advanced search with these options to find exactly the kind of boutnies that suit your style!</p>
            <form id="searchForm" class="contentSection">
              <input type="text" name="searchContent" placeholder="Search Now!">
              <input type="submit" value="Submit Search">
            </form>
          </div>
        </div>

      </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/search_bounty.js"></script>

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
