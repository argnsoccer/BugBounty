
<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty Home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/home.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_marshall.php') }}

    <div class="container-fluid">
      <div class="row">

        <div class="col-md-4">
          <div class="box">
            <h3>Upload</h3>
            <p class="description">Upload a new bounty and put those bug hunters to work!  Click below to go to our upload page and get started.</p>
            <form id="uploadButton" action="/_hunter/upload" class="contentSection">
              <input type="submit" value="Upload a New Bounty" />
            </form>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <h3>Track</h3>
            <p class="description">See what the hunters have been doing with your bounties!  Here are your most recent bounties posted, but go to you profile to see them all.</p>
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
            <h3>Pay</h3>
            <p class="description">They have been working hard, now its time to reward them!  Click below to go to our pay page, where you can submit the approved bugs through vimeo or paypal.</p>
            <form id="searchForm" class="contentSection">
              <input type="submit" value="Pay Now!">
            </form>
          </div>
        </div>

      </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
