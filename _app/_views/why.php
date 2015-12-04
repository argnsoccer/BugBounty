<!DOCTYPE html>
<html>
<head>
    <title>"BugBounty Why"</title>
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="/../_css/header.css">
    <link rel="stylesheet" type="text/css" href="/../_css/default.css">
<!--     <link rel="stylesheet" type="text/css" href="/../_css/why.css"> -->

    {{include ('bootstrap_header.php')}}
</head>

<body>
    
{% if username and userType == "hunter" %}
  {{ include ('header_hunter.php') }}
{% elseif  username and userType == "marshall" %}
  {{ include ('header_marshall.php') }}
{% else %}
  {{ include ('header_login.php') }}
{% endif %}
    
  <h1 id="main_header">Why Use Bug Bounty</h1>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="/../_javascript/basic_search.js"></script>
  <script type="text/javascript" src="/../_javascript/login.js"></script>
  <script type="text/javascript" src="/../_javascript/logout.js"></script>
  {{include ('bootstrap_footer.php')}} 

</body>
</html>