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
	  <h1>Upload Content</h1>
	  
	  <div id="uploadFormArea">
	    <form id="uploadForm" method="post">
		  Name: <input type="text" id="name" name="bountyName" /> </br>
		  Link: <input type="text" id="link" name="bountyLink" /> </br>
		  Description: <input type="text" id="description" name="bountyDescription" /> </br>
		  Payout Amount: <input type="number" id="payout" name="bountyPayout" /> </br>
		  End Date: <input type="date" id="date" name="bountyDate" /> </br>
		  
		  <input type="submit" id="submitBountyForm" value="Submit" />
		</form>
	  </div>
  
  </body>
</html>