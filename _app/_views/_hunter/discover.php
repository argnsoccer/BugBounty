<!DOCTYPE html>
<html>
  <head>
      <title>Welcome home</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/discover.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_hunter.php') }}

        <button type="button" class="btn btn-danger btn-xs pull-right" id="closeButton" onclick="closeWall();">
      <span class="glyphicon glyphicon-remove-sign"></span>&nbsp;
    </button>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="box innerRow">
            <div class="container marketing innerRow">
              <div class="innerRow" id="bountyBoard">
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
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[0].poolID}}">{{preferredBounties.result.bounties.result.bounties[0].bountyName}}</a></h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[1].imageLoc}}>
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[1].poolID}}">{{preferredBounties.result.bounties[1].bountyName}}</a></h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[2].imageLoc}}>
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[2].poolID}}">{{preferredBounties.result.bounties[2].bountyName}}</a></h3>
                      </div>
                    </div>

                    <div class="cycle-slideshow" 
                    data-cycle-fx=fade 
                    data-cycle-timeout=3000 
                    data-cycle-caption="#adv-custom-caption"
                    data-cycle-slides="> h3"
                    data-cycle-center-horz=true
                    data-cycle-center-vert=true>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[0].lineDescription}}</h3>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[1].lineDescription}}</h3>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[2].lineDescription}}</h3>
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
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[3].poolID}}">{{preferredBounties.result.bounties[3].bountyName}}</a></h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[4].imageLoc}}>
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[4].poolID}}">{{preferredBounties.result.bounties[4].bountyName}}</a></h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[5].imageLoc}}>
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[5].poolID}}">{{preferredBounties.result.bounties[5].bountyName}}</a></h3>
                      </div>
                    </div>

                    <div class="cycle-slideshow" 
                    data-cycle-fx=fade 
                    data-cycle-timeout=3000 
                    data-cycle-caption="#adv-custom-caption"
                    data-cycle-slides="> h3"
                    data-cycle-center-horz=true
                    data-cycle-center-vert=true>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[3].lineDescription}}</h3>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[4].lineDescription}}</h3>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[5].lineDescription}}</h3>
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
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[6].poolID}}">{{preferredBounties.result.bounties[6].bountyName}}</a></h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[7].imageLoc}}>
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[7].poolID}}">{{preferredBounties.result.bounties[7].bountyName}}</a></h3>
                      </div>
                      <div class="bounty">
                        <img class="img-circle" src={{preferredBounties.result.bounties[8].imageLoc}}>
                        <h3 class="bountyName"><a href="/_hunter/bounty/{{preferredBounties.result.bounties[8].poolID}}">{{preferredBounties.result.bounties[8].bountyName}}</a></h3>
                      </div>
                    </div>

                    <div class="cycle-slideshow" 
                    data-cycle-fx=fade 
                    data-cycle-timeout=3000 
                    data-cycle-caption="#adv-custom-caption"
                    data-cycle-slides="> h3"
                    data-cycle-center-horz=true
                    data-cycle-center-vert=true>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[6].lineDescription}}</h3>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[7].lineDescription}}</h3>
                        <h3 class="bountyDescription">{{preferredBounties.result.bounties[8].lineDescription}}</h3>
                    </div>
                  </div>
      </div>
    </div><!-- /.container -->

          </div>
        </div>
      </div>
      <div class="row mainRow">

        <div class="col-md-4">
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
                rssmikle_frame_width: "450",
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

          <div id="rssBox">
            <a href="http://feed.mikle.com/" target="_blank" style="color:#CCCCCC;">RSS Feed Widget</a>
          </div><!-- end feedwind code -->

        </div>

        <div class="col-md-8">
          <div class="row innerRow">
            <div class="col-md-12">
                <h3>Search For Bounties</h3>
                <p>Hey... so the search capabilities of this website were not implemented for this class.  A proper search would be demanding to make and require a complex algorithm.
            </div>

          </div>

          <div class="row innerRow">
            <div class="col-lg-12">
              <div class="box">
                <h3>Recommended Bounties</h3>
                <div class="tableWrapper">
                  <table>
                    <thead>
                      <tr class="rowTable header">
                      <th class="cell">Bounty Name</th>
                      <th class="cell">Company Name</th>
                      </tr>
                    </thead>
                    <tbody>
                      {% for bounty in recomendedBounties %}
                      <tr class="rowTable">
                        <td class="cell"><a href="/_hunter/bounty/{{bounty.company}}/{{bounty.id}}">{{bounty.name}}</a></td>
                        <td class="cell"><a href="/_hunter/company/{{bounty.company}}">{{bounty.company}}</a></td>
                      </tr>
                      {% endfor %}
                    </tbody>
                  </table>
                  {% if (recommendedBounties is not defined) or (recommendedBounties|length == 0) %}
                  <p id="noBountiesMessage">There are no recommended bounties :(</p>
                  {% endif %}
                </div>
                <p > Much like the search... a recommendation engine was not build due to the scope of this class</p>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-12" class="bottomBox">
            <h3>Recently Posted Bounties</h3>
                <div class="tableWrapper">
                  <table>
                    <thead>
                      <tr class="rowTable header">
                      <th class="cell">Bounty Name</th>
                      <th class="cell">Company Name</th>
                      </tr>
                    </thead>
                    <tbody id="recentBountiesBody">
                    </tbody>
                  </table>
                </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-12" class="bottomBox">
            <h3>How to Find Bounties</h3>
            <p >This section would describe how to find bounties better.  Was decided functionality was more improtant to implemnt then create a nice looking design here.
            </p>
          </div>
        </div>
      </div>

    </div>

{{include ('_modals/basicSeachModal.php')}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script>
      function closeWall() {
        $('#bountyBoard').hide();
        $('#closeButton').hide();
      }
    </script> 

    <script type="text/javascript" src="/../_javascript/_jquery/cycle.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/recent_bounties.js"></script>
    <script type="text/javascript" src="/../_javascript/search_basic.js"></script>

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
