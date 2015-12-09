<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/default.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/track.css" />

    {{include ('bootstrap_header.php')}}
  </head>
  <body>
    {{ include ('header_marshall.php') }}
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <h3>Bounty Information</h3>
                <button type="button" class="btn btn-default btn-xs pull-right" data-toggle="modal"
                  data-target="#profileChangeModal" data-whatever="@getbootstrap">
                        Edit
                </button>
                <form id="profileUpdateForm" method="post">
                  <div class="form-group">
                      <label for="InputName"></label>
                      <div class="input-group">
                        <span class="input-group-addon addOnCustom">Bounty Name</span>
                        <p class="form-control formControlCustom">{{user.username}}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="InputName"></label>
                      <div class="input-group">
                        <span class="input-group-addon addOnCustom">Date Ending</span>
                        <p class="form-control formControlCustom">{{user.name}}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="InputName"></label>
                      <div class="input-group">
                        <span class="input-group-addon addOnCustom">Date Created</span>
                        <p class="form-control formControlCustom">{{user.email}}</p>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="InputName"></label>
                      <div class="input-group">
                        <span class="input-group-addon addOnCustom">Reports</span>
                        <p class="form-control formControlCustom">{{user.dateJoined}}</p>
                      </div>
                  </div>
                </form>
                <div id="info_box">

                </div>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
    </div>



  </body>
</html>
