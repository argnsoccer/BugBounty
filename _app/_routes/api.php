<?php

/*

API DOCUMENTATION

/api/test
  Used to see if database is connected correctly

/api/phpInfo
  Displays php info

/api/getLoggedInUser
  Returns the logged in user

/api/updateSesstion
  Updates Session given property and value

/api/deleteSession
  Deletes current session, logging out user

/api/loginUser - post
  logs in a user

/api/usernameTaken/:username - get
  sees if a username is available

/api/emailTaken/:email - get
  sees if an email is available

/api/signUpUser - post
  signs up a user

/api/getUserFromUsername/:username - get
  returns basic info on a user

/api/getUserFromEmail/:email - get
  returns basic info on a user

/api/createBounty - post
  creates a bounty

/api/createReport - post
  creates a report

/api/updateReport - post
  updates any of the information in the report

/api/getReportsFromUsername/:username - get
  gets all reports from a username

/api/getReportFromReportID/:reportID
  returns report

/api/getProfilePictureFromUsername/:username - get
  reutns link to username picture

/api/getActiveBounties/:username - get
  returns any active bounties a marshal has

/api/getPastBounties/:username - get
  returns past bounties a username has

/api/getReportsFromBountyID/:bountyID - get
  returns reports from a bounty ID

/api/getNumberReportsApproved/:username - get
  returns the number of succesful reports for a hunter

/api/getReportsFromUsernameBountyID/:username/:bountyID - get
  returns all the reports a username has on a certain bounty

/api/getReportsFromUsernamePaidVsUnpaid

/api/getPreferredBounties -get
  returns list of 9 preferred bounties

/api/getBountyFromBountyID/:bountyID
  returns bounty frm bountyID

/api/payReport - post

/api/createRSS - post
  creates xml file for marshal

/api/addRss - post
  adds an RSS post to a RSS feed

/api/rssExists
  checks to see if an rss exists

/api/addSubscription/:companyName
  adds a subscription for a hunter

/api/updateUserDetails - post
  updates a user's stuff

*/

if(!isset($_SESSION))
{
  session_start();
}
//Database Accessing Functions go here*************************************************

function loginUser($dbh, $args) {

  $result['status'] = "complete";
  global $dbh;
  if(!isset($_SESSION['userLogin'])){

    $statement = $dbh->prepare("SELECT username, userID, accountType FROM Account WHERE username = :username AND password = :password");

    if($statement->execute($args))
    {
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      if (isset($row['username']))
      {
        $result["username"] = $row['username'];
        $result["userType"] = strtolower($row['accountType']);
        $result['userID'] = $row['userID'];

        $_SESSION['userLogin'] = $row['username'];
        $usn[':username'] = $row['username'];
        $_SESSION['userType'] = strtolower($row['accountType']);
        $_SESSION['userID'] = $row['userID'];

        $result['error'] = '0';
      }
      else
      {
        $result['error'] = '1';
        $result['message'] = "The username and password combination did not work";
      }
    }
    else
    {
      $result['error'] = '2';
      $result['message'] = $statement->errorInfo();
    }

    return $result;
  }
  else
  {
    $result['error'] = '3';
    $result['message'] = 'user is already logged in';

    return $result;
  }
}

