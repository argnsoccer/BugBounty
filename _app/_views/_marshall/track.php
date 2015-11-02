<?php
session_destroy();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../_css/_bootstrap/bootstrap.min.css" />
  </head>
  <body>
    {{ include ('header_logout.php') }}
    
  </body>
</html>
