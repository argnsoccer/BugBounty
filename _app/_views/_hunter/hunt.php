<!DOCTYPE html>
<html>
<head>
  <title>Bug Hunting</title>
  <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
  <link rel="stylesheet" type="text/css" href="../_css/hunt.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script type="text/javascript" src="_javascript/login.js"></script>
</head>
<body>
  {% if username %}
    {{ include ('header_logout.php') }}
  {% else %}
    {{ include ('header_login.php') }}
  {% endif %}
  <div id="frame_body">
    <iframe src="http://www.smu.edu" name="hunt_frame"></iframe>
  </div>
  <div id="input_area">
    <div id="report_area">
      <textarea rows="6" cols="100" placeholder="Post your bug report comments here"></textarea>
    </div>
    <div id="submit_area">
      <form action="/path/to/action" method="post" id="report_form">
        <input type="button" class="report" value="Upload" name="upload" id="upload"><br><br>
        <input type="submit" class="report" value="Submit" name="submitted" id="submitted">
      </form>
    </div>
  </div>
</body>
</html>
