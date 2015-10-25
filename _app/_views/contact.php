<?php

?>

<!DOCTYPE html>
<html>
<head>
    <title>"Who ya gonna call?"</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../_css/contact.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="_javascript/login.js"></script>
</head>

<body>
    
{% if username %}
  {{ include ('header_logout.php') }}
{% else %}
  {{ include ('header_login.php') }}
{% endif %}
    
    <h1 id="main_header">Contact BugBounty</h1>
    <hr />

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


</body>
</html>