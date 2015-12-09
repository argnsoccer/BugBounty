<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty Profile</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/bounty.css" />

      {{include ('bootstrap_header.php')}}
  </head>
  <body>

      {{include ('header_hunter.php')}}

    <div class="container-fluid">
      <div class="row">

        <div class="col-md-7">
          <div class="row innerRow">

            <div class="col-sm-5">
              <div class="row innerRow picRow">
                <div class="col-md-12">
                  <input type="image" id="bountyPicture" src="{{bounty.imageLoc}}" 
                    alt="Bounty Picture" class="marshalBackground"/>
                </div>
              </div>
              <div class="row innerRow">
                <div class="col-md-12">
                  <div id="bountyButtons">
                    <button class="btn btn-success btn-lg buttonCustom center-block" type="button" data-toggle="modal" 
                      data-target="#exampleModal" data-whatever="@getbootstrap">
                      Submit Report
                    </button>
                    <a class="btn btn-default btn-md buttonCustom center-block" href="/_hunter/hunt/{{bounty.id}}" target="_blank">Track Bounty</a>
                    <button class="btn btn-default btn-sm buttonCustom center-block">Subscribe</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-7">
              <h3>Bounty Information</h3>
              <form id="profileUpdateForm" method="post">
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Bounty Name</span>
                      <p class="form-control formControlCustom">{{bounty.bountyName}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Bounty Owner</span>
                      <p class="form-control formControlCustom"><a href="/_hunter/company/{{bounty.companyName}}">{{bounty.companyName}}</a></p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Date Created</span>
                      <p class="form-control formControlCustom">{{bounty.dateCreated}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Date Ending</span>
                      <p class="form-control formControlCustom">{{bounty.dateEnding}}</p>
                    </div>
                </div>
              </form>              
            </div>

          </div>

          <div class="row innerRow">

            <div class="col-md-12">
              <div id="boutyDescription">
                <h3>Bounty Description</h3>
                <p class="form-control" id="bountyDesc">{{bounty.fullDescription}}</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-5 tableBottom">
          <h3 class="tableTitle">Submitted Reports</h3>
          <div class="tableWrapper">
            <table>
              <thead>
                <tr class="rowTable header">
                  <th class="cell">Date Submitted</th>
                  <th class="cell">Paid</th>
                  <th class="cell">Details</th>
                  <th class="cell">Response</th>
                </tr>
              </thead>
                {% for report in recentReports %}
              <tbody>
                <tr class="rowTable">
                  <td class="cell">{{report.date}}</td>
                  <td class="cell">{{report.amountPaid}}</td>
                  <td class="cell">
                    <button type="button" class="detailsButton" data-toggle="modal" 
                    data-target="#detailsModal" data-whatever="@getbootstrap" 
                    data-ID={{report.reportID}}>
                      View
                    </button>
                  </td>
                  <td class="cell">
                    <button type="button" class="messageButton" data-toggle="modal" 
                      data-target="#messageModal" data-whatever="@getbootstrap" 
                      data-ID={{report.reportID}}>
                      View
                    </button>
                  </td>
                </tr> 
                {% endfor %}
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Report Details</h4>
              <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Error:</label>
                  <textarea id="errorReport" readonly>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Description of Error:</label>
                  <textarea id="descErrorReport" readonly>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Path to Error:</label>
                  <textarea id="pathErrorReport" readonly>
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Message</h4>
               <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Message:</label>
                  <textarea id="messageReport" readonly>
                  </textarea>
                </div>
              </div>
            </div>
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



    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip.js"></script>
    <script type="text/javascript" src="/../_javascript/_qtip/qtip_hunter_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/display_message.js"></script>
    <script type="text/javascript" src="/../_javascript/display_report.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
    {{include ('bootstrap_footer.php')}}    
  </body>
</html>