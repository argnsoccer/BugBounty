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
                  <div class="col-xs-4">
                      <img class="step-image" src="/../_images/_icons/marshal-home-post.png" />
                      <h3 class="step-image-label">1. Post</h3>
                  </div>
                  <div class="col-xs-4">
                      <img class="step-image" src="/../_images/_icons/marshal-home-track.png" />
                      <h3 class="step-image-label">2. Track</h3>
                  </div>
                  <div class="col-xs-4">
                      <img class="step-image" src="/../_images/_icons/marshal-home-pay.png" />
                      <h3 class="step-image-label">3. Pay</h3>
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
                        <th class="cell">Report Count</th>
                      </tr>
                      {% for bounty in currentBounties %}
                      <tr class="rowTable">
                        <td class="cell">{{bounty.dateEnding}}</td>
                        <td class="cell"><a href="/_hunter/bounty/{{bounty.id}}">{{bounty.name}}</a></td>
                        <td class="cell">{{bounty.dateCreated}}</td>
                        <td class="cell">{{bounty.number}}</td>
                      </tr>
                      {% endfor %}
                    </tbody>
                  </table>
                  {% if currentBounties|length == 0 %}
                    <p id="noBountiesMessage">You have no bounties, click <a href="/_marshall/upload">here</a> or on Upload in the Nav Bar to make one!</p>
                  {% endif %}
              </div>

            </div>
          </div>

        </div>

        <div class="row mainRow">

          <div class="col-md-5">
              <div id="newsfeed_header">
                  <h3 class="newsfeed_header">My Newsfeed</h3>
                  <button type="button" id="add_post_button" title="Click to add or create an RSS"
                    class="btn btn-default btn-xs newsfeed_header" onclick="onAddRSS();">
                    Add Post</button>
              </div>

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
                  rssmikle_title_sentence: "Posts",
                  rssmikle_title_link: "",
                  rssmikle_title_bgcolor: "#E74C3C",
                  rssmikle_title_color: "#FAFAFA",
                  rssmikle_title_bgimage: "",
                  rssmikle_item_bgcolor: "#59ABE3",
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
            window.location = "/_marshall/rssadd/{{username}}";
          }
          else {
            window.location = "/_marshall/rsscreate/{{username}}";
          }
        }
      </script>

      {{include ('bootstrap_footer.php')}}
  </body>
</html>
