<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>Technical Overview</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/tech_overview.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
    <!-- <link rel="stylesheet" type="text/css" href="/../_css/about.css"> -->

    {{include ('bootstrap_header.php')}}

</head>

<body class="whiteBackground">

{% if username and userType == "hunter" %}
  {{ include ('header_hunter.php') }}
{% elseif  username and userType == "marshal" %}
  {{ include ('header_marshal.php') }}
{% else %}
  {{ include ('header_login.php') }}
{% endif %}

    <div id="what_is" class="whatBackground">
        <h1 class="text-center">Technical Overview of BugBounty</h1>
        <p class="text-center">Our intention was to create a website/application that allows people to earn some extra cash by browsing various websites and documenting any problems or errors they may come across. There are two primary groups of users whom we hope to appeal to: hunters, and marshals. Hunters may be those who have some extra free time they would like to convert into cash or web surfers who frequently find errors and want to help developers. Marshals may be web development companies looking to cut down on costs or indie web developers looking to tap into the power of crowdsourcing.</p><br>
	      <p class="text-center">The features we focused our attention on implementing are as follows: allowing users to sign up as either a hunter or marshal, marshals creating bounties and linking to their websites, hunters creating reports for bounties, marshals paying for reports, searching for bounties, and implementing rss feeds to keep hunters updated about bounties. There are a variety of technologies we used at each level in order to achieve these goals. On the database side, we used Slim/Twig to implement a Restful API. We also implemented Braintree&#39s API to enable payments, and a mySQL database for data storage. On the GUI side, we used bootstrap to facilitate the design of a professional looking user interface, jQuery to ease javascript code writing, and AJAX to enable dynamic content. The layout of our database is in the diagram below:</p>
        <img class="img-responsive text-center" src="../_images/_random/db-schema.png" />
    </div>

    <div id="major_features" class="whatBackground">
        <h1 class="text-center">Our Features</h1>
        <p class="text-center">While developing the BugBounty website, we used the following features and requirements to inform both our development process and the functionality of our website:</p>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Linking to Other Websites</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Creating Bounties for Website Bugs</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Creating Reports for Bounties</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Paying Hunters for Their Reports</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Searching for New Bounties</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Signing Up As a Hunter or As a Marshal</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-center">
                <p>Create and Enable Subscriptions to RSS feeds</p>
            </div>
        </div>
    </div>

    <div id="tech_features" class="whatBackground">
        <h1 class="text-center">Technical Implementation</h1>
        <p class="text-center">Our web front-end is built on top of a SLIM PHP5 RESTful API framework using the Twig PHP template engine. Under the hood, all of our hunter and marshal data is stored in a MySQL Relational Database.</p>
        <p class="text-center">In order to support the distribution of bounty payments, we provided support for the BrainTree payment processing system. This allows us to handle both credit card and PayPal payments between marshals and hunters.</p>
        <p class="text-center">We also implemented RSS update feeds that hunter can subscribe to, so that marshals will be able to see any important updates on their posted bounties.</p>
        <p class="text-center">To summarize our technical stack, we use MySQL, BrainTree, Twig, and SLIM in our back-end implementation and Bootstrap, Bootstrap Notify, jQuery, and AJAX in our front-end implementation</p>
    </div>

    <div id="api" class="whatBackground">
        <h1 class="text-center">API Documentation</h1>
        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>getPreferredBounties</p>
                <p>Returns all of the reports from the preferred reports table.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>updateUserDetailsHunter</p>
                <p>Updates a hunter&#39s account information.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>updateUserDetailsMarshal</p>
                <p>Updates a marshal&#39s account information.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>getMODHunter</p>
                <p>Returns the message of the day for a hunter.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>getMODHunter</p>
                <p>Returns the message of the day for a marshal.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>getReportsFromMarshal</p>
                <p>Returns all of the reports submitted for bounties made by a specific marshal.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>getBountiesFromUsername</p>
                <p>Receives a username and returns all of the bounties that the user has submitted.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>basicSearch</p>
                <p>Receives a query string and returns an array of up to 5 bounties whose name is included in the search query.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Ryan Edson</p>
                <p>getReportsFromUsernameBountyID</p>
                <p>Returns all reports a user has logged on a specific bounty.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Michael Gilbert</p>
                <p>getReportsFromBountyID</p>
                <p>Returns all of the reports made on a certain bounty.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Andre Gras</p>
                <p>getPastBounties</p>
                <p>Returns all completed bounties for a logged in marshal.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-3 text-center">
                <p>Owner:</p>
                <p>API Call Name:</p>
                <p>Description:</p>
            </div>
            <div class="col-xs-9 text-center">
                <p>Andre Gras</p>
                <p>payReport</p>
                <p>Completes BrainTree transaction for a specific report.</p>
            </div>
        </div>
        <h2 class="text-center">...And the list goes on...</h2>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
  <script type="text/javascript" src="/../_javascript/login.js"></script>
  <script type="text/javascript" src="/../_javascript/logout.js"></script>
  {{include ('bootstrap_footer.php')}}
</body>
</html>
