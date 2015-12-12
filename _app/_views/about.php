<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>About BugBounty</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/about.css" />
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

    <div id="what_is" class="hunterBackground">
        <h1>What is BugBounty?</h1>
        <p>BugBounty provides web developers a testing ground for their applications.  By connecting them to a large base of bug hunters, who seek out functional issues for pay, BugBounty gives developers an alternative to consulting and testing firms and helps anyone with an internet connection make a quick buck.</p>
    </div>

    <div id="who_is" class="marshalBackground">
        <h1>Who is 404_TEAM_NAME_NOT_FOUND?</h1>
        <div class="row">
            <div class="col-xs-3">
                <img class="profile-picture center-block" src="../_images/_random/prof-eric-temp.jpg" />
                <p>Eric Hawkins</p>
            </div>
            <div class="bio col-xs-9">
                Eric Hawkins was born in the small town of Russetville, Kansas.  At the age of five, he ran away from home and hitchiked his way to Los Angeles, California, where he acted in several award-winning Spanish-language soap operas.  One day, Eric was visited in a dream by Steve Wozniak, who told him to pursue a degree in Computer Engineering at Southern Methodist University.  Left with no other choice, Eric obeyed and made his way to SMU, where he met the other members of 404_TEAM_NAME_NOT_FOUND and served as Team Lead on BugBounty.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <img class="profile-picture" src="../_images/_random/prof-preston-temp.jpg" />
                <p>Preston Deason</p>
            </div>
            <div class="bio col-xs-9">
                Preston Deason spent his early life as a professional gambler on the Vegas strip.  Using only a fake moustache and a forged ID, he established himself as a quick-witted card-shark with nothing to lose and everything to gain.  However, following a serious accident involving a small horse and a baccarat pallet, Preston swore off gambling and began his education at Southern Methodist University, where he joined 404_TEAM_NAME_NOT_FOUND.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <img class="profile-picture" src="../_images/_random/prof-ryan-temp.jpg" />
                <p>Ryan Edson</p>
            </div>
            <div class="bio col-xs-9">
                Ryan Edson started his career as the drummer for the Australian progressive jazzcore band Golden Lizard Dream.  While on tour in Bosnia, he was kidnapped and brought to the United States, where he was forced to compete in an underground thumb-wrestling league.  Ryan was freed when the FBI launched a successful sting operation against his captors, and he went on to attend Southern Methodist University, where he worked on the Database side of BugBounty.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <img class="profile-picture" src="../_images/_random/prof-zack-temp.jpg" />
                <p>Zack Fout</p>
            </div>
            <div class="bio col-xs-9">
                Zack Fout was raised by a company of steppe bandits who found him as a child wandering among the crags and crevices of the Pyrenees mountains in the midst of an exceptionally unforgiving winter storm.  They took him in as one of their own, and taught him the ways of the ruffian.  Zack fought, drank, and laughed with his brothers-in-arms, until he one day decided he would rather work in the field of Computer Science.  He attended Southern Methodist University, where he met the other members of 404_TEAM_NAME_NOT_FOUND, with whom went on to develop BugBounty.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <img class="profile-picture" src="../_images/_random/prof-michael-temp.jpg" />
                <p>Michael Gilbert</p>
            </div>
            <div class="bio col-xs-9">
                Little is known about Michael Gilbert's life prior to BugBounty.  It has been said that he once made his living in Tuscany as a master shomaker, whose craft was the envy of every self-respecting man to wear a pair of Oxfords.  Some say that he was a professional bear-wrestler, who travelled the Baltic with a patchwork troupe of circus performers.  Others say he has simply always worked on BugBounty. Today, Michael works on the Database side of 404_TEAM_NAME_NOT_FOUND.
            </div>
        </div>
        <div class="row bio-row">
            <div class="col-xs-3">
                <img class="profile-picture" src="../_images/_random/prof-danny-temp.jpg" />
                <p>Danny Rizzuto</p>
            </div>
            <div class="bio col-xs-9">
                Before BugBounty, Danny Rizzuto saw great success as an entrepreneur.  His patented "Beiruti Peddler" method for sanding curling stones revolutionized the Canadian sporting goods industry, and his Rizutt-O-Matic Latke Press&trade; made it so that anyone could enjoy delicious potato pancakes without all the hassle.  After a brief stint in politics, Danny retired at the age of 20 and proceeded to fulfill his lifelong dream of taking a Graphical User Interface class at Southern Methodist University.  There he met Eric Hawkins, Zack Fout, and Preston Deason, with whom he developed BugBounty.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3">
                <img class="profile-picture" src="../_images/_random/prof-andre-temp.jpg" />
                <p>Andre Gras</p>
            </div>
            <div class="bio col-xs-9">
                He has a dark and mysterious past...
            </div>
        </div>
    </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
  <script type="text/javascript" src="/../_javascript/login.js"></script>
  <script type="text/javascript" src="/../_javascript/logout.js"></script>
  {{include ('bootstrap_footer.php')}}

</body>
</html>
