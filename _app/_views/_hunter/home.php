<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/hunter-home.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_hunter.php') }}

    <div class="container-fluid">
      <div class="row">

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

      <div class="row">

        <div class="col-md-5">
          <h3>Newsfeed</h3>

          <script type="text/javascript">
            document.write(
              '\x3Cscript type="text/javascript" src="' +
              ('https:' == document.location.protocol ? 'https://' : 'http://') +
              'feed.mikle.com/js/rssmikle.js">\x3C/script>'
            );
          </script>
          <script type="text/javascript">
            (function() {
              var params = {
                rssmikle_url: "http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/_rss/_profiles/_testMarshall1/rss_testMarshall1.xml",
                rssmikle_frame_width: "350",
                rssmikle_frame_height: "400",
                frame_height_by_article: "0",
                rssmikle_target: "_blank",
                rssmikle_font: "Arial, Helvetica, sans-serif",
                rssmikle_font_size: "12",
                rssmikle_border: "off",
                responsive: "off",
                rssmikle_css_url: "",
                text_align: "left",
                text_align2: "left",
                corner: "off",
                scrollbar: "on",
                autoscroll: "on",
                scrolldirection: "up",
                scrollstep: "3",
                mcspeed: "20",
                sort: "Off",
                rssmikle_title: "on",
                rssmikle_title_sentence: "BugBounty News",
                rssmikle_title_link: "",
                rssmikle_title_bgcolor: "#59ABE3",
                rssmikle_title_color: "#FAFAFA",
                rssmikle_title_bgimage: "",
                rssmikle_item_bgcolor: "#E74C3C",
                rssmikle_item_bgimage: "",
                rssmikle_item_title_length: "55",
                rssmikle_item_title_color: "#FAFAFA",
                rssmikle_item_border_bottom: "on",
                rssmikle_item_description: "on",
                item_link: "off",
                rssmikle_item_description_length: "150",
                rssmikle_item_description_color: "#666666",
                rssmikle_item_date: "gl1",
                rssmikle_timezone: "Etc/GMT",
                datetime_format: "%b %e, %Y %l:%M %p",
                item_description_style: "text+tn",
                item_thumbnail: "full",
                item_thumbnail_selection: "auto",
                article_num: "15",
                rssmikle_item_podcast: "off",
                keyword_inc: "",
                keyword_exc: ""
              };
              feedwind_show_widget_iframe(params)
            ;})
            ();
          </script>

          <div id="rssBox" style="font-size:10px; text-align:center; width:370px;">
            <a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a>
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
