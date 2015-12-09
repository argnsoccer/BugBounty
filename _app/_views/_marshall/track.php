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
    <div id="content_area">
        <div class="row">
            <div class="col-sm-6">
                <div class="row innerRow">
                    <div class="col-sm-4">
                        <input type="image" id="bounty_picture" class="marshalBackground" src="{{bounty.imageLoc}}" alt="Bounty Picture" />
                    </div>
                    <div class="col-sm-8">
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
                                <p class="form-control formControlCustom">{{bounty.bountyName}}</p>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="InputName"></label>
                              <div class="input-group">
                                <span class="input-group-addon addOnCustom">Date Ending</span>
                                <p class="form-control formControlCustom">{{bounty.dateEnding}}</p>
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
                                <span class="input-group-addon addOnCustom">Reports</span>
                                <p class="form-control formControlCustom">{{numReports}}</p>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="row innerRow">
                    <div id="info_box">

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h3 class="table-title">Submitted Reports</h3>
                <div class="tableWrapper">
                  <table>
                    <thead>
                      <tr class="rowTable header">
                        <th class="cell">Date Submitted</th>
                        <th class="cell">Report Name</th>
                        <th class="cell">Details</th>
                        <th class="cell">Pay</th>
                        <th class="cell">       </th>
                      </tr>
                    </thead>
                    <tbody>
                      {% for report in reports %}
                      <tr class="table-row">
                        <td class="cell">{{report.dateCreated}}</td>
                        <td class="cell">{{report.name}}</td>
                        <td class="cell">
                          <button type="button" class="detailsButton" data-toggle="modal"
                          data-target="#detailsModal" data-whatever="@getbootstrap"
                          data-ID={{report.reportID}}>
                            View
                          </button>
                        </td>
                        <td class="cell">
                            <span id="pay_amount" class="input-group">
                                <span id="dollar_sign" class="input-group-addon">$</span>
                                <input id="pay_amount_field" class="form-control input-sm" type="text" name="payAmount" maxlength="7" autocomplete="off" />
                            </span>
                          <!--<button type="button" class="messageButton" data-toggle="modal"
                            data-target="#messageModal" data-whatever="@getbootstrap"
                            data-ID={{report.reportID}}>
                            View
                        </button>-->
                        </td>
                        <td class="cell">
                            <input class="btn btn-success" type="submit" value="Pay" name="submit" />
                        </td>
                      </tr>
                      {% endfor %}
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>



  </body>
</html>
