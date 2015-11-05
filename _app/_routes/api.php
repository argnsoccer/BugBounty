<?php

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
    $result['error'] = 3;
    $result['message'] = 'user is already logged in';

    return $result;
  }
}

function signUpUser($dbh, $args) {
  $result['status'] = "complete";

  $statement = $dbh->prepare(
    "INSERT INTO Account
      (username, email, password, dateCreated, accountType, dateOfLastActivity)
    VALUES
      (:username, :email, :password, NOW(), :accountType, NOW())"
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
  SELECT username, email, accountType FROM Account WHERE username = :username");

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
  INSERT INTO report (bountyID,username,ReportText)
  VALUES (:bountyID,:username,:ReportText)");

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

function updateReport($dbh, $args) {

}

function getReportsFromUsername($dbh, $args) {

}

function getReportsFromBountyID($dbh, $args) {

}

function getReportsFromUsernameBountyID($dbh, $args) {

}


function getPreferredReports($dbh) {
 //Join query to get all preferred bounties

  $statement = $dbh->prepare("
  SELECT * FROM bountypool,preferredbounties
  WHERE bountypool.poolID=preferredbounties.bountyID");

  if($statement->execute($args))
  {
	  $result['bountyArray'] = array();
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
  $args[':reportText'] = $_POST['reportText'];

  $result = createReport($dbh, $args);

  echo json_encode($result);

});

  /*
  Ryan Edson
  Updates a report with whether they are getting paid or not
  Also adds report to PaymentTable (table which will handle paypal, not in db yet)
  Error Codes:
  Returns

  Incomplete
  */

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

  Incomplete
  */

$app->get('/api/getReportsFromUsername/:username', function($username) use ($dbh) {

  });

  /*
  Michael Gilbert
  returns all reports on a certain bounty
  Error Codes:
  Returns

  Incomplete
  */

$app->get('/api/getReportsFromBountyID/:bountyID', function($bountyID) use ($dbh) {

  });

/*
  Ryan Edson
  returns all bounties a user has logged on a certain bounty
  Error Codes:
  Returns

  Incomplete
  */

$app->get('/api/getReportsFromUsernameBountyID/:usename/:bountyID', function($username, $bountyID) use ($dbh) {

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

$app->get('/api/getPreferredReports', function($bountyID) use ($dbh) {
	echo json_encode(getPreferredReports($dbh));
  });


// function validateSignUpInfo($username, $email) {
//   global $dbh;

//   $sth = $dbh->prepare(
//     "SELECT count(username) AS uCount FROM Account
//     WHERE username = :username");
//   $sth->bindParam(':username', $username);

//   if ($sth->execute()) {
//     $row = $sth->fetch(PDO::FETCH_ASSOC);
//     $result['success'] = true;
//     $result['validUsername'] = $row['uCount'] == 0;
//     $badUsername = $result['validUsername'] ? '' : "the username $username is already taken.";
//   }
//   else {
//     $result['success'] = false;
//     $result['errorInfo'] = array("dbError" => $sth->errorInfo());
//   }

//   $sth = $dbh->prepare(
//     "SELECT count(email) AS eCount FROM Account
//     WHERE email = :email");
//   $sth->bindParam(':email', $email);

//   if ($sth->execute()) {
//     $row = $sth->fetch(PDO::FETCH_ASSOC);
//     $result['success'] = true;
//     $result['validEmail'] = $row['eCount'] == 0;
//     $badEmail = $result['validEmail'] ? '' : "the email $email is already taken.";
//   }
//   else {
//     $result['success'] = false;
//     $result['errorInfo'] = array("dbError" => $sth->errorInfo());
//   }

//   $result['errorInfo'] = array(
//     'usernameError' => $badUsername,
//     'emailError' => $badEmail
//   );

//   return $result;
// }

// $app->get('/api/getProfile/:username', function($username) {
//   global $dbh;
//   $sth = $dbh->prepare(
//     "SELECT marshallID, description, imageLoc, company FROM Marshall
//     WHERE username = :username");
//   $sth->bindParam(':username', $username);
//   if ($sth->execute()) {
//     $row = $sth->fetch(PDO::FETCH_ASSOC);
//     $result['description'] = $row['description'];
//     $result['imageLoc'] = $row['imageLoc'];
//     $result['company'] = $row['company'];
//     $result['marshallID'] = $row['marshallID'];
//   }
//   else {
//     $result['success'] = false;
//     $result['error'] = $sth->errorInfo();
//   }
//   $sth = $dbh->prepare(
//   "SELECT * FROM BountyPool WHERE bountyMarshallID = $result['marshallID']"
//   );
//   if($sth->execut()){
//     $row = $sth->fetch(PDO::FETCH_ASSOC);
//     $result['dateCreated'] = $row['dateCreated'];
//     $result['PayoutPool'] = $row['PayoutPool'];
//     $result['dateEnding'] = $row['dateEnding'];
//     $result['bountyLink'] = $row['bountyLink'];
//     $result['success'] = true;
//   }
//   else{
//     $result['success'] = false;
//     $result['error'] = $sth->errorInfo();
//   }
//   echo json_encode($result);
// });

// $app->post('/api/sendReport', function()){
//   global $dbh;
//   $args[':reportText'] = $_POST['reportText'];
//   $args[':username'] = $_POST['username'];
//   $args[':bountyID'] = $_POST['bountyID'];
//   $sth = $dbh->prepare(
//   "INSERT into Report (reportText, username, bountyID) values (:reportText, :username, :bountyID)"
//   )
//   if($sth->execute($args)){
//     $result['success'] = true;
//   }
//   else{
//     $result['success'] = false;
//     $result['error'] = $sth->errorInfo();
//   }
//   echo json_encode($result);
// }

// $app->get('/api/getReport', function(){
//   global $dbh;
//   $args[':username'] = $_POST['username'];
//   $args[':marshallID'] = $_POST['marshallID'];
//   $args[':bountyID'] = $_POST['bountyID'];
//   $sth = $dbh->prepare(
//   "SELECT ReportText, Paid, Assessed, payountAmt, dateSubmitted, ScreenshotFolderLoc FROM Report
//     WHERE marshallID = :marshallID AND bountyID = :bountyID");
//   )
//   if($sth->execute($args)){
//     $row = $sth->fetch(PDO::FETCH_ASSOC);
//     $result['success'] = true;
//     $result['ReportText'] = $row['ReportText'];
//     $result['Paid'] = $row['Paid'];
//     $result['Assessed'] = $row['Assessed'];
//     $result['payountAmt'] = $row['payountAmt'];
//     $result['dateSubmitted'] = $row['dateSubmitted'];
//     $result['ScreenshotFolderLoc'] = $row['ScreenshotFolderLoc'];
//   }
//   else{
//     $result['success'] = false;
//     $result['error'] = $sth->errorInfo();
//   }
//   echo json_encode($result);
// });
