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
  $function_array = [];
  global $dbh;
  if(!isset($_SESSION['userLogin'])){

    $statement = $dbh->prepare("SELECT username, userID, accountType FROM Account WHERE username = :username AND password = :password");
    if($statement->execute($args))
    {
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      if (isset($row['username']))
      {
        $function_array["result"]["username"] = $row['username'];
        $function_array["result"]["userType"] = strtolower($row['accountType']);
        $function_array["result"]['userID'] = $row['userID'];
        $function_array["error"] = '0';
        $function_array["message"] = "success";

        $_SESSION['userLogin'] = $row['username'];
        $usn[':username'] = $row['username'];
        $_SESSION['userType'] = strtolower($row['accountType']);
        $_SESSION['userID'] = $row['userID'];
      }
      else
      {
        $function_array["error"] = '1';
        $function_array["message"] = 'combination is incorrect';
        $function_array["result"] = [];
      }
    }
    else
    {
      $function_array["error"] = '2';
      $function_array["result"] = [];
      $function_array["message"] = 'statement did not execute';
      $function_array["messageDB"] = $statement->errorInfo();
    }
    return $function_array;
  }
  else
  {
    $function_array["error"] = '3';
    $function_array["result"] = [];
    $function_array["message"] = 'you are already logged in';
    return $function_array;
  }
}

