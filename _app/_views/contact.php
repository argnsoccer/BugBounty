<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>"Who ya gonna call?"</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/contact.css" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
<!--     <link rel="stylesheet" type="text/css" href="/../_css/contact.css"> -->

    {{include ('bootstrap_header.php')}}
</head>

<body>

{% if username and userType == "hunter" %}
  {{ include ('header_hunter.php') }}
{% elseif  username and userType == "marshal" %}
  {{ include ('header_marshal.php') }}
{% else %}
  {{ include ('header_login.php') }}
{% endif %}

    <div id="content_area">
        <h1 id="main_header">Contact BugBounty</h1>
        <hr />
        <div class="row">
            <div class="col-xs-6">
                <form>
                    <div class="form-group">
                        <label for="name_field">Name</label>
                        <input id="name_field" class="form-control" type="text" placeholder="Enter your name" />
                    </div>
                    <div class="form-group">
                        <label for="email_field">Email</label>
                        <input id="email_field" class="form-control" type="email" placeholder="Enter your email address" />
                    </div>
                    <div class="form-group">
                        <label for="subject_field">Subject</label>
                        <input id="subject_field" class="form-control" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="message_type_select">What are you contacting us about?</label>
                        <select id="message_type_select" class="form-control">
                            <option value="support">General Support</option>
                            <option value="question">Non-technical Question</option>
                            <option value="bug_report">Report a Bug (in Our Site)</option>
                            <option value="other">Other (Please Clarify Below)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message_field">Message</label>
                        <textarea id="message_field" class="form-control" rows="10"></textarea>
                    </div>
                </form>
            </div>
            <div class="col-xs-1">
                <!--This is here to make Bootstrap happy-->
            </div>
            <div class="col-xs-4">
                <div id="contact_info" class="marshalBackground">
                    <div class="contact-block">
                        <h3>General Information</h3>
                        <p>sales@bugbounty.com</p>
                    </div>
                    <div class="contact-block">
                        <h3>Dallas Office</h3>
                        <p>3145 Dyer Street</p>
                        <p>Dallas, TX 75275</p>
                        <p>Tel: (985) 655-2500</p>
                        <p>Fax: (221) 867-5309</p>
                    </div>
                    <div class="contact-block">
                        <h3>New York Office</h3>
                        <p>12 North Moore Street</p>
                        <p>New York, NY 10013</p>
                        <p>Tel: (718) 777-3456</p>
                        <p>Fax: (348) 555-2368</p>
                    </div>
                </div>
            </div>
            <div class="col-xs-1">
                <!--This is here to make Bootstrap happy-->
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
