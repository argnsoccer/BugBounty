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
      {{ include ('header_marshall.php') }}
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-8">
            <div class="box">
              <h3>Post a bounty</h3>

          </div>
          </div>

          <div class="col-md-4">
            <div class="box">
              <h3>Track</h3>
              <p class="description">Quickly jump into past bounties!</p>
              <table>
                <tbody>
                  <tr class="rowTable header">
                    <th class="cell">Bounty Name</th>
                    <th class="cell">Company Name</th>
                    <th class="cell">Last Activity</th>
                    <th class="cell">Pending Reports</th>
                  </tr>
                  {% for bounty in trackBounties %}
                  <tr class="rowTable">
                    <td class="cell"><a href="/_hunter/bounty/{{bounty.id}}">{{bounty.name}}</a></td>
                    <td class="cell"><a href="/_hunter/company/{{bounty.company}}">{{bounty.company}}</a></td>
                    <td class="cell">{{bounty.date}}</td>
                    <td class="cell">{{bounty.number}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-md-5">
              <div id="newsfeed_header">
                  <h3 class="newsfeed_header">My Newsfeed</h3>
                  <button type="button" id="add_post_button" class="btn btn-default btn-xs newsfeed_header">Add Post</button>
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
              <p>dfsklajlkshdjkhgsflkdhgkljdfhgkjldhkjfshdakljfhksajdfhkjlasdhksadhkjfhsadkjlfhs
                sdkjfhskldjhfkjlshadkjfhsakljdfhslkdjfhkldjsahfsklajhfkjlsadhfkjasdhfklsajdhfklj
                sfdjklhkjlsadhlkjsadhfkjlsadhkjflhskdljahfkjlashkjlfhdsalkjhfkjlsadhkjfdsjaljfhl
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
    <!--{{ include ('header_marshall.php') }}

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

    {{include ('bootstrap_footer.php')}}-->
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