function basicSearch($dbh,$args)
{
	$statement = $dbh->prepare(
	"SELECT BountyPool.*,DATE(BountyPool.dateCreated) as dateCreated,DATE(BountyPool.dateEnding) as dateEnding,Marshall.company as companyName,Account.username as companyUsername FROM BountyPool,Marshall,Account
	WHERE bountyName LIKE :query
	AND BountyPool.bountyMarshallID=Marshall.marshallID
	AND Account.userID=Marshall.marshallID
	LIMIT 5");
	if($statement->execute($args))
	{
		$result["result"]["bounties"] = array();
		while($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			array_push($result["result"]["bounties"],$row);
		}
		$result["message"] = "success";
		$result["error"] = 0;
	}
	else
	{
		$result["message"] = "Statement not executed";
		$result["messageDB"] = $statement->errorInfo();
		$result["error"] = 1;
	}

	return $result;
}

function updateUserDetails($dbh,$change,$inputs)
{
	$args = array();
	$args[':userID'] = $_SESSION['userID'];
	$args[':pass'] = $inputs['password'];
	$result['error'] = 0;
	$statement = $dbh->prepare("
	SELECT * FROM Account
	WHERE userID = :userID
	AND password = :pass");
	$result['error'] = "00000000";
	if($statement->execute($args))
	{
		if($statement->rowCount() == 1)
		{
			if($change[0])
			{
				$statement = $dbh->prepare("
				SELECT * FROM Account
				WHERE username = '".$inputs['username']."'");
				if($statement->execute())
				{
					if($statement->rowCount() == 0)
					{
						$args[':username'] = $inputs['username'];
						$statement = $dbh->prepare("
						UPDATE Account
						SET username = :username
						WHERE userID = :userID
						AND password = :pass");
						if($statement->execute($args))
						{
							$_SESSION['userLogin'] = $inputs['username'];
							$result['message'] = $result['message']."username change successful ";
						}
						else
						{
							$result['error'][0] = '1';
							$result['message'] = $result['message']."username change failed ";
							$result['messageDB'] = $statement->errorInfo();
						}
					}
					else
					{
						$result['error'][0] = '1';
						$result['error'][1] = '1';
						$result['message'] = $result['message']."new username is taken ";
					}
				}
			}
			if($change[1])
			{
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
							$result['message'] = $result['message']."email change successful ";
						}
						else
						{
							$result['error'][2] = '1';
							$result['message'] = $result['message']."email change failed ";
							$result['messageDB'] = $statement->errorInfo();
						}
					}
					else
					{
						$result['error'][2] = '1';
						$result['error'][3] = '1';
						$result['message'] = $result['message']."new email is taken ";
					}
				}
			}
			if($change[2])
			{
				$statement = $dbh->prepare("
				UPDATE Account
				SET password = '".$inputs['newPassword']."'
				WHERE userID = :userID
				AND password=:pass");
				if($statement->execute($args))
				{
					$result['message'] = $result['message']."password change successful ";
				}
				else
				{
					$result['error'][4] = '1';
					$result['message'] = $result['message']."password change failed ";
					$result['messageDB'] = $statement->errorInfo();
				}
			}
			if($change[3])
			{
				$statement = $dbh->prepare("
				UPDATE Marshall
				SET company = '".$inputs['companyName']."'
				WHERE marshallID = :userID");
				if($statement->execute($args))
				{
					$result['message'] = $result['message']."company name change successful";
				}
				else
				{
					$result['error'][5] = '1';
					$result['message'] = $result['message']."company name change failed";
					$result['messageDB'] = $statement->errorInfo();
				}
			}
		}
		else
		{
			$result['error'][6] = "1";
			$result['message'] = "Password is incorrect";
		}
	}
	else
	{
		$result['error'][7] = '1';
		$result['message'] = "password check statement failed";
		$result['messageDB'] = $statement->errorInfo();
	}
	return $result;
}

function signUpHunter($dbh, $args) {
  $username = $args[':username'];
  $args[":imageLoc"] = "_images/_profiles/_".$username;
  if(!mkdir("_images/_profiles/_".$username, true))
  {
    echo(die('Failed to create profile picture directory'));
  }

  copy("_images/_profiles/_default_hunter/profile.png", "_images/_profiles/_".$username."/profile.png");

  $functionArray = array();
  $statement = $dbh->prepare(
    "INSERT INTO Account
      (username, email, password, dateCreated, accountType, dateOfLastActivity, imageLoc, paymentType, moneyCollected, name)
    VALUES
      (:username, :email, :password, NOW(), :accountType, NOW(), :imageLoc, :paymentType, '0', :name)"
  );

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $result['username'] = $_POST['username'];
    $result['userType'] = "hunter";

    $_SESSION['userLogin'] = $_POST['username'];
    $_SESSION['userType'] = "hunter";
    $_SESSION['userID'] = $row['userID'];

    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';

  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $statement->errorInfo();
    $functionArray['message'] = 'Statement did not execute';

    //THIS NEEDS TO BE FIXED TO DIFFERENTIATE BETWEEN EMAIL AND USERNAME
  }
  $functionArray['result'] = $result;

  return $functionArray;
}

function signUpMarshal($dbh, $args, $args2) {
  $username = $args[':username'];
  $args[":imageLoc"] = "/_images/_profiles/_".$username.'/profile.png';
  if(!mkdir("_images/_profiles/_".$username, true))
  {
    echo(die('Failed to create profile picture directory'));
  }

  copy("_images/_profiles/_default_marshal/profile.png", "_images/_profiles/_".$username."/profile.png");
  $functionArray = array();
  $statement = $dbh->prepare(
    "INSERT INTO Account
      (username, email, password, dateCreated, accountType, dateOfLastActivity, imageLoc, paymentType, moneyCollected, name)
    VALUES
      (:username, :email, :password, NOW(), :accountType, NOW(), :imageLoc, :paymentType, '0', :name)"
  );

  if($statement->execute($args))
  {
    $args3['username'] = $_POST['username'];
    $statement3 = $dbh->prepare(
    "SELECT userID FROM Account WHERE username=:username");
    if($statement3->execute($args3))
    {
      $row = $statement3->fetch(PDO::FETCH_ASSOC);
      $_SESSION['userID'] = $row['userID'];
      $result['username'] = $_POST['username'];
      $result['userType'] = strtolower($_POST['accountType']);
      $args3[':username'] = $_POST['username'];

      $_SESSION['userLogin'] = $_POST['username'];
      $_SESSION['userType'] = 'marshal';

      $args2[':marshalID'] = $row['userID'];

      $statement2 = $dbh->prepare(
      "INSERT INTO Marshall (marshallID, company, description, rssLink, rssCreated) VALUES (:marshalID, :companyName, :description, NULL, 0)");

      if($statement2->execute($args2))
      {
        $functionArray['error'] = '0';
        $functionArray['message'] = 'success';
      }
      else {
        $functionArray['error'] = '2';
        $functionArray['messageDB'] = $statement2->errorInfo();
        $functionArray['message'] = 'Second Statement did not execute';
        $statement3 = $dbh->prepare(
        "DELETE FROM Account WHERE username = :username");

        if($statement3->execute($args3))
        {
          $result['message'] = 'Deleted Initial account because Second statement did not execute';
        }
        else {
          $functionArray['error'] = '3';
          $functionArray['messageDB'] = $statement3->errorInfo();
          $funcionArray['message'] = 'Third statement did not execute';
        }

      }
    }
    else {
      $functionArray['error'] = '3';
      $functionArray['messageDB'] = $statement3->errorInfo();
      $functionArray['message'] = 'Third Statement did not execute';
    }

  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $statement->errorInfo();
    $functionArray['message'] = 'First statement did not execute';

    //THIS NEEDS TO BE FIXED TO DIFFERENTIATE BETWEEN EMAIL AND USERNAME
  }
  $functionArray['result'] = $result;

  return $functionArray;
}

function getMarshalFromUsername($dbh, $args) {
  //Simple Select query which returns username, email, and type
  $statement = $dbh->prepare(
  "SELECT Account.username, Account.name, Marshall.company, Marshall.description, Account.email, Account.accountType, Account.imageLoc, Account.dateCreated, Account.paymentType, Account.moneyCollected
  FROM Account, Marshall WHERE Account.userID = Marshall.marshallID AND Account.username = :username");

  $functionArray = array();
  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if(isset($row['username'])) {
      $result['username'] = $row['username'];
      $result['userType'] = strtolower($row['accountType']);
      $result['email'] = $row['email'];
      $result['proPic'] = $row['imageLoc'];
      $functionArray['error'] = '0';
      $result['dateJoined'] = substr($row['dateCreated'], 0, -9);
      $result['paymentType'] = $row['paymentType'];
      $result['moneyCollected'] = $row['moneyCollected'];
      $result['description'] = $row['description'];
      $result['company'] = $row['company'];
      $result['name'] = $row['name'];
      $functionArray['result'] = $result;
      $functionArray['message'] = 'success';
    }
    else {
      $functionArray['error'] = '2';
      $functionArray['message'] = "No username";
    }
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['message'] = 'Statement not executed';
    $functionArray['messageDB'] = $statement->errorInfo();

  }
  return $functionArray;
}

function getHunterFromUsername($dbh, $args) {
  //Simple Select query which returns username, email, and type
  $statement = $dbh->prepare(
  "SELECT username, name, email, accountType, imageLoc, DATE(dateCreated) as dateCreated, paymentType, moneyCollected
  FROM Account WHERE username = :username");

  $functionArray = array();
  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if(isset($row['username'])) {
      $result['username'] = $row['username'];
      $result['userType'] = strtolower($row['accountType']);
      $result['email'] = $row['email'];
      $result['proPic'] = $row['imageLoc'];
      $functionArray['error'] = '0';
      $result['name'] = $row['name'];
      $result['dateJoined'] = $row['dateCreated'];
      $result['paymentType'] = $row['paymentType'];
      $result['moneyCollected'] = $row['moneyCollected'];
      $functionArray['result'] = $result;
      $functionArray['message'] = 'success';
    }
    else {
      $functionArray['error'] = '2';
      $functionArray['message'] = "No username";
    }
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['message'] = 'Statement not executed';
    $functionArray['messageDB'] = $statement->errorInfo();

  }
  return $functionArray;
}

function createBounty($dbh, $args) {
    $functionArray = array();
    if($_SESSION['userType'] == 'marshal') {
    $args[':endDate'] = DATE('Y-m-d', $args[':endDate']);
    $sth = $dbh->prepare(
      "INSERT INTO
        BountyPool (dateCreated, dateEnding, bountyMarshallID, bountyLink, fullDescription, bountyName)
      VALUES
        (now(),:endDate,:userID,:link,:fullDesc, :bountyName)"
    );

    if($sth->execute($args))
    {
      $functionArray['error'] = '0';
      $functionArray['message'] = 'success';
      $result['dateCreated'] = date("Y-m-d",$_POST['dateCreated']);
      $result['dateEnding'] = date("Y-m-d",$_POST['endDate']);
      $result['userID'] = $_SESSION['userID'];
      $args2[':userID'] = $_SESSION['userID'];
      $result['link'] = $_POST['link'];
      $result['fullDesccription'] = $_POST['fullDesc'];
      $result['bountyName'] = $_POST['bountyName'];
      $bountyID = $dbh->lastInsertId();
      $result['bountyID'] = $bountyID;
      $functionArray['result'] = $result;
    }
    else
    {
      $functionArray['error'] = '1';
      $functionArray['messageDB'] = $sth->errorInfo();
      $functionArray['message'] = 'Statement not executed';
    }

    return $functionArray;
  }
  else {
    $functionArray['error'] = '2';
    $functionArray['message'] = 'Must be Marshall to create bounties';
    $functionArray['result'] = $result;
    return $functionArray;
  }
}

function createReport($dbh, $args) {
  $functionArray = array();
  $statement = $dbh->prepare(
  "INSERT INTO Report (bountyID, username, description, link, dateSubmitted, pathToError, errorName, paidAmount, datePaid, message)
  VALUES (:bountyID,:username,:description, :link, NOW(), :pathToError, :errorName, -1, NULL, '')");

  if($statement->execute($args))
  {

    $reportID = $dbh->lastInsertId();

    mkdir('../_files/'.'_'.$args[":bountyID"].'/_'.$args[":username"]);
    $args2[":filePath"] = '../_files/'.$args[":bountyID"].'/'.$args[":username"].'/report'.$reportID;
    $args2[":reportID"] = $reportID;
    $statement = $dbh->prepare("
    UPDATE Report
    SET filePath = :filePath
    WHERE reportID=:reportID");
    if($statement->execute($args2))
    {
      $args3[':reportID'] = $reportID;
      $statement = $dbh->prepare(
      "SELECT *,DATE(dateSubmitted) as dateSubmitted FROM Report WHERE reportID = :reportID");
      if($statement->execute($args3))
      {
        $functionArray['error'] = '0';
        $functionArray['message'] = 'success';
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $functionArray['result'] = $row;
      }
      else {
        $functionArray['error'] = '3';
        $functionArray['messageDB'] = $sth->errorInfo();
        $functionArray['message'] = 'Third statement not executed';
      }
    }
    else{
      $functionArray['error'] = '2';
      $functionArray['messageDB'] = $sth->errorInfo();
      $functionArray['message'] = 'Second statement not executed';
    }
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'First statement not executed';

  }
  return $functionArray;
}

function updateReport($dbh, $args, $changeCode) {
  $functionArray = array();
  if($changeCode == 1)
  {
    $statement = $dbh->prepare(
    "UPDATE Report
    SET message = :message
    WHERE reportID = :reportID");
    if($statement->execute($args))
    {
      $functionArray['error'] = '0';
      $functionArray['message'] = 'success';
      $result['paidAmount'] = $_POST['paidAmount'];
      $result['message'] = $_POST['message'];
      $functionArray['result'] = $result;
    }
    else
    {
      $functionArray['error'] = '1';
      $functionArray['messageDB'] = $statement->errorInfo();
      $functionArray['message'] = 'First statement not executed';
    }
    return $functionArray;
  }
  else if($changeCode == 2)
  {
    $statement = $dbh->prepare(
    "UPDATE Report
    SET paidAmount = :paidAmount
    WHERE reportID = :reportID");
    if($statement->execute($args))
    {
      $functionArray['error'] = '0';
      $functionArray['message'] = 'success';
      $result['paidAmount'] = $_POST['paidAmount'];
      $result['message'] = $_POST['message'];
      $functionArray['result'] = $result;
    }
    else
    {
      $functionArray['error'] = '1';
      $functionArray['messageDB'] = $statement->errorInfo();
      $functionArray['message'] = 'First statement not executed';
    }
    return $functionArray;
  }
}

function getReportsFromUsername($dbh, $args) {
  $statement = $dbh->prepare(
  "SELECT Report.*, DATE(Report.datePaid) as datePaid, DATE(Report.dateSubmitted) as dateSubmitted, BountyPool.bountyName, Account.username as ownerUsername, Marshall.company as companyName FROM Report, BountyPool, Account, Marshall
  WHERE Report.username=:username AND Report.bountyID = BountyPool.poolID AND Marshall.marshallID = BountyPool.bountyMarshallID AND Marshall.marshallID = Account.userID
  ORDER BY dateSubmitted ASC");

  $functionArray = array();
  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $statement->errorInfo();
    $functionArray['message'] = 'First statement not executed';

  }
  return $functionArray;
}

function getProfilePictureFromUsername($dbh, $args){
  if($_SESSION['userType'] == 'marshall'){
    $statement = $dbh->prepare("
    SELECT Account.imageLoc FROM Account WHERE username = :username");
    if($statement->execute($args))
    {
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      $result['message'] = 'success';
      $result['imagePath'] = $row['imageLoc'];
      $result['error'] = '0';
    }
    else
    {
      $result['error'] = '2';
      $result['message'] = 'statement did not execute';
    }

  }
}

function getMessageOfDayHunter($dbh)
{
  $args[':hunter'] = "hunter";
	$statement = $dbh->prepare("
	SELECT message, accountType FROM MessageOfDay
	WHERE DATE(dateMade) = DATE(NOW())
	AND accountType = :hunter");
	if($statement->execute($args))
	{
    if(!isset($row['message'])) {
      $result["result"]["message"] = "There is no message today";
      $result["result"]["accountType"] = "hunter";
      $result['message'] = "No message today";
      $result['error'] = 2;
    }
    else {
  		$row = $statement->fetch(PDO::FETCH_ASSOC);
  		$result["result"]["message"] = $row['message'];
      $result["result"]["accountType"] = $row['accountType'];
  		$result['message'] = "success";
  		$result['error'] = 0;
    }
	}
	else
	{
		$result['message'] = "Statement not executed";
		$result['error'] = 1;
		$result['messageDB'] = $statement->errorInfo();
	}
	return $result;
  $functionArray = array();
  $statement = $dbh->prepare("
  SELECT Account.imageLoc FROM Account WHERE username = :username");
  if($sth->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';
    $result['imagePath'] = $row['imageLoc'];
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'Statement not executed';
  }
  $functionArray['result'] = $result;
  return $functionArray;
}

function getMessageOfDayMarshal($dbh)
{
  $args[':marshal'] = "marshal";
  $statement = $dbh->prepare("
  SELECT message, accountType FROM MessageOfDay
  WHERE DATE(dateMade) = DATE(NOW())
  AND accountType = :marshal");
  if($statement->execute($args))
  {
    if(!isset($row['message'])) {
      $result["result"]["message"] = "There is no message today";
      $result["result"]["accountType"] = "marshal";
      $result['message'] = "No message today";
      $result['error'] = 2;
    }
    else {
      $row = $statement->fetch(PDO::FETCH_ASSOC);
      $result["result"]["message"] = $row['message'];
      $result["result"]["accountType"] = $row['accountType'];
      $result['message'] = "success";
      $result['error'] = 0;
    }
  }
  else
  {
    $result['message'] = "Statement not executed";
    $result['error'] = 1;
    $result['messageDB'] = $statement->errorInfo();
  }
  return $result;
}

function getReportsFromBountyID($dbh, $args) {
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT Report.*, DATE(Report.dateSubmitted) as dateSubmitted, BountyPool.bountyName, Account.username as ownerUsername FROM Report, BountyPool, Account
  WHERE Report.bountyID=:bountyID AND Report.bountyID = BountyPool.poolID AND Account.userID = BountyPool.bountyMarshallID");

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }

    $functionArray['error'] ='0';
    $functionArray['message'] = 'success';
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'First Statement not executed';

  }
  return $functionArray;
}

function getReportsFromUsernameBountyID($dbh, $args) {
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT Report.*, DATE(Report.datePaid) as datePaid, DATE(Report.dateSubmitted) as dateSubmitted, BountyPool.bountyName, Account.username FROM Report, BountyPool, Account
  WHERE Report.bountyID=:bountyID
  AND Report.username=:username
  AND BountyPool.poolID = Report.bountyID
  AND Account.userID = BountyPool.bountyMarshallID");

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }

    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'First Statement not executed';

  }
  return $functionArray;
}


function getPreferredBounties($dbh) {
 //Join query to get all preferred bounties
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT *, DATE(dateCreated) as dateCreated,DATE(dateEnding) as dateEnding FROM BountyPool, PreferredBounties
    WHERE BountyPool.poolID=PreferredBounties.bountyID"
   );

  if($statement->execute($args))
  {
	  $functionArray['result']['bounties'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
	  {
		    $functionArray['error'] = '0';
		    $functionArray['message'] = 'success';
		    array_push($functionArray['result']["bounties"],$row);
	  }
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $statement->errorInfo();
    $functionArray['message'] = 'First Statement not executed';

  }
  return $functionArray;
}

function getActiveBounties($dbh, $args) {
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT BountyPool.*,DATE(BountyPool.dateCreated) as dateCreated,DATE(BountyPool.dateEnding) as dateEnding FROM Marshall INNER JOIN BountyPool ON Marshall.marshallID = BountyPool.bountyMarshallID INNER JOIN Account ON Marshall.marshallID = Account.userID
  WHERE Account.username = :username
  AND BountyPool.dateEnding > NOW()
  ORDER BY dateEnding ASC"
  );

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';

  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'Statement not executed';
  }
  return $functionArray;
}

function getPastBounties($dbh, $args) {

  $statement = $dbh->prepare(
  "SELECT BountyPool.*,DATE(BountyPool.dateCreated) as dateCreated,DATE(BountyPool.dateEnding) as dateEnding, Marshall.company AS companyName, Account.username AS ownerUsername FROM Marshall, BountyPool, Account
  WHERE Marshall.marshallID=BountyPool.bountyMarshallID
  AND Marshall.marshallID=Account.userID
  AND Account.username = :username
  AND now() > BountyPool.dateEnding");
  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';

  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $statement->errorInfo();
    $functionArray['message'] = 'Statement not executed';
  }

  return $functionArray;
}

function getBountyFromBountyID($dbh, $args) {
  $functioArray = array();
  if ($_SESSION['userLogin']) {

    $statement = $dbh->prepare(
    "SELECT *,DATE(BountyPool.dateCreated) as dateCreated,DATE(BountyPool.dateEnding) as dateEnding,Marshall.company as companyName,Account.username as companyUsername FROM BountyPool,Marshall,Account
    WHERE BountyPool.poolID = :bountyID
	AND BountyPool.bountyMarshallID=Marshall.marshallID
	AND Account.userID=Marshall.marshallID"
    );

    if ($statement->execute($args)) {
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $functionArray['error'] = '0';
      $functionArray['message'] = 'success';
      $functionArray['result'] = $result;
    }
    else {
      $functionArray['error'] ='1';
      $functionArray['messageDB'] = $sth->errorInfo();
      $functionArray['message'] = 'Statement not executed';
    }
  }
  else {
    $functionArray['error'] = '2';
    $functionArray['message'] = "No user logged in";
  }
  return $functionArray;
}
//Andre Gras and Mike Wazowski

function getBountiesFromUsernameRecentReports($dbh,$args)
{
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT BountyPool.*,DATE(BountyPool.dateCreated) as dateCreated,DATE(BountyPool.dateEnding) as dateEnding, Marshall.company AS companyName, Account.username AS companyUsername FROM Marshall, BountyPool, Report, Account
  WHERE Marshall.marshallID = BountyPool.bountyMarshallID
  AND Marshall.marshallID = Account.userID
  AND BountyPool.poolID=Report.bountyID
  AND Report.username = :username
  ORDER BY Report.dateSubmitted DESC LIMIT 4"
);

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      $insert = true;
      foreach ($functionArray['result'] as $iterator)
      {
        if($row['poolID'] == $iterator['poolID'])
        {
          $insert = false;
        }
      }
      if($insert)
      {
        $bountyID = $row['poolID'];
        $args[':bountyID'] = $bountyID;
        $statement2 = $dbh->prepare(
        "SELECT COUNT(reportID) AS reportsPending FROM Report WHERE paidAmount = -1 AND username = :username AND bountyID = :bountyID");

        if($statement2->execute($args))
        {
          $row1= $statement2->fetch(PDO::FETCH_ASSOC);
          $row['reportsPending'] = $row1['reportsPending'];
          $functionArray['error'] = '0';
          $functionArray['message'] = 'success';
        }
        else {
          $functionArray['error'] = '2';
          $functionArray['message'] = 'Second Statement does not execute';
          $functionArray['messageDB'] = $statement2->errorInfo();
        }
        array_push($functionArray['result'], $row);
      }
    }

  }
  else {
    $functionArray['error'] = '1';
    $functionArray['message'] = ' First Statement does not execute';
    $functionArray['messageDB'] = $statement->errorInfo();
  }
  return $functionArray;
}

function getBountiesFromUsername($dbh,$args)
{
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT BountyPool.*,DATE(BountyPool.dateCreated) as dateCreated,DATE(BountyPool.dateEnding) as dateEnding,Account.username AS ownerUsername, Marshall.company as companyName FROM BountyPool, Report, Marshall, Account
  WHERE Marshall.marshallID = BountyPool.bountyMarshallID
  AND Marshall.marshallID = Account.userID
  AND BountyPool.poolID=Report.bountyID
  AND Report.username = :username
  ORDER BY dateEnding ASC"
);

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      $insert = true;
      foreach ($functionArray['result'] as $iterator)
      {
        if($row['poolID'] == $iterator['poolID'])
        {
          $insert = false;
        }
      }
      if($insert)
      {
        array_push($functionArray['result'], $row);
      }
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';


  }
  else {
    $functionArray['error'] = '1';
    $functionArray['message'] = 'Statement does not execute';
    $functionArray['messageDB'] = $statement->errorInfo();
  }
  return $functionArray;
}