function updateUserDetails($dbh,$change,$inputs)
{
	$args = array();
	$args[':userID'] = $_SESSION['userID'];
	$args[':pass'] = $pass;
	$result['error'] = 0;
	if($change[0])
	{
		$result['error'] = $result['error'] + 1;
		$statement = $dbh->prepare("
		SELECT * FROM Account
		WHERE username = '".$inputs['username']."'");
		if($statement->execute())
		{
			if($statement->rowCount() == 0)
			{
				$statement = $dbh->prepare("
				UPDATE Account
				SET username = '".$inputs['username']."'
				WHERE userID = :userID
				AND password=:pass");
				if($statement->execute($args))
				{
					$result['error'] = $result['error'] - 1;
					$result['message'] = $result['message']."username change successful ";
				}
				else
				{
					$result['message'] = $result['message']."username change failed, possible incorrect password or sql error";
				}
			}
			else
			{
				$result['message'] = $result['message']."new username is taken ";
			}
		}
	}
	if($change[1])
	{
		$result['error'] = $result['error'] + 1;
		$statement = $dbh->prepare("
		SELECT * FROM Account
		WHERE email = '".$inputs['email']."'");
		if($statement->execute())
		{
			if($statement->rowCount() == 0)
			{
				$statement = $dbh->prepare("
				UPDATE Account
				SET email= '".$inputs['email']."'
				WHERE userID = :userID
				AND password=:pass");
				if($statement->execute($args))
				{
					$result['error'] = $result['error'] - 1;
					$result['message'] = $result['message']."email change successful ";
				}
				else
				{
					$result['message'] = $result['message']."email change failed, possible incorrect password or sql error";
				}
			}
			else
			{
				$result['message'] = $result['message']."new email is taken ";
			}
		}
	}
	if($change[2])
	{
		$result['error'] = $result['error'] + 1;
		$statement = $dbh->prepare("
		UPDATE Account
		SET password = '".$inputs['new_password']."'
		WHERE userID = :userID
		AND password=:pass");
		if($statement->execute($args))
		{
			$result['error'] = $result['error'] - 1;
			$result['message'] = $result['message']."password change successful ";
		}
		else
		{
			$result['message'] = $result['message']."password change failed, possible incorrect password or sql error";
		}
	}
	return $result;
}

function signUpUser($dbh, $args) {
  $result['status'] = "complete";
  $args[":imageLoc"] = "/_images/_profiles/_".$args[':username']."/profile.png";
  mkdir($args[":imageLoc"]);

  if($args[':accountType'] === 'hunter') {
    copy("_images/_profiles/_default_hunter/profile.png", $args[":imageLoc"]);
  }
  else if ($args[':accountType'] === 'marshal') {
    copy("_images/_profiles/_default_marshal/profile.png", $args[":imageLoc"]);
  }

  $statement = $dbh->prepare(
    "INSERT INTO Account
      (username, email, password, dateCreated, accountType, dateOfLastActivity, imageLoc)
    VALUES
      (:username, :email, :password, NOW(), :accountType, NOW(), :imageLoc)"
  );

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $result['username'] = $_POST['username'];
    $result['userType'] = strtolower($_POST['accountType']);
    $result['error'] = '0';

    $_SESSION['userLogin'] = $_POST['username'];
    $_SESSION['userType'] = strtolower($_POST['accountType']);
    $_SESSION['userID'] = $row['userID'];

  }
  else
  {
    $result['error'] = '1';
    $result['message'] = $statement->errorInfo()[2];

    //THIS NEEDS TO BE FIXED TO DIFFERENTIATE BETWEEN EMAIL AND USERNAME
  }

  return $result;
}

function getUserFromUsername($dbh, $args) {
  //Simple Select query which returns username, email, and type

  $statement = $dbh->prepare("
  SELECT username, name, email, accountType, imageLoc, dateCreated FROM Account WHERE username = :username");

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $result['username'] = $row['username'];
    $result['userType'] = strtolower($row['accountType']);
    $result['email'] = $row['email'];
    $result['proPic'] = $row['imageLoc'];
    $result['error'] = '0';
    $result['name'] = $row['name'];
    $result['dateJoined'] = substr($row['dateCreated'], 0, -9);
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }

  return $result;
}

function getUserFromEmail($dbh, $args) {
   //Simple Select query which returns username, email, and type

  $statement = $dbh->prepare("
  SELECT username, email, accountType FROM Account WHERE email = :email");

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    $result['username'] = $row['username'];
    $result['userType'] = strtolower($row['accountType']);
    $result['email'] = $row['email'];
    $result['error'] = '0';
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';
  }
  return $result;
}


function createBounty($dbh, $args) {

    if($_SESSION['userType'] == 'marshall') {

    $sth = $dbh->prepare(
      "INSERT INTO
        BountyPool (dateCreated, PayoutPool, dateEnding, bountyMarshallID, bountyLink, fullDescription, bountyName)
      VALUES
        (now(),:payout,:endDate,:userID,:link,:fullDesc, :bountyName)"
    );

    if($sth->execute($args))
    {
      $result['success'] = 'true';
      $result['errorCode'] = '0';
    }
    else
    {
      $result['success'] = 'false';
      $result['errorCode'] = '1';
      $result['errorInfo'] = $sth->errorInfo();
    }

    return $result;
  }
  else {
    $result['success'] = 'false';
    $result['errorCode'] = '2';
    $result['errorInfo'] = 'Must be Marshall to create bounties';
    return $result;
  }
}

function createReport($dbh, $args) {

  $statement = $dbh->prepare("
  INSERT INTO report (bountyID, username, description, link, dateSubmitted, pathToError, errorName)
  VALUES (:bountyID,:username,:description, :link, NOW(), :pathToError, :errorName)");

  if($statement->execute($args))
  {

    $reportID = $dbh->lastInsertId();
    $args2[":filePath"] = '../_files/'.$args[":bountyID"].'/'.$args[":username"].$reportID;
    $args2[":reportID"] = $reportID;
    mkdir('../_files/'.$args[":bountyID"].'/'.$reportID);
    $statement = $dbh->prepare("
    UPDATE Report
    SET filePath = :filePath
    WHERE reportID=:reportID");
    if($statement->execute($args2))
    {
      $result['error'] = '0';
    }
    else{
      $result['error'] = '2';
      $result['message'] = 'Statement 2 not executed';
    }
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;
}

function updateReport($dbh, $args) {

  $statement = $dbh->prepare(
  "UPDATE report
  SET payAmount = :payAmount, username = :username, message = :message
  WHERE reportID = :reportID");

  if($statement->execute($args))
  {
    $result['error'] = '0';
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;
}

function getReportsFromUsername($dbh, $args) {
  $statement = $dbh->prepare(
  "SELECT * FROM report
  WHERE username=:username");

  if($statement->execute($args))
  {
    $result['reportArray'] = array();
    $result['error'] = 0;
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($result['reportArray'],$row);
    }
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;


}

function getReportsFromUsernamePaidOrUnPaid($dbh,$args)
{
  $statement = $dbh->prepare("
  SELECT * FROM report,:auxiliary
  WHERE report.bountyID=:auxiliary.bountyID
  AND username:username");

  if($statement->execute($args))
  {
    $result['reportArray'] = array();
    $result['error'] = 0;
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    array_push($result['reportArray'],$row);
  }
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;
}

function getProfilePictureFromUsername($dbh, $args){
  if($_SESSION['userType'] == 'marshall'){
    $statement = $dbh->prepare("
    SELECT Account.imageLoc FROM Account WHERE username = :username");
    if($sth->execute($args))
    {
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      $result['success'] = 'true';
      $result['imagePath'] = $row['imageLoc'];
      $result['error'] = '0';
    }
    else
    {
      $result['success'] = 'false';
      $result['error'] = '2';
      $result['message'] = 'statement did not execute';
    }

  }



}

function getReportsFromBountyID($dbh, $args) {
$statement = $dbh->prepare("
  SELECT * FROM report
  WHERE bountyID=:bountyID");

  if($statement->execute($args))
  {
    $result['reportArray'] = array();
    $result['error'] = 0;
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    array_push($result['reportArray'],$row);
  }
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;
}

function getReportsFromUsernameBountyID($dbh, $args) {
$statement = $dbh->prepare(
  "SELECT * FROM Report
  WHERE bountyID=:bountyID
  AND username=:username");

  if($statement->execute($args))
  {
    $result['reportArray'] = array();
    $result['error'] = 0;
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($result['reportArray'],$row);
    }
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;
}


function getPreferredBounties($dbh) {
 //Join query to get all preferred bounties

  $statement = $dbh->prepare("
    SELECT * FROM BountyPool, PreferredBounties
    WHERE BountyPool.poolID=PreferredBounties.bountyID"
   );

  if($statement->execute($args))
  {
    $result['bountyArray'] = array();
    $result['error'] = 0;
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
  {
    array_push($result['bountyArray'],$row);
  }
  }
  else
  {
    $result['error'] = '1';
    $result['message'] = 'Statement not executed';

  }
  return $result;
}

function getActiveBounties($dbh, $args) {

  $statement = $dbh->prepare(
    "SELECT BountyPool.* FROM Marshall INNER JOIN BountyPool ON Marshall.marshallID = BountyPool.bountyMarshallID INNER JOIN Account ON Marshall.marshallID = Account.userID
    WHERE Account.username = :username
    AND BountyPool.dateCreated < now() < BountyPool.dateEnding"
    );

    if($statement->execute($args))
    {
      $result['activeBounties'] = array();
      $result['error'] = '0';
      $result['message'] = 'success';
      while($row = $statement->fetch(PDO::FETCH_ASSOC))
      {
       array_push($result['activeBounties'],$row);
      }
    }
    else
    {
      $result['error'] = '1';
      $result['message'] = 'Statement not executed';

    }
  return $result;
}

function getPastBounties($dbh, $args) {

  $statement = $dbh->prepare("
  SELECT BountyPool.* FROM Marshall, BountyPool
  WHERE Marshall.marshallID=BountyPool.bountyMarshallID AND Marshall.marshallID=:userID AND now() > dateEnding"); //completed version of this will have dateCreated < now() < dateEnding (but our test vars)

    if($statement->execute($args))
    {
      $result['pastBounties'] = array();
      $result['error'] = 0;
      while($row = $statement->fetch(PDO::FETCH_ASSOC))
      {
       array_push($result['pastBounties'],$row);
      }
    }
    else
    {
      $result['error'] = '2';
      $result['message'] = 'Statement not executed';

    }

  return $result;
}

function getBountyFromBountyID($dbh, $args) {
  if ($_SESSION['userLogin']) {

    $statement = $dbh->prepare("
      SELECT * FROM BountyPool
      WHERE poolID = :bountyID"
    );

    if ($statement->execute($args)) {
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $result['dateCreated'] = substr($result['dateCreated'], 0, -9);
      $result['dateEnding'] = substr($result['dateEnding'], 0, -9);
      $result['error'] = 0;
    }
    else {
      $result['bounty'] = array();
      $result['error'] = 1;
      $result['message'] = "Statement not executed";
    }
  }
  else {
    $result['bounty'] = array();
    $result['error'] = 2;
    $result['message'] = "No user logged in";
  }

  return $result;
}

function getNumberReportsFiled($dbh,$args){

  $statement =$dbh->prepare(
  "SELECT COUNT(reportID) AS num FROM Report WHERE username=:username");

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $result['error'] = '0';
    $result['message'] = 'success';
    $result['numberOfReports'] = $row['num'];
  }
  else {
    $result['error'] = '1';
    $result['message'] = 'statement did not execute';
  }
  return $result;
}

function createRSS($dbh, $args) {

  $file_path = $args['link']."/rss_".$args['username'].".xml";

  $xml = "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>\n";
  $xml = $xml."<rss version=\"2.0\">\n";
  $xml = $xml."\t<channel>\n";
  $xml = $xml."\t\t<title>".$args['title']."</title>\n";
  $xml = $xml."\t\t<link>".$args['url']."</link>\n";

  $xml = $xml."\t\t<image>\n";
  $xml = $xml."\t\t\t<url>".$args['imageURL']."</url>\n";
  $xml = $xml."\t\t\t<title>".$args['imageTitle']."</title>\n";
  $xml = $xml."\t\t\t<link>".$file_path."</link>\n";
  $xml = $xml."\t\t</image>\n";

  $xml = $xml."\t\t<description>".$args['description']."</description>\n";
  $xml = $xml."\t\t<language>".$args['language']."</language>\n";
  $xml = $xml."\t\t<category>".$args['category']."</category>\n";
  $xml = $xml."\t\t<copyright>".$args['copyright']."</copyright>\n";
  $xml = $xml."\t\t<lastBuildDate>".$args['lastBuildDate']."</lastBuildDate>\n";
  $xml = $xml."\t\t<ttl>".$args['ttl']."</ttl>\n";

  $xml = $xml."\t</channel>\n";
  $xml = $xml."</rss>\n";

  try {

    $xmlTest = simplexml_load_string($xml);

    $result['xmlLink'] = $file_path;

    if (!file_exists($args['link'])) {
      mkdir($args['link'], 0777, true);
    }

    $rss_file = fopen($file_path, "w");
    fwrite($rss_file, $xml);

    $statement = $dbh->prepare("
    UPDATE Account
    SET rssCreated = 1, rssLink = :rssLink
    WHERE username = :username"
   );

    $mysqlArray['username'] = $args['username'];
    $mysqlArray['rssLink'] = "http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/".$file_path;

    if($statement->execute($mysqlArray))
    {
      $result['error'] = '0';
      $result['message'] = 'All gucci';
    }
    else
    {
      $result['error'] = '1';
      $result['message'] = 'Statement not executed';
    }

      return $result;
  }
    catch (Exception $e) {
      $result['error'] = "2";
      $result['message'] = $e->getMessage();

      return $result;
  }
}

function addRSS($dbh, $args) {

  if(file_exists($args['link'])) {

    $xml = simplexml_load_file($args['link']);


    $new_item = $xml->channel->addChild("item");

    $new_item->addChild("title", $args['title']);
    $new_item->addChild("description", $args['description']);
    $new_item->addChild("pubDate", $args['pubDate']);

    $rss_file = fopen($args['link'], "w");
    fwrite($rss_file, $xml->asXML());
    fclose($rss_file);

    $result['xml'] = $xml->asXML();
    $result['error'] = "0";
    $result['message'] = "All gucci";

  }
  else {
    $result['error'] = "1";
    $result['message'] = "RSS File does not Exist";
  }

  return $result;
}

function rssExists($dbh, $args) {

  $statement = $dbh->prepare("
    SELECT rssCreated, rssLink
    FROM Account
    WHERE username = :username"
  );

  if($statement->execute($args)) {

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if($row['rssCreated']) {

      if(file_exists($row['rssLink'])) {
        $result['link'] = $row['rssLink'];
        $result['exists'] = "1";
        $result['error'] = "0";
        $message['message'] = "All gucci";
      }
      else {
        $result['exists'] = "0";
        $result['error'] = "1";
        $message['message'] = "File does not exist";
      }
    }
    else {
      $result['exists'] = "0";
      $result['error'] = "1";
      $message['message'] = "File does not exist";
    }

  }
  else {
    $result['error'] = "1";
    $message['message'] = "Statement did not execute";
  }

  return $result;
}

function addSubscription($dbh, $args) {

}

//*************************************************************************************
//Session Accessing Functions go here**************************************************
function getLoggedInUser() {
  $result['status'] = "complete";

  if (isset($_SESSION['userLogin'])) {
    $result['error'] = '0';
    $result['username'] = $_SESSION['userLogin'];
    $result['userType'] = $_SESSION['userType'];
  }
  else {
    $result['error'] = '1';
    $result['message'] = 'No user is logged in';
  }

  return $result;
}

function updateSession() {
  $result['status'] = 'complete';

  try
  {
    $_SESSION[$property] = $value;
    $result['error'] = '0';
  }
  catch (Exception $e)
  {
    $result['error'] = '1';
    $result['message'] = $e->getMessage();
  }

  return $result;
}

function deleteSession() {
  $result['status'] = "complete";

  try {
    session_destroy();
    $result['error'] = '0';
  }
  catch (Exception $e)
  {
    $result['error'] = '1';
    $result['message'] = $e->getMessage();
  }

  return $result;
}
//*************************************************************************************


$app->get('/api/test', function () use ($dbh) {
    echo "API";
});

$app->get('/api/phpInfo', function () use ($dbh) {
    echo phpInfo();
});

/*
Danny Rizzuto
Get the logged in user from javascript
Error Codes:
  0 = returns username
  1 = no user is logged in

Complete
*/

$app->get('/api/getLoggedInUser', function() {

  $result = getLoggedInUser();

  echo json_encode($result);

});

/*
Danny Rizzuto
Update the session information from javascript
Error Codes:
  0 = session info updated
  1 = session infor not updated

Complete
*/

$app->get('/api/updateSession', function ($property, $value) use ($dbh) {

 $result = updateSession();

  echo json_encode($result);
});

/*
Danny Rizzuto
Delete the current Session
Error Codes:
  0 = session deleted
  1 = session not deleted

Complete
*/

$app->get('/api/deleteSession', function() {

  $result = deleteSession();

  echo json_encode($result);
});

/*
Danny Rizzuto
Check to see if user can login
Error Codes:
  0 = login user
  1 = user username/password incorrect
  2 = statement did not execute
  3 = user already logged in
Returns
  username
  userType
  userID

  Complete
*/

$app->post('/api/loginUser', function () use ($dbh) {

  $args[':username'] = $_POST['username'];
  $args[':password'] = $_POST['password'];
  $result = loginUser($dbh, $args);
  echo json_encode($result);
});

/*Danny Rizzuto
Check to see if username is available
*/

$app->get('/api/usernameTaken/:username', function($username) use ($dbh) {

  $args[':username'] = $username;

  $result = [];

  $statement = $dbh->prepare("
    SELECT username
    FROM Account
    WHERE username = :username"
  );

  if($statement->execute($args)) {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (isset($row['username'])) {
      $result['taken'] = '1';
      $result['error'] = '0';
    }
    else {
      $result['taken'] = '0';
      $result['error'] = '0';
    }
  }
  else {
    $result['error'] = '1';
    $result['message'] = "The username and password combination did not work";
  }

  echo json_encode($result);

});

/*Danny Rizzuto
Check to see if email is available
*/

$app->get('/api/emailTaken/:email', function($email) use ($dbh) {

  $args[':email'] = $email;

  $result = [];

  $statement = $dbh->prepare("
    SELECT email
    FROM Account
    WHERE email = :email"
  );

  if($statement->execute($args)) {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (isset($row['email'])) {
      $result['taken'] = '1';
      $result['error'] = '0';
    }
    else {
      $result['taken'] = '0';
      $result['error'] = '0';
    }
  }
  else {
    $result['error'] = '1';
    $result['message'] = "The username and password combination did not work";
  }

  echo json_encode($result);

});

/*
Danny Rizzuto
Sign Up a user
Error Codes:
  0 = user signed up and logged in
  1 = username exists
  2 = email exists
  3 = statement did not execute
Returns
  username
  userType

Complete
*/

$app->post('/api/signUpUser', function() use ($dbh) {

  $args[':username'] = $_POST['username'];
  $args[':password'] = $_POST['password'];
  $args[':email'] = strtolower($_POST['email']);
  $args[':accountType'] = strtolower($_POST['accountType']);
  $result = signUpUser($dbh, $args);
  echo json_encode($result);
});

/*
Andre Gras
Get the basics of a user from username
Error Codes:
  0 = user returned all good
  1 = username  doesnt exists
Returns
  username
  userType

Incomplete
*/

$app->get('/api/getUserFromUsername/:username', function($username) use ($dbh) {
  $args[':username'] = $username;

  $result = getUserFromUsername($dbh, $args);

  echo json_encode($result);

});

/*
Michael Gilbert
Get the basics of a user from email
Error Codes:
  0 = user returned all good
  1 = email doesnt exists
Returns
  username
  userType

complete
*/

$app->get('/api/getUserFromEmail/:email', function($email) use ($dbh) {
  $args[':email'] = $username;

  $result = getUserFromEmail($dbh, $args);

  echo json_encode($result);

});

  /*
  Andre Gras
  Creates a Bounty
  Error Codes:
    0 = bounty created
    1 = statement did not execute
    2 = user was hunter
  Returns

  complete
  */

$app->post('/api/createBounty', function() use ($dbh) {

  $args[':bountyName'] = $_POST['name'];
  $args[':payout'] = $_POST['payout'];
  $args[':link'] = $_POST['link'];
  $args[':endDate'] = $_POST['endDate'];
  $args[':fullDesc'] = $_POST['desc'];
  $args['userID'] = $_SESSION['userID'];

  $result = createBounty($dbh, $args);

  echo json_encode($result);

});

  /*
  Michael Gilbert
  Creates a report
  Error Codes:
  1: no statement executed
  Returns

  complete
  */

$app->post('/api/createReport', function() use ($dbh) {

  $args[':bountyID'] = $_POST['bountyID'];
  $args[':username'] = $_POST['username'];
  $args[':description'] = $_POST['description'];
  $args[':link'] = $_POST['link'];
  $args[':pathToError'] = $_POST['pathToError'];
  $args[':errorName'] = $_POST['errorName'];

  $result = createReport($dbh, $args);

  echo json_encode($result);

});

  /*
  Ryan Edson
  Updates a report with whether they are getting paid or not
  Also adds report to PaymentTable (table which will handle paypal, not in db yet)
  Error Codes:
  Returns

  complete
  */

$app->post('/api/updateReport', function() use ($dbh) {

  $args[':reportID'] = $_POST['reportID'];
  $args[':payAmount'] = $_POST['payAmount']; //pay amount of 0 clearly means the bounty was not accepted
  $args[':username'] = $_POST['username'];
  $args[':message'] = $_POST['message'];

  $result = updateReport($dbh, $args);

  echo json_encode($result);
});

$app->post('/api/updateReport', function() use ($dbh) {

  $args[':reportID'] = $_POST['reportID'];
  $args[':payAmount'] = $_POST['payAmount']; //pay amount of 0 clearly means the bounty was not accepted
  $args[':username'] = $_POST['username'];
  $args[':message'] = $_POST['message'];

  $result = updateReport($dbh, $args);

  echo json_encode($result);
});

  /*
  Ryan Edson
  Returns all reports a username has submitted
  Error Codes:
  Returns

  complete
  */

$app->get('/api/getReportsFromUsername/:username', function($username) use ($dbh) {

  $args[':username'] = $_GET['username'];
  echo json_encode(getReportsFromUsername($dbh,$args));
});

$app->get('/api/getReportFromReportID/:reportID', function($reportID) use ($dbh) {
  $args[':reportID'] = $reportID;
  $statement = $dbh->prepare(
  "SELECT * FROM Report
  WHERE reportID = :reportID");
  if ($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $result['error'] = '0';
    $result['report'] = $row;
  }
  else {
    $result['report'] = array();
    $result['error'] = 1;
    $result['message'] = "Statement not executed";
  }

  echo json_encode($result);
});

  /*
  Andre Gras
  returns profile picture path for Marshalls (no hunter prof pic)
  Error Codes:
  0 - profile path returned
  1 - logged in user is a hunter
  2 - statement did not execute
  Returns
  imageLoc (image path for profile picture)

  complete
  */


$app->get('/api/getProfilePictureFromUsername/:username', function($username) use ($dbh) {
  $args[':username'] = $_GET['username'];
  echo json_encode(getProfilePictureFromUsername($dbh,$args));
});

/*
Andre Gras
returns active bounties for logged in Marshall
Error Codes:
0 - profile path returned
1 - logged in user is a hunter
2 - statement did not execute
Returns
All active bounties with all fields from BountyPool

complete
*/

$app->get('/api/getActiveBounties/:username', function($username) use ($dbh) {
  $args[':username'] = $username;
  echo json_encode(getActiveBounties($dbh,$args));
});

/*
Andre Gras
returns past bounties for logged in Marshall
Error Codes:
0 - profile path returned
1 - logged in user is a hunter
2 - statement did not execute
Returns
All past bounties with all fields from BountyPool

complete
*/

$app->get('/api/getPastBounties/', function($username) use ($dbh) {
  $args[':userID'] = $_SESSION['userID'];
  echo json_encode(getPastBounties($dbh,$args));
});

/*
Michael Gilbert
returns all reports on a certain bounty
Error Codes:
Returns

Incomplete
*/
$app->get('/api/getReportsFromBountyID/:bountyID', function($bountyID) use ($dbh) {

  $args[':bountyID'] = $bountyID;
  echo json_encode(getReportsFromBountyID($dbh,$args));

  });

$app->get('/api/getNumberReportsFiled/:username', function($username) use($dbh) {
  $args[':username'] = $username;
  echo json_encode(getNumberReportsFiled($dbh,$args));

});

function getNumberReportsApproved($dbh, $args){
  $statement = $dbh->prepare(
  "SELECT COUNT(p.reportID) AS num FROM paidReport p INNER JOIN Report r ON p.reportID = r.reportID
  WHERE r.username = :username");

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $result['error'] = '0';
    $result['message'] = 'success';
    $result['numberOfReports'] = $row['num'];
  }
  else {
    $result['error'] = '1';
    $result['message'] = 'statement did not execute';
  }
  return $result;
}

$app->get('/api/getNumberReportsApproved/:username', function($username) use($dbh) {
  $args[':username'] = $username;
  echo json_encode(getNumberReportsApproved($dbh,$args));
});
/*
  Ryan Edson
  returns all bounties a user has logged on a certain bounty
  Error Codes:
  Returns

  complete
  */

$app->get('/api/getReportsFromUsernameBountyID/:usename/:bountyID', function($username, $bountyID) use ($dbh) {

  $args[':username'] = $_GET['username'];
  $args[':bountyID'] = $_GET['bountyID'];

  echo json_encode(getReportsFromUsernameBountyID($dbh,$args));

  });

$app->get('/api/getReportsFromUsernamePaidVsUnpaid/:username/:auxiliary/', function($bountyID) use ($dbh)
{
  $args[":auxiliary"] = $_GET['auxiliary'];
  $args[":username"] = $_GET['username'];
  echo json_encode(getReportsFromUsernamePaidOrUnPaid($dbh,$args));
});

  /*
  Michael Gilbert
  gets all the reports from the preferred reports table
  Error Codes:
  1: no statement executed
  Returns
  array of preferred bounties

  complete
  */

$app->get('/api/getPreferredBounties', function() use ($dbh) {

  echo json_encode(getPreferredBounties($dbh));

});

$app->get('/api/getBountyFromBountyID/:bountyID', function($bountyID) use ($dbh) {

  $args[":bountyID"] = $bountyID;
  echo json_encode(getBountyFromBountyID($dbh, $args));

});

$app->get('/api/getClientToken', function() use ($dbh){
  $clientToken = Braintree_ClientToken::generate([
    "customerId" => $aCustomerId
  ]);
  echo($clientToken);
});

//Andre Gras
$app->post('/api/payReport', function() use ($dbh){
  $nonce = $_POST['payment_method_nonce'];
  $amount = $_POST['amount'];
  $args[":hunterID"] = $_POST['hunterID'];
  $args[":marshallID"] = $_POST['marshallID'];
  $args[":reportID"] = $_POST['reportID'];
  $args[":bountyID"] = $_POST['bountyID'];
  $result = Braintree_Transaction::sale([
    'amount' => $amount,
    'paymentMethodNonce' => $nonce,
  ]);
  $args[':transactionID'] = $result->transaction->id;
  $args[':amount'] = $amount;
  $args[':paymentInfo'] = $result->transaction->creditCardDetails;

  $statement = $dbh->prepare(
  "INSERT INTO Transactions (transactionID, hunterID, marshallID, amount, paymentInfo, reportID, bountyID)
  VALUES (:transactionID,:hunterID,:marshallID, :amount, :paymentInfo, :reportID, :bountyID)");

  if($statement->execute($args))
  {
    $message = 'This report has been paid to ANONYMOOSE';
    $smt = $dbh->prepare(
    "INSERT INTO paidReport (reportID, paidAmount, datePaid, message, publish)
    VALUES (:reportID, :amount, now(), :message, 0)");
    $reportID=$args[":reportID"];
    $smt->bindParam(":reportID", $reportID);
    $smt->bindParam(":amount", $amount);
    $smt->bindParam(":message", $message);

    if($smt->execute())
    {
      $result2['error'] = '0';
      $result2['message'] = 'second statement success. Transaction complete.';
    }
    else{
      $result2['error'] = '2';
      $result2['message'] = 'second statement not executed';
    }
  }
  else{
    $result2['error'] = '1';
    $result2['message'] = 'first statement not executed';
  }

  echo json_encode($result);
  echo json_encode($result2);

});

$app->post('/api/createRSS', function() use ($dbh) {
  $args['username'] = $_SESSION['userLogin'];

  $args['title'] = $_POST['title'];
  $args['category'] = $_POST['category'];
  $args['copyright'] = $_POST['copyright'];
  $args['description'] = $_POST['description'];
  $args['url'] = $_POST['url'];

  $args['link'] = "_rss/_profiles/_".$args['username'];
  $args['imageURL'] = "_images/_profiles/_".$args['userLogin']."/profile.png";
  $args['imageTitle'] = $args['user']." RSS picture for ".$args['userLogin'];

  $args['language'] = "en-us";
  $args['creationDate'] = date("Y/m/d");
  $args['ttl'] = "340";


  echo json_encode(createRSS($dbh, $args), JSON_UNESCAPED_SLASHES);

  // echo json_encode(print_r($args));

});

$app->post('/api/addRSS', function() use ($dbh) {
  $args['user'] = $_SESSION['userLogin'];

  $args['title'] = $_POST['title'];
  $args['category'] = $_POST['category'];
  $args['description'] = $_POST['description'];
  $args['pubDate'] = date('Y/m/d');

  $args['link'] = "_rss/_profiles/_".$args['user']."/rss_".$args['user'].".xml";

  echo json_encode(addRSS($dbh, $args));

});

$app->get('/api/rssExists', function() use ($dbh) {

  $args[":username"] = $_SESSION['userLogin'];

  echo json_encode(rssExists($dbh, $args), JSON_UNESCAPED_SLASHES);

});

$app->get('/api/addSubscription', function($companyName) use ($dbh) {

  $args[":username"] = $_SESSION['userLogin'];
  $args[':bountyID'] = $_GET['$companyName'];

  echo json_encode(addSubscription($dbh, $args), JSON_UNESCAPED_SLASHES);

});

/*
Michael Gilbert
Updates a user's account info
Change code specifies which info is being changed
Codes:
0: username
1: email
2: password
3: username and email
4: username and password
5: email and password
6: username and email and password
Errors: Number is equal to number of failed changes
Message: This will explain the source of the failed changes
*/
$app->post('/api/updateUserDetails',function() use($dbh)
{
	$changeVal = $_POST['changeCode'];
	$change = array();
	$change[0] = false;
	$change[1] = false;
	$change[2] = false;
	if($changeVal == 0 | $changeVal == 3 | $changeVal == 4 | $changeVal == 6)
	{
		$change[0] = true;//username
	}
	if($changeVal == 1 | $changeVal == 3 | $changeVal == 5 | $changeVal == 6)
	{
		$change[1] = true;//email
	}
	if($changeVal == 2 | $changeVal == 4 | $changeVal == 5 | $changeVal == 6)
	{
		$change[2] = true;//password
	}
	echo json_encode(updateUserDetails($dbh,$change,$_POST));
});
