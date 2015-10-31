<?php


?>

<!DOCTYPE html>

<html>
  <head>
    <title>Upload 'Dat Shiz</title>
	<link rel="shortcut icon" type="image/x-icon" href="../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../../_css/marshall-upload.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../_javascript/marshall-upload.js"></script>
  </head>  
  <body>
      {{include ('header_logout.php')}}
	  <h1>Upload Content</h1>
	  
	  <div id="uploadFormArea">
	    <form id="uploadForm" method="post">
		  <input type="text" id="name" name="bountyName" />
		  <input type="text" id="link" name="bountyLink" />
		  <input type="text" id="description" name="bountyDescription" />
		  <input type="number" id="payout" name="bountyPayout" />
		  <input type="date" id="date" name="bountyDate" />
		  
		  <input type="submit" id="submit" value="Submit" />
		</form>
  
  </body>
</html>