<html>
  <head>
    <title>BugBounty Pay</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/pay.css">
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">


      {{include ('bootstrap_header.php')}}
  </head>
  <body>

    {{include ('header_marshall.php')}}

    <h1>Submitted Bugs</h1>

    <div id="bounty_area">
        {% for report in reports %}
        <div id="bounty_row" class="row" data-bountyID="{{report.bountyID}}", data-reportID="{{report.reportID}}">
            <div class="col-xs-2 bounty-text-item">{{report.dateSubmitted}}</div>
            <div class="col-xs-2 bounty-text-item">{{report.username}}</div>
            <div class="col-xs-2 bounty-text-item">{{report.errorName}}</div>
            <div class="col-xs-2 bounty-text-item">{{report.pathToError}}</div>
            <div class="col-xs-4">
                <form>
                    <div id="pay_buttons" class="btn-group">
                        <input class="btn btn-default" type="button" value="Download" name="download" />
                        <input class="btn btn-default" type="button" value="Dismiss" name="dismiss" />
                        <input class="btn btn-primary" type="submit" value="Pay" name="pay" />
                        <span id="pay_amount" class="input-group">
                            <span id="dollar_sign" class="input-group-addon">$</span>
                            <input id="pay_amount_field" class="form-control input-sm" type="text" name="payAmount" />
                        </span>
                    </div>

                </form>
            </div>
        </div>
        {% endfor %}
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}}

  </body>

</html>
