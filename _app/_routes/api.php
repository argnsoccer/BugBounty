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
  $args[":imageLoc"] = "_images/_profiles/_".$args[':username'];
  mkdir($args[":imageLoc"]);
  copy("_images/_profiles/_mgilbert/mgilbert_profile.png", $args[":imageLoc"]."default_profile.png");
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
  INSERT INTO report (bountyID, username, description, link, dateSubmitted, pathToError)
  VALUES (:bountyID,:username,:description, :link, NOW(), :pathToError)");

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
    if($statement->execute($arsg))
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
  "SELECT * FROM report
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

  $statement = $dbh->prepare("
    SELECT BountyPool.* FROM Marshall, BountyPool
    WHERE Marshall.marshallID=BountyPool.bountyMarshallID
    AND Marshall.marshallID=:userID AND dateCreated < now()"
  ); //completed version of this will have dateCreated < now() < dateEnding (but our test vars)

  if($_SESSION['userType'] == 'marshall')
  {
    if($statement->execute($args))
    {
      $result['activeBounties'] = array();
      $result['error'] = 0;
      while($row = $statement->fetch(PDO::FETCH_ASSOC))
      {
       array_push($result['activeBounties'],$row);
      }
    }
    else
    {
      $result['error'] = '2';
      $result['message'] = 'Statement not executed';

    }
  }
  else{
    $result['error'] = '1';
    $result['message'] = 'user is not a Marshall';
  }
  return $result;
}

function getPastBounties($dbh, $args) {

  $statement = $dbh->prepare("
  SELECT BountyPool.* FROM Marshall, BountyPool
  WHERE Marshall.marshallID=BountyPool.bountyMarshallID AND Marshall.marshallID=:userID AND now() > dateEnding"); //completed version of this will have dateCreated < now() < dateEnding (but our test vars)
  if($_SESSION['userType'] == 'marshall')
  {
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
  }
  else{
    $result['error'] = '1';
    $result['message'] = 'user is not a Marshall';
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
  $args[':description'] = $_POST['description'];
  $args[':link'] = $_POST['link'];
  $args[':pathToError'] = $_POST['pathToError'];

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

$app->get('/api/getActiveBounties/', function($username) use ($dbh) {
  $args[':userID'] = $_SESSION['userID'];
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

  $args[':bountyID'] = $_GET['bountyID'];
  echo json_encode(getReportsFromBountyID($dbh,$args));

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

$app->get('/api/getPreferredBounties', function($bountyID) use ($dbh) {

  echo json_encode(getPreferredBounties($dbh));

});

$app->post('/api/payReport', function() use ($dbh){
  $clientToken = Braintree_ClientToken::generate([
    "customerId" => $aCustomerId
  ]);

});
