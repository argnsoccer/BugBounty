<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty Home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/marshal-home.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
      {{ include ('header_marshal.php') }}
        <div class="row mainRow">

          <div class="col-md-7">
            <div class="box">
              <h3>Post a bounty</h3>
              <div class="row innerRow image-container">
                  <div class="col-xs-4 card effect__hover">
                      <div class="card__front">
                          <img class="step-image" src="/../_images/_icons/marshal-home-post.png" />
                          <h3 class="step-image-label">1. Post</h3>
                      </div>
                      <div class="card__back">
                          <p class="step-desc">Post a bounty for your website so hunters can search it for bugs.</p>
                      </div>
                  </div>
                  <div class="col-xs-4 card effect__hover">
                      <div class="card__front">
                          <img class="step-image" src="/../_images/_icons/marshal-home-track.png" />
                          <h3 class="step-image-label">2. Track</h3>
                      </div>
                      <div class="card__back">
                          <p class="step-desc">Track your bounties to see if hunters have found bugs in them.</p>
                      </div>
                  </div>
                  <div class="col-xs-4 card effect__hover">
                      <div class="card__front">
                          <img class="step-image" src="/../_images/_icons/marshal-home-pay.png" />
                          <h3 class="step-image-label">3. Pay</h3>
                      </div>
                      <div class="card__back">
                          <p class="step-desc">Pay hunters for the bugs they've found.</p>
                      </div>
                  </div>

              </div>
          </div>
          </div>

          <div class="col-md-5">
            <div class="box">
              <h3>My Active Bounties</h3>
              <p class="description">The bounties hunters are tracking of yours</p>
              <div class="tableWrapper">
                  <table>
                    <tbody>
                      <tr class="rowTable header">
                        <th class="cell">Date Ending</th>
                        <th class="cell">Bounty Name</th>
                        <th class="cell">Date Created</th>
                      </tr>
                      {% for bounty in activeBounties.result %}
                      <tr class="rowTable">
                        <td class="cell">{{bounty.dateEnding}}</td>
                        <td class="cell"><a href="/_marshal/track/{{bounty.poolID}}">{{bounty.bountyName}}</a></td>
                        <td class="cell">{{bounty.dateCreated}}</td>
                      </tr>
                      {% endfor %}
                    </tbody>
                  </table>
                  {% if activeBounties.result|length == 0 %}
                    <p id="noBountiesMessage">You have no bounties, click <a href="/_marshal/upload">here</a> or on Upload in the Nav Bar to make one!</p>
                  {% endif %}
              </div>

            </div>
          </div>

        </div>

        <div class="row mainRow">

          <div class="col-md-4">
              <div id="newsfeed_header">
                  <h3 class="newsfeed_header">My Newsfeed</h3>
                  <button type="button" id="add_post_button" title="Click to add or create an RSS"
                    class="btn btn-default btn-xs newsfeed_header" onclick="onAddRSS();">
                    Add Post</button>
              </div>
           <!-- start feedwind code -->
          <script type="text/javascript">
            document.write(
              '\x3Cscript type="text/javascript" src="'
              + ('https:' == document.location.protocol ? 'https://' : 'http://') +
              'feed.mikle.com/js/rssmikle.js">\x3C/script>'
            );

            var myLink = {{rssExists.result.link|json_encode|raw }};

            console.log(myLink);

          </script>

          <script type="text/javascript" src="/../_javascript/rss_display_marshal.js"></script>

          <div style="font-size:10px; text-align:center; width:350px;" id="rssBox">
            <a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a><!--Please display the above link in your web page according to Terms of Service.-->
          </div><!-- end feedwind code -->

          </div>

          <div class="col-md-8">

            <div class="col-md-12" class="bottomBox">
              <h3>New to BugBounty?</h3>
              <p>Bug Bounty is a website where you post your websites and allow our bug hunters find
                the problems you cannot get your hands on.  When you post a bounty, hunters then have a place
                to let you know when they discover something is wrong.  Whehter they are passivly using the internet
                or hell bent on breaking your site, it allows you to find bugs you couldn't before.  To incentivize
                hunters, you can choose to pay them for their hard work. Click
                <a href="/why">Why Us</a> in the navigation bar to find out more!
              </p>
            </div>

            <div class="col-md-12" class="bottomBox">
              <h3>Message of the Day</h3>
              <p>{{messageOfDay.message}}
              </p>
            </div>

          </div>
        </div>




      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script type="text/javascript" src="/../_javascript/_jquery/cycle.js"></script>
      <script type="text/javascript" src="/../_javascript/logout.js"></script>
      <script type="text/javascript" src="/../_javascript/search_basic.js"></script>
      <script type="text/javascript" src="/../_javascript/advanced_search.js"></script>

      <script>
        function onAddRSS() {
          if({{rssExists.result.exists}} == 1) {
            window.location = "/_marshal/rssadd/{{username}}";
          }
          else {
            window.location = "/_marshal/rsscreate/{{username}}";
          }
        }
      </script>

      {{include ('bootstrap_footer.php')}}
  </body>
</html>
