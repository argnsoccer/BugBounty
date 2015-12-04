
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
      <div class="row hunterBackground">

        <div class="col-md-8">
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
                        <img class="img-circle" src={{bountyArray[0].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[0].bountyName}}</h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{bountyArray[1].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[1].bountyName}}</h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{bountyArray[2].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[2].bountyName}}</h3>
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
                        <h3 class="bountyName">{{preferredBounties.bountyArray[3].bountyName}}</h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{bountyArray[4].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[4].bountyName}}</h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{bountyArray[5].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[5].bountyName}}</h3>
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
                        <h3 class="bountyName">{{preferredBounties.bountyArray[6].bountyName}}</h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{bountyArray[7].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[7].bountyName}}</h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{bountyArray[8].imageLoc}}>
                        <h3 class="bountyName">{{preferredBounties.bountyArray[8].bountyName}}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <a class="btn btn-default" href="/_hunter/discover" id="discoverButton">Discover Bounties Now!</a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="box">
            <h3>Track</h3>
            <p class="description">Quickly jump into past bounties!</p>

            <table>
              <thead>
                <tr>
                  <th>Bounty<br>Name</th>
                  <th>Company<br>Name</th>
                  <th>Last<br>activity</th>
                  <th>Pending<br>Reports</th>
                </tr>
              </thead>
              <tbody>
                {% for bounty in trackBounties %}
                <tr class="pastRow">
                  <td><a href="/_hunter/hunt/{{bounty.id}}">{{bounty.name}}</a></td>
                  <td><a href="/_hunter/hunt/{{trackBounties[0].id}}">{{bounty.company}}</a></td>
                  <td><a href="/_hunter/hunt/{{trackBounties[0].id}}">{{bounty.date}}</a></td>
                  <td><a href="/_hunter/hunt/{{trackBounties[0].id}}">{{bounty.number}}</a></td>
                </tr>
                {% endfor %}
              </tbody>
            </table>

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
                rssmikle_url: "http://www.bugbounty.design/_rss/_profiles/_testMarshall1/rss_testMarshall1.xml",
                rssmikle_frame_width: "350",
                rssmikle_frame_height: "500",
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

          <div id="rssBox" style="font-size:10px; text-align:center; width:400px;">
            <a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a>
          </div><!-- end feedwind code -->

        </div>

        <div class="col-md-7">

          <div class="col-md-12">
            <h3>Updates</h3>
            <p>dfsklajlkshdjkhgsflkdhgkljdfhgkjldhkjfshdakljfhksajdfhkjlasdhksadhkjfhsadkjlfhs
              sdkjfhskldjhfkjlshadkjfhsakljdfhslkdjfhkldjsahfsklajhfkjlsadhfkjasdhfklsajdhfklj
              sfdjklhkjlsadhlkjsadhfkjlsadhkjflhskdljahfkjlashkjlfhdsalkjhfkjlsadhkjfdsjaljfhl
            </p>
          </div>

          <div class="col-md-12">
            <h3>New to BugBounty?</h3>
            <p>Bug Bounty is a website where companies pay you for finding bugs in their
              websites.  They post a bounty and you can either come to the site and press
              the report button in the navigation bar when you find a bug or you can 
              use our own search bar to find bounties and track them on our site.  Click
              <a href="/why">Why Us</a> in the navigation bar to find out more!  Happy Hunting, get them pesky bugs.
            </p>
          </div>
      
        </div>
      </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/_jquery/cycle.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    <script type="text/javascript" src="/../_javascript/advanced_search.js"></script>

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
