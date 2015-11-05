
<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="stylesheet" type="text/css" href="../_css/home-hunter.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
  <body>
    {{ include ('header_logout.php') }}

    <div id="section1">

      <div id="section1A">
        <div class="box">
          <h3>Discover</h3>
          <form id="discoverButton" action="/_hunter/discover" class="contentSection">
            <input type="submit" value="Discover Bounties Now!" />
          </form>
          <p><br>Dicover new bounties now!  Click the link above to get Started or the link in the Navigation Bar!</p>
        </div>
      </div>

      <div id="section1B">
        <div class="box">
          <h3>Track</h3>
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

      <div id="section1C">
        <div class="box">
          <h3>Search</h3>
          <form id="searchForm" class="contentSection">
            <input type="text" name="searchContent">
            <input type="submit" value="Submit Search">
          </form>
        </div>
      </div>

    </div>

    <div id="section2">
    </div>

    <div id="section3">
    </div>
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
