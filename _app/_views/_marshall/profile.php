<!DOCTYPE html>
<html>
<head>
  <title>BugBounty Profile</title>
  <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
  <link rel="stylesheet" type="text/css" href="/../_css/header.css">
  <link rel="stylesheet" type="text/css" href="/../_css/default.css">
      <link rel="stylesheet" type="text/css" href="/../_css/marshal-profile.css" />

        <link rel="stylesheet" type="text/css" href="/../_css/_modal/default_modal.css" />
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/display_details_modal.css" />
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/payment_modal.css" />
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/profile_modal.css" />
      <link rel="stylesheet" type="text/css" href="/../_css/_modal/message_modal.css" />

  {{include ('bootstrap_header.php')}}
</head>
<body>
    {{include ('header_marshal.php')}}

      <div class="row mainRow">
        <div class="col-md-2">
          <div id="picture_upload">
            <input type="image" id="profile_picture" src="{{user.result.proPic}}" alt="Profile Picture" class="marshalBackground img-responsive"/>
          </div>
        </div>

        <div class="col-md-4">
          <h3>Profile Information</h3>
          <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal"
            data-target="#profileChangeModal" data-whatever="@getbootstrap">
                  Edit
          </button>
          <form class="profileUpdateForm" method="post">
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Username</span>
                  <p class="form-control formControlCustom">{{user.result.username}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Company Name</span>
                  <p class="form-control formControlCustom">{{user.result.company}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Name</span>
                  <p class="form-control formControlCustom">{{user.result.name}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Email</span>
                  <p class="form-control formControlCustom">{{user.result.email}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Joined</span>
                  <p class="form-control formControlCustom">{{user.result.dateJoined}}</p>
                </div>
            </div>
          </form>

          <h3>Payment Information</h3>
          <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal"
            data-target="#paymentChangeModal" data-whatever="@getbootstrap">
                  Edit
          </button>
           <form class="profileUpdateForm" method="post">
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Payment Type</span>
                  <div><p class="form-control formControlCustom">{{user.result.paymentType}}</p></div>
                </div>
            </div>
          </form>
          <h3>Bounty Information</h3>
           <form class="profileUpdateForm" method="post">
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Bounties Active</span>
                  <p class="form-control formControlCustom">{{user.numActive}}</p>
                </div>
            </div>
            <div class="form-group">
                <label for="InputName"></label>
                <div class="input-group">
                  <span class="input-group-addon addOnCustom">Bounties Posted</span>
                  <p class="form-control formControlCustom">{{user.numTotal}}</p>
                </div>
            </div>
          </form>
        </div>

        <div class="col-md-6 tableTop tableCol">
          <h3 class="tableTitle">Active Bounties</h3>
            <div class="tableWrapper">
              <table>
                <thead>
                  <tr class="rowTable header">
                    <th class="cell">Bounty Name</th>
                    <th class="cell">Date Ending</th>
                    <th class="cell">Date Created</th>
                  </tr>
                </thead>
                <tbody>
                  {% for bounty in activeBounties.result %}
                  <tr class="rowTable">
                    <td class="cell"><a href="/_marshal/track/{{bounty.poolID}}">{{bounty.bountyName}}</td>
                    <td class="cell">{{bounty.dateEnding}}</td>
                    <td class="cell">{{bounty.dateCreated}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
        </div>

        <div class="col-md-6 tableTop tableCol">
          <h3 class="tableTitle">Past Bounties</h3>
            <div class="tableWrapper">
              <table>
                <thead>
                  <tr class="rowTable header">
                    <th class="cell">Bounty Name</th>
                    <th class="cell">Date Ended</th>
                    <th class="cell">Date Created</th>
                  </tr>
                </thead>
                <tbody>
                  {% for bounty in pastBounties.result %}
                  <tr class="rowTable">
                    <td class="cell"><a href="/_marshal/track/{{bounty.poolID}}">{{bounty.bountyName}}</td>
                    <td class="cell">{{bounty.dateEnding}}</td>
                    <td class="cell">{{bounty.dateCreated}}</td>
                  </tr>
                  {% endfor %}
                </tbody>
              </table>
            </div>
        </div>
      </div>

{{include ('_modals/profileModal.php')}}
{{include ('_modals/paymentModal.php')}}
{{include ('_modals/basicSeachModal.php')}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/bootstrap-notify-3.1.3/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    <script type="text/javascript" src="/../_javascript/update_profile.js"></script>
    <script type="text/javascript" src="/../_javascript/update_payment.js"></script>
    <script type="text/javascript" src="/../_javascript/basic_search.js"></script>

  {{include ('bootstrap_footer.php')}}
</body>
</html>
