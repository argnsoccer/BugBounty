<?php


?>

<!DOCTYPE html>

<html>
  <head>
    <title>BugBounty Upload Bounty</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/default.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/upload.css" />

      {{include ('bootstrap_header.php')}}
  </head>
  <body>

    {{include ('header_marshall.php')}}

    <h1>Upload Content</h1>

    {{ include ('header_marshall.php') }}

    <div class="container">
      <div class="row" >
        <div class="col-lg-4">
           <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span><p id="requiredP">Required Field</p></strong></div>
           <div class="description">
            <p class="infoBox">
                Once upon a time, there was a racist tree. Seriously, you are going to hate this tree. High on a hill overlooking the town, the racist tree grew where the grass was half clover. Children would visit during the sunlit hours and ask for apples, and the racist tree would shake its branches and drop the delicious red fruit that gleamed without being polished. The children ate many of the racist tree's apples and played games beneath the shade of its racist branches. One day the children brought Sam, a boy who had just moved to town, to play around the racist tree.
"Let Sam have an apple," asked a little girl.
"I don't think so. He's black," said the tree. This shocked the children and they spoke to the tree angrily, but it would not shake its branches to give Sam an apple, and it called him a nigger.
"I can't believe the racist tree is such a racist," said one child. The children momentarily reflected that perhaps this kind of behavior was how the racist tree got its name.
It was decided that if the tree was going to deny apples to Sam then nobody would take its apples. The children stopped visiting the racist tree.
The racist tree grew quite lonely. After many solitary weeks it saw a child flying a kite across the clover field.
"Can I offer you some apples?" asked the tree eagerly.
"Fuck off, you goddamn Nazi," said the child.
The racist tree was upset, because while it was very racist, it did not personally subscribe to Hitler's fascist ideology. The racist tree decided that it would have to give apples to black children, not because it was tolerant, but because otherwise it would face ostracism from white children.
And so, social progress was made.
             <a href="https://en.wikipedia.org/wiki/RSS" target="_blank">Wikipedia</a></p>

            <!--Implement a less janky fix if time allows.-->
            <p id="hidden_box" class="infoBox">BugBounty uses RSS so that hunters can follow marshals they choose.  Hunter's may want to get updates on a certain bounty or be told when a new bounty is posted from a marshal and RSS allows us to do that.  It also allows our content to be posted on a different website.</p>
           </div>
        </div>
        <div class="col-lg-8">
          <form role="form" data-user={{username}} id="createForm">
            <div class="form-group">
                <label for="InputName">Enter Bounty Name</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                  <input type="text" class="form-control" id="rssCreateTitle" placeholder="Bounty Name" required>
                </div>
            </div>
            <div class="form-group">
                <label>Enter Link</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon"></span></span>
                  <input type="text" class="form-control"  name="rssCreateCategory" placeholder="URL">
                </div>
            </div>
            <div class="form-group">
                <label for="InputEmail">Enter End Date</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon"></span></span>
                  <input type="text" class="form-control" id="rssCreateWebsite" name="InputEmail" placeholder="MM/DD/YYYY">
                </div>
            </div>
            <div class="form-group">
                <label for="InputMessage">Enter Description</label>
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
