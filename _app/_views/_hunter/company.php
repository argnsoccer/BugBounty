<!DOCTYPE html>
<html>
  <head>
      <title>BugBounty {{company.name}}</title>
      <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
      <link rel="stylesheet" type="text/css" href="/../_css/header.css">
      <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/company.css" />

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
                  <input type="image" id="bountyPicture" src="{{company.proPic}}" 
                    alt="Bounty Picture" class="marshalBackground"/>
                </div>
              </div>
              <div class="row innerRow">
                <div class="col-md-12">
                  <div id="bountyButtons">
                    <button class="btn btn-default btn-sm center-block buttonCustom" text-center>Subscribe</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-7">
              <h3>Company Information</h3>
              <form id="profileUpdateForm" method="post">
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Company Name</span>
                      <p class="form-control formControlCustom">{{company.name}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Date Joined</span>
                      <p class="form-control formControlCustom">{{company.dateJoined}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Active Bounties</span>
                      <p class="form-control formControlCustom">{{company.numActive}}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputName"></label>
                    <div class="input-group">
                      <span class="input-group-addon addOnCustom">Total Bounties</span>
                      <p class="form-control formControlCustom">{{company.numBounties}}</p>
                    </div>
                </div>
              </form>              
            </div>

          </div>

          <div class="row innerRow">

            <div class="col-md-12">
              <div id="boutyDescription">
                <h3>Company Description</h3>
                <p class="form-control" id="companyDesc">{{company.fullDescription}}</p>
              </div>
            </div>
          </div>

        </div>

        <div class="col-md-5 tableBottom">
          <h3 class="tableTitle">Active Bounties</h3>
          <div class="tableWrapper">
            <table>
              <thead class="marshalBackground">
                <tr class="">
                  <th class="cell">Date Created</th>
                  <th class="cell">Bounty Name</th>
                  <th class="cell">Date Ending</th>
                </tr>
              </thead>
              <tbody>
                {% for bounty in company.active.activeBounties %}
                <tr class="rowTable">
                  <td class="cell">{{bounty.dateCreated}}</td>
                  <td class="cell"><a href="/_hunter/bounty/{{company.name}}/{{bounty.poolID}}">{{bounty.bountyName}}</a></td>
                  <td class="cell">{{bounty.dateEnding}}</td>
                </tr> 
                {% endfor %}
              </tbody>
            </table>
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