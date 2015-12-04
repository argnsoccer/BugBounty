
<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty Home</title>
      <link rel="shortcut icon" type="image/x-icon" href="/_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/rss_create.css">

      {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_marshall.php') }}

    <div class="container">
      <div class="row" >
        <div class="col-lg-4">
           <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span><p id="requiredP">Required Field</p></strong></div>
           <div class="description">
            <p class="infoBox">RSS (Rich Site Summary; originally RDF Site Summary; often called Really Simple Syndication), uses a family of standard web feed formats[2] to publish frequently updated information: blog entries, news headlines, audio, video. An RSS document (called "feed", "web feed",[3] or "channel") includes full or summarized text, and metadata, like publishing date and author's name.

            RSS feeds enable publishers to syndicate data automatically. A standard XML file format ensures compatibility with many different machines/programs. RSS feeds also benefit users who want to receive timely updates from favourite websites or to aggregate data from many sites. - <a href="https://en.wikipedia.org/wiki/RSS" target="_blank">Wikipedia</a></p>

            <p class="infoBox">BugBounty uses RSS so that hunters can follow marshals they choose.  Hunter's may want to get updates on a certain bounty or be told when a new bounty is posted from a marshal and RSS allows us to do that.  It also allows our content to be posted on a different website.
           </div>
        </div>
        <div class="col-lg-8">
          <form role="form" data-user={{username}} id="createForm">
            <div class="form-group">
                <label for="InputName">Enter RSS Title</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                  <input type="text" class="form-control" id="rssCreateTitle" placeholder="Enter RSS Title" required>
                </div>
            </div>
            <div class="form-group">
                <label>Enter Category</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon"></span></span>
                  <input type="text" class="form-control"  name="rssCreateCategory" placeholder="Enter RSS Category">
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail">Enter Copyright</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon"></span></span>
                  <input type="text" class="form-control" id="rssCreateCopyright" name="InputEmail" placeholder="Enter Copyright Information">
                </div>
            </div>
            <div class="form-group">
                <label for="InputMessage">Enter Description</label>
                <a type="button" href="/_marshall/rssinfo" class="btn btn-default btn-xs pull-right" target="_blank">
                  More Info
                </a>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                  <textarea  id="rssCreateDescription" class="form-control" rows="5" required></textarea>
                </div>
            </div>
            <button type="submit" id="rssCreateSubmit" class="btn btn-primary pull-right">Submit</button>
          </form>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/rss_create.js"></script>

    {% if rssExists == "1" %}
    <script type="text/javascript">
      function showMessage() {
        $.notify({
          // options
          message: '  RSS Not Yet Created',
          icon: 'glyphicon glyphicon-alert'
          },{
          // settings
          type: 'info',
          placement: {
            from: "top",
            align: "right",
            allow_dismiss: true,
          }
        });
      }
      window.onload = function {
        showMessage();
      }
    </script>
    {% endif %}

    {{include ('bootstrap_footer.php')}}
  </body>
</html>



<!-- <a href="_hunter/profile/{{username}}">Link to Profile Page</a> -->