function getReportsFromMarshal($dbh,$args)
{
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT Report.*, BountyPool.bountyName, DATE(Report.datePaid) as datePaid, DATE(Report.dateSubmitted) as dateSubmitted FROM Report, Account, Marshall, BountyPool
  WHERE Report.bountyID = BountyPool.poolID
  AND BountyPool.bountyMarshallID = Marshall.marshallID
  AND Marshall.marshallID = Account.userID
  AND Account.username = :username
  ORDER BY dateSubmitted ASC");

  $functionArray['result'] = array();
  if($statement->execute($args))
  {
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }

    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'Statement not executed';

  }
  return $functionArray;

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

    $mysqlArray[':userID'] = $_SESSION['userID'];
    $mysqlArray[':rssLink'] = "http://ec2-52-88-178-244.us-west-2.compute.amazonaws.com/".$file_path;

    $statement = $dbh->prepare("
    UPDATE Marshall
    SET rssCreated = 1, rssLink = :rssLink
    WHERE marshallID = :userID");

    if($statement->execute($mysqlArray))
    {
      $result['error'] = '0';
      $result['message'] = 'Success';
    }
    else
    {
      $result['error'] = '1';
      $result['message'] = 'Statement not executed';
      $result['messageDB'] = $statement->errorInfo();
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

  $function_array = [];

  if($statement->execute($args)) {

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if($row['rssCreated']) {

      if(file_exists($row['rssLink'])) {
        $function_array['result']['link'] = $row['link'];
        $function_array['result']['exists'] = "1";
        $function_array['error'] = "0";
        $function_array['message'] = "All gucci";
      }
      else {
        $function_array['result']['exists'] = "0";
        $function_array['error'] = "1";
        $function_array['message'] = "File does not exist";
      }
    }
    else {
      $function_array['result']['exists'] = "0";
      $function_array['error'] = "1";
      $function_array['message'] = "File does not exist";
    }

  }
  else {
    $function_array['error'] = "1";
    $function_array['message'] = "Statement did not execute";
  }

  return $function_array;
}

function addSubscription($dbh, $args) {
  $functionArray = array();
  if(file_exists($args[':rssLink']))
  {
    $statement = $dbh->prepare(
    "INSERT INTO Subscription (userID, rssLink) VALUES (:userID, :rssLink)");

    if($statement->execute($args))
    {
      $functionArray['error'] = '0';
      $functionArray['message'] = 'success';
    }
    else {
      $functionArray['error'] = '1';
      $functionArray['message'] = 'Statement did not execute';
      $functionArray['messageDB'] = $statement->errorInfo();
    }
  }
  else {
    $functionArray['error'] = '2';
    $functionArray['message'] = 'RSS Link does not exist';
  }
  return $functionArray;
}

function getRSSSubscription($dbh,$args)
{
  $functionArray = array();

  $statement = $dbh->prepare(
  "SELECT rssLink FROM Subscription WHERE userID = :userID");

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row['rssLink']);
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';
  }
  else {
    $functionArray['error'] = '1';
    $functionArray['message'] = 'Statement did not execute';
    $functionArray['messageDB'] = $statement->errorInfo();
  }
  return $functionArray;

}



//*************************************************************************************
//Session Accessing Functions go here**************************************************
function getLoggedInUser() {
  $functionArray = array();
  if (isset($_SESSION['userLogin'])) {
    $result['username'] = $_SESSION['userLogin'];
    $result['userType'] = $_SESSION['userType'];
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';
    $functionArray['result'] = $result;
  }
  else {
    $functionArray['error'] = '0';
    $functionArray['message'] = 'No user is logged in';
  }

  return $functionArray;
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
Error Codes:
  1 = username taken

Complete
*/

$app->get('/api/usernameTaken/:username', function($username) use ($dbh) {

  $args[':username'] = $username;

  $functionArray = [];

  $statement = $dbh->prepare("
    SELECT username
    FROM Account
    WHERE username = :username"
  );

  if($statement->execute($args)) {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (isset($row['username'])) {
      $functionArray['result']['taken'] = '1';
      $functionArray['error'] = '0';
      $functionArray['message'] = 'Username taken';
    }
    else {
      $functionArray['result']['taken'] = '0';
      $functionArray['error'] = '0';
      $functionArray['message'] = 'Username not taken';
    }
  }
  else {
    $functionArray['error'] = '1';
    $functionArray['message'] = "The username and password combination did not work";
    $functionArray['messageDB'] = $statement->errorInfo();
  }

  echo json_encode($functionArray);

});

/*Danny Rizzuto
Check to see if email is available
Error Codes:
 1 = Email is taken

Complete
*/

$app->get('/api/emailTaken/:email', function($email) use ($dbh) {

  $args[':email'] = $email;

  $functionArray = [];

  $statement = $dbh->prepare("
    SELECT email
    FROM Account
    WHERE email = :email"
  );

  if($statement->execute($args)) {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (isset($row['email'])) {
      $functionArray['result']['taken'] = '1';
      $functionArray['error'] = '0';
    }
    else {
      $functionArray['result']['taken'] = '0';
      $functionArray['error'] = '0';
      $functionArray['message'] = 'Username not taken';
    }
  }
  else {
    $functionArray['error'] = '1';
    $functionArray['message'] = "The username and password combination did not work";
    $functionArray['messageDB'] = $statement->errorInfo();
  }

  echo json_encode($functionArray);

});


/*
Danny Rizzuto
Sign Up a Hunter
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

$app->post('/api/signUpHunter', function() use ($dbh) {

  $args[':username'] = $_POST['username'];
  $args[':password'] = $_POST['password'];
  $args[':email'] = strtolower($_POST['email']);
  $args[':accountType'] = strtolower($_POST['accountType']);
  $args[':paymentType'] = $_POST['paymentType'];
  $args[':name'] = $_POST['name'];
  $result = signUpHunter($dbh, $args);
  echo json_encode($result);
});

/*
Danny Rizzuto
Sign Up a Marshal
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

$app->post('/api/signUpMarshal', function() use ($dbh) {

  $args[':username'] = $_POST['username'];
  $args[':password'] = $_POST['password'];
  $args[':email'] = strtolower($_POST['email']);
  $args[':accountType'] = strtolower($_POST['accountType']);
  $args[':paymentType'] = $_POST['paymentType'];
  $args[':name'] = $_POST['name'];
  $args2[':companyName'] = $_POST['companyName'];
  $args2[':description'] = $_POST['description'];
  $result = signUpMarshal($dbh, $args, $args2);
  echo json_encode($result);
});




/*
Andre Gras
Get the basics of a Hunter from username
Error Codes:
  0 = user returned all good
  1 = username  doesnt exists
Returns
  username
  userType

Incomplete
*/

$app->get('/api/getHunterFromUsername/:username', function($username) use ($dbh) {
  $args[':username'] = $username;

  $result = getHunterFromUsername($dbh, $args);

  echo json_encode($result);

});

/*
Andre Gras
Get the basics of a Marshal from username
Error Codes:
  0 = user returned all good
  1 = username  doesnt exists
Returns
  username
  userType

Incomplete
*/

$app->get('/api/getMarshalFromUsername/:username', function($username) use ($dbh) {
  $args[':username'] = $username;

  $result = getMarshalFromUsername($dbh, $args);

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

  $changeCode = $_POST['changeCode'];
  if($changeCode == 1)
  {
    $args[':message'] = $_POST['message'];
    $args[':reportID'] = $_POST['reportID'];
  }
  else if($changeCode == 2)
  {
    $args[':paidAmount'] = $_POST['paidAmount'];
    $args[':reportID'] = $_POST['reportID'];
  }
  $result = updateReport($dbh, $args, $changeCode);

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

  $args[':username'] = $username;
  echo json_encode(getReportsFromUsername($dbh,$args));
});

$app->get('/api/getReportFromReportID/:reportID', function($reportID) use ($dbh) {
  $args[':reportID'] = $reportID;
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT Report.*, DATE(Report.datePaid) as datePaid, BountyPool.bountyName FROM Report
  WHERE reportID = :reportID
  AND BountyPool.poolID = Report.bountyID");
  if ($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';

  }
  else {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $sth->errorInfo();
    $functionArray['message'] = 'Statement not executed';
  }

  echo json_encode($functionArray);
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

$app->get('/api/getPastBounties/:username', function($username) use ($dbh) {
  $args[':username'] = $username;
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
  $functionArray = array();
  $statement = $dbh->prepare(
  "SELECT reportID FROM Report
  WHERE username = :username
  AND paidAmount != -1");

  if($statement->execute($args))
  {
    $functionArray['result'] = array();
    while($row = $statement->fetch(PDO::FETCH_ASSOC))
    {
      array_push($functionArray['result'], $row);
    }
    $functionArray['error'] = '0';
    $functionArray['message'] = 'success';

  }
  else {
    $functionArray['error'] = '1';
    $functionArray['messageDB'] = $statement->errorInfo();
    $functionArray['message'] = 'Statement not executed';
  }
  return $functionArray;
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

$app->get('/api/getReportsFromUsernameBountyID/:username/:bountyID', function($username, $bountyID) use ($dbh) {

  $args[':username'] = $username;
  $args[':bountyID'] = $bountyID;

  echo json_encode(getReportsFromUsernameBountyID($dbh,$args));

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

  echo json_encode($clientToken);
});

$app->post('/api/createCreditCardPayment', function () use($dbh){

});

//Andre Gras
$app->post('/api/payReport', function() use ($dbh){
  $functionArray = array();
  $nonce = $_POST['paymentMethodNonce'];
  $amount = $_POST['amount'];
  $args[":hunterUsername"] = $_POST['hunterUsername'];
  $args2[':hunterUsername'] = $_POST['hunterUsername'];
  $args[":marshalUsername"] = $_SESSION['userLogin'];
  $args[":reportID"] = $_POST['reportID'];
  $args[":bountyID"] = $_POST['bountyID'];
  $sale = Braintree_Transaction::sale([
    'amount' => $amount,
    'paymentMethodNonce' => $nonce,
    'customer' => [
      'firstName' => $_POST['marshalUsername']
    ]
  ]);

  $args[':transactionID'] = $sale->transaction->id;
  $args[':amount'] = $amount;
  $args2[':amount'] = $amount;
  $args[':paymentInfo'] = $nonce;

  $functionArray['result']['sale'] = $sale;
  $statement = $dbh->prepare(
  "INSERT INTO Transactions (transactionID, hunterUsername, marshalUsername, amount, paymentInfo, reportID, bountyID)
  VALUES (:transactionID, :hunterUsername, :marshalUsername, :amount, :paymentInfo, :reportID, :bountyID)");

  if($statement->execute($args))
  {
    $message = 'This report has been paid to ANONYMOOSE';
    $smt = $dbh->prepare(
    "UPDATE Report SET paidAmount=:amount, datePaid=now(), message=:message, paid=true WHERE reportID = :reportID");

    $reportID=$args[":reportID"];
    $smt->bindParam(":reportID", $reportID);
    $smt->bindParam(":amount", $amount);
    $smt->bindParam(":message", $message);
    if($smt->execute())
    {
      $smt2 = $dbh->prepare(
      "UPDATE Account SET moneyCollected=moneyCollected+:amount WHERE username = :hunterUsername");

      if($smt2->execute($args2))
      {
        $functionArray['error'] = '0';
        $functionArray['message'] = 'Third statement success. Transaction complete.';
      }
      else {
        $functionArray['error'] = '3';
        $functionArray['message'] = 'Third Statement not executed';
        $functionArray['messageDB'] = $smt2->errorInfo();
      }
    }

    else{
      $functionArray['error'] = '2';
      $functionArray['message'] = 'Second Statement not executed';
      $functionArray['messageDB'] = $smt->errorInfo();
    }
  }
  else
  {
    $functionArray['error'] = '1';
    $functionArray['message'] = 'First Statement not executed';
    $functionArray['messageDB'] = $statement->errorInfo();
  }

  echo json_encode($functionArray);

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
  $args['pubDate'] = date('Y-m-d');

  $args['link'] = "_rss/_profiles/_".$args['user'].".xml";

  echo json_encode(addRSS($dbh, $args));

});

$app->get('/api/rssExists', function() use ($dbh) {

  $args[":username"] = $_SESSION['userLogin'];

  echo json_encode(rssExists($dbh, $args), JSON_UNESCAPED_SLASHES);

});

$app->post('/api/addSubscription', function() use ($dbh) {

  $args[":userID"] = $_SESSION['userLogin'];
  $args[':rssLink'] = $_POST['rssLink'];

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
Errors: Code is in the format "xxxxxxxx" where each x can be either 0 or 1, and the position is increasing left to right ie "[0][1][2][3][4][5][6][7]"
[0] : username change not completed
[1] : new username is taken
[2] : email change not completed
[3] : new email is taken
[4] : password change not completed
[5] : not relevant
[6] : old password is incorrect
[7] : password check statement failed
Message: This will explain the source of the failed changes
*/
$app->post('/api/updateUserDetailsHunter',function() use($dbh)
{
	$changeVal = $_POST['changeCode'];
	$change = array();
	$change[0] = false;
	$change[1] = false;
	$change[2] = false;
	$change[3] = false;
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
/*
Michael Gilbert
Updates a marshall's account info
Change code specifies which info is being changed
Codes:
0: username
1: email
2: password
3: company
4: username and email
5: username and password
6: username and company
7: email and password
8: email and company
9: password and company
10: username and email and password
11: username and email and company
12: username and password and company
13: email and password and company
14: username and email and password and company
Errors: Code is in the format "xxxxxxxx" where each x can be either 0 or 1, and the position is increasing left to right ie "[0][1][2][3][4][5][6][7]"
[0] : username change not completed
[1] : new username is taken
[2] : email change not completed
[3] : new email is taken
[4] : password change not completed
[5] : company change not completed
[6] : old password is incorrect
[7] : password check statement failed
Message: This will explain the source of the failed changes
*/
$app->post('/api/updateUserDetailsMarshal',function() use($dbh)
{
	$changeVal = $_POST['changeCode'];
	$change = array();
	$change[0] = false;
	$change[1] = false;
	$change[2] = false;
	$change[3] = false;
	if($changeVal == 0 | $changeVal == 4 | $changeVal == 5 | $changeVal == 6 | $changeVal == 10 | $changeVal == 11 | $changeVal == 12 | $changeVal == 14)
	{
		$change[0] = true;//username
	}
	if($changeVal == 1 | $changeVal == 4 | $changeVal == 7 | $changeVal == 8 | $changeVal == 10 | $changeVal == 11 | $changeVal == 13 | $changeVal == 14)
	{
		$change[1] = true;//email
	}
	if($changeVal == 2 | $changeVal == 5 | $changeVal == 7 | $changeVal == 9 | $changeVal == 10 | $changeVal == 12 | $changeVal == 13 | $changeVal == 14)
	{
		$change[2] = true;//password
	}
	if($changeVal == 3 | $changeVal == 6 | $changeVal == 8 | $changeVal == 9 | $changeVal == 11 | $changeVal == 12 | $changeVal == 13 | $changeVal == 14)
	{
		$change[3] = true;//company
	}
	echo json_encode(updateUserDetails($dbh,$change,$_POST));
});
/*
Michael Gilbert
Gets Message of Day For a Hunter
Errors:
0: success
1: No statement executed
*/
$app->get('/api/getMODHunter',function() use($dbh)
{
	$args = array();
	echo json_encode(getMessageOfDayHUnter($dbh));
});

/*
Michael Gilbert
Gets Message of Day For a Marshall
Errors:
0: success
1: No statement executed
*/
$app->get('/api/getMODMarshal',function() use($dbh)
{
	$args = array();
	echo json_encode(getMessageOfDayMarshal($dbh));
});

$app->get('/api/getBountiesFromUsernameRecentReports/:username', function($username) use($dbh)
{
  $args[':username'] = $username;
  echo json_encode(getBountiesFromUsernameRecentReports($dbh,$args));

});
/*
Gets all reports submitted towards bounties made by the marshal
Errors:
0: success
1: statement execution failed
*/
$app->get('/api/getReportsFromMarshal/:username', function($username) use($dbh)
{
  $args[':username'] = $username;
  echo json_encode(getReportsFromMarshal($dbh,$args));
});
/*
Inputs:
Username: username to find results for
Outputs: an array of all bounties which the user has submitted reports for
Errors:
0: success
1: statements failed
*/
$app->get('/api/getBountiesFromUsername/:username', function($username) use($dbh)
{
  $args[':username'] = $username;
  echo json_encode(getBountiesFromUsername($dbh,$args));

});
/*
Michael Gilbert
Inputs:
Query: A simple string search term
Outputs: An array of up to 5 bounties whose name includes the search term
Errors:
0: success
1: Statement execution failed
*/
$app->get('/api/basicSearch/:query', function($query) use($dbh)
{
	$args[':query'] = '%'.$query.'%';
	echo json_encode(basicSearch($dbh,$args));
});

$app->get('/api/getRSSSubscription/', function() use($dbh)
{
  $args[':userID'] = $_SESSION['userID'];

	echo json_encode(getRSSSubscription($dbh,$args));
});
