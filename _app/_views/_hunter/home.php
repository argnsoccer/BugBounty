<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/hunter-home.css">

      <link rel="stylesheet" type="text/css" href="/../_css/_modal/default_modal.css">
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/basic_search_modal.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_hunter.php') }}

      <div class="row mainRow">

        <div class="col-md-7">
          <div class="box">
            <h3>Discover</h3>
            <p class="description">Dicover new bounties now!  Click the link below to get Started or the link in the Navigation Bar!</p>
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
                        <img class="img-circle" src={{preferredBounties.result.bounties[0].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[0].poolID}}">
                            {{preferredBounties.result.bounties[0].bountyName}}
                          </a>
                        </h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[1].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[1].poolID}}">
                            {{preferredBounties.result.bounties[1].bountyName}}
                          </a>
                        </h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[2].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[2].poolID}}">
                            {{preferredBounties.result.bounties[2].bountyName}}
                          </a>
                        </h3>
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
                        <img class="img-circle" src={{preferredBounties.result.bounties[3].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[3].poolID}}">
                            {{preferredBounties.result.bounties[3].bountyName}}
                          </a>
                        </h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[4].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[4].poolID}}">
                            {{preferredBounties.result.bounties[4].bountyName}}
                          </a>
                        </h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[5].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[5].poolID}}">
                            {{preferredBounties.result.bounties[5].bountyName}}
                          </a>
                        </h3>
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
                        <img class="img-circle" src={{preferredBounties.result.bounties[6].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[6].poolID}}">
                            {{preferredBounties.result.bounties[6].bountyName}}
                          </a>
                        </h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[7].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[7].poolID}}">
                            {{preferredBounties.result.bounties[7].bountyName}}
                          </a>
                        </h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[8].imageLoc}}>
                        <h3 class="bountyName">
                          <a href="/_hunter/bounty/{{preferredBounties.result.bounties[8].poolID}}">
                            {{preferredBounties.result.bounties[8].bountyName}}
                          </a>
                        </h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <a class="btn btn-default" href="/_hunter/discover" id="discoverButton">Discover Bounties Now!</a>
          </div>
        </div>

        <div class="col-md-5">
          <div class="box">
            <h3>Track</h3>
            <p class="description">Quickly jump into past bounties!</p>
            <div class="tableWrapper">
              <table>
                <tbody>
                  <tr class="rowTable header">
                    <th class="cell">Date Ending</th>
                    <th class="cell">Bounty Name</th>
                    <th class="cell">Company Name</th>
                    <th class="cell">Pending Reports</th>
                  </tr>
                  {% for bounty in trackBounties.result %}
                  <tr class="rowTable">
                    <td class="cell">{{bounty.dateEnding}}</td>
                    <td class="cell"><a href="/_hunter/bounty/{{bounty.poolID}}">{{bounty.bountyName}}</a></td>
                    <td class="cell"><a href="/_hunter/company/{{bounty.companyUsername}}">{{bounty.companyName}}</a></td>
                    <td class="cell">{{bounty.reportsPending}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>

      <div class="row mainRow">

        <div class="col-md-5">
          <h3>Newsfeed</h3>

           <!-- start feedwind code -->
          <script type="text/javascript">
            document.write(
              '\x3Cscript type="text/javascript" src="'
              + ('https:' == document.location.protocol ? 'https://' : 'http://') + 
              'feed.mikle.com/js/rssmikle.js">\x3C/script>'
            );

            var subscriptions = {{ subscriptions.result|json_encode|raw }};

            console.log(subscriptions);
          </script>

          <script type="text/javascript" src="/../_javascript/rss_display_hunter.js"></script>

          <div style="font-size:10px; text-align:center; width:350px;" id="rssBox">
            <a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a><!--Please display the above link in your web page according to Terms of Service.-->
          </div><!-- end feedwind code -->

        </div>

        <div class="col-md-7">

          <div class="col-md-12" class="bottomBox">
            <h3>New to BugBounty?</h3>
            <p>Bug Bounty is a website where companies pay you for finding bugs in their
              websites.  They post a bounty and you can either come to the site and press
              the report button in the navigation bar when you find a bug or you can
              use our own search bar to find bounties and track them on our site.  Click
              <a href="/why">Why Us</a> in the navigation bar to find out more!  Happy Hunting, get them pesky bugs.
            </p>
          </div>

          <div class="col-md-12" class="bottomBox">
            <h3>Message of the Day</h3>
            <p>{{messageOfDay.result.message}}
            </p>
          </div>
        </div>
      </div>

{{include ('_modals/basicSeachModal.php')}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/_jquery/cycle.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/search_basic.js"></script>

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
