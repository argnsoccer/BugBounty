  <html>
    <head>
      <title>BugBounty Hunting</title>
      <link rel="shortcut icon" type="image/x-icon" href="/../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/hunt.css" />

        {{include ('bootstrap_header.php')}}
    </head>
    <body>

      {{include ('header_hunter.php')}}

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-11">
            <iframe src={{bounty.bountyLink}} name="hunt_frame"></iframe>
            <p>{{bounty.bountyLink}}</p>
          </div>
          <div class="col-xs-1">
            <button type="button" class="btn btn-primary" data-toggle="modal" 
            data-target="#exampleModal" data-whatever="@getbootstrap">Report</button>
            <a href={{bounty.link}} class="btn btn-primary" role="button" target='_blank'>New Tab</a>
          </div>
        </div>
      </div>

      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">New Report</h4>
            </div>
          <form id="reportForm" data-ID={{bounty.id}} data-username={{username}}>
            <div class="modal-body">
              <div class="form-group">
                <label for="recipient-name" class="control-label">Error:</label>
                <input type="text" class="form-control" id="errorName">
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Description of Error:</label>
                <textarea class="form-control" id="errorDescription"></textarea>
              </div>
              <div class="form-group">
                <label for="message-text" class="control-label">Path to Error:</label>
                <textarea class="form-control" id="errorPath"></textarea>
              </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <span class="btn btn-default btn-file">
              Browse <input type="file" id="fileName">
            </span>
            <button type="submit" class="btn btn-primary" id="submitReport">Submit</button>
          </div>
        </div>
      </div>
    </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script type="text/javascript" src="/../_javascript/logout.js"></script>
      <script type="text/javascript" src="/../_javascript/submit_report.js"></script>
      <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
      {{include ('bootstrap_footer.php')}} 


    </body>

  </html>