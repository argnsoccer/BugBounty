<html>
  <head>
    <title>BugBounty Pay</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
<!--     <link rel="stylesheet" type="text/css" href="/../_css/pay.css"> -->

      {{include ('bootstrap_header.php')}}
  </head>
  <body>

    {{include ('header_marshall.php')}}

    <h1>Pay Page</h1>

    {% for report in reports %}
    <div class="row" data-bountyID="{{report.bountyID}}", data-reportID="{{report.reportID}}">
        <div class="col-md-2">{{report.dateSubmitted}}</div>
        <div class="col-md-2">{{report.username}}</div>
        <div class="col-md-2">{{report.errorName}}</div>
        <div class="col-md-2">{{report.pathToError}}</div>
        <div class="col-md-2">
            <form>
                <input type="button" value="Download" name="download" />
                <input type="button" value="Dismiss" name="dismiss" />
                <input type="submit" value="Pay" name="pay" />
                <input type="text" name="payAmount" />
            </form>
        </div>
    </div>
    {% endfor %}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="/../_javascript/logout.js"></script>
    {{include ('bootstrap_footer.php')}}

  </body>

</html>
