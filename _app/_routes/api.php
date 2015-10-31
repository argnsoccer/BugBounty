<?php

if(!isset($_SESSION))
{
  session_start();
}
session_set_cookie_params(0);

// try {
//   $dbh = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
// }
// catch (PDOException $e) {
//     $response = "Failed to connect: ";
//     $response .= $e->getMessage();
//     die ($response);
// }

$app->get('/api/test', function () use ($dbh) {
    echo "API";
});

/*
Danny Rizzuto
Update the session information from javascript
Error Codes:
  0 = returns username
  1 = no user is logged in
*/

$app->get('/api/getLoggedInUser', function() {
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

  echo json_encode($result);

});

/*
Danny Rizzuto
Update the session information from javascript
Error Codes:
  0 = session info updated
  1 = session infor not updated
*/

$app->get('/api/updateSession', function ($property, $value) use ($dbh) {
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

  echo json_encode($result);
});

/*
Danny Rizzuto
Delete the current Session
Error Codes:
  0 = session deleted
  1 = session not deleted
*/

$app->get('/api/deleteSession', function() {
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

  echo json_encode($result);
});

/*
Danny Rizzuto
Check to see if user can login
Error Codes:
  0 = login user
  1 = user username/password incorrect
  2 = statement did not execute
Returns
  username
  userType
*/

$app->post('/api/userLogin', function () {
  $result['status'] = "complete";
  global $dbh;

  $args[':username'] = $_POST['username'];
  $args[':password'] = $_POST['password'];

  $statement = $dbh->prepare("SELECT username, userID, accountType FROM Account WHERE username = :username AND password = :password");

  if($statement->execute($args))
  {
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    if (isset($row['username']))
    {
      $result["username"] = strtolower($row['username']);
      $result["userType"] = strtolower($row['accountType']);
      $result['error'] = '0';
      $result['message']= "";

      $_SESSION['userLogin'] = strtolower($row['username']);
      $_SESSION['userType'] = strtolower($row['accountType']);
      $_SESSION['userID'] = $row['userID'];
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
*/

  $app->post('/api/userSignUp', function() {
    $result['status'] = "complete";
    global $dbh;

    $args[':username'] = strtolower($_POST['username']);
    $args[':password'] = $_POST['password'];
    $args[':email'] = strtolower($_POST['email']);
    $args[':accountType'] = strtolower($_POST['accountType']);


    $statement = $dbh->prepare(
      "INSERT INTO Account
      (username, email, password, dateCreated, accountType, dateOfLastActivity)
      VALUES
      (:username, :email, :password, NOW(), :accountType, NOW())");

    if($statement->execute($args))
    {
      $result['username'] = strtolower($_POST['username']);
      $result['userType'] = strtolower($_POST['accountType']);
      $result['error'] = '0';

      $_SESSION['userLogin'] = strtolower($_POST['username']);
      $_SESSION['userType'] = strtolower($_POST['accountType']);
    }
    else
    {
      $result['error'] = '1';
      $result['message'] = $statement->errorInfo()[2];

      //THIS NEEDS TO BE FIXED TO DIFFERENTIATE BETWEEN EMAIL AND USERNAME
    }

    echo json_encode($result);

  });

  /*
  Andre Gras
  Creates a Bounty
  Error Codes:
    0 = bounty created
    1 = statement did not execute
    2 = user was hunter
    3 = username sent does not match user logged in
  Returns
    username
    userType
  */

$app->post('/api/createBounty', function()
{
  global $dbh;

    $usn = $_POST['username'];
    if($usn != $_SESSION['userLogin'])
    {
      $result['errorCode'] = 3;
      $result['success'] = false;
      $result['errorInfo'] = 'username sent does not match user logged in';
      echo json_encode($result);
    }
    else{
      if($_SESSION['userType'] == 'marshall'){

        $args[':bountyName'] = $_POST['name'];
        $args[':payout'] = $_POST['payout'];
        $args[':link'] = $_POST['link'];
        $args[':endDate'] = $_POST['endDate'];
        $args[':fullDesc'] = $_POST['desc'];
        $sth = $dbh->prepare(
        "INSERT INTO BountyPool (dateCreated,PayoutPool,dateEnding,bountyMarshallID,bountyLink,fullDesc)
        VALUES (now(),:payout,:endDate,:userID,:link,:fullDesc)");
        if($sth->execute($args))
        {
          $result['success'] = true;
          $result['errorCode'] = 0;
        }
        else
        {
          $result['success'] = false;
          $result['errorCode'] = 1;
          $result['errorInfo'] = $sth->errorInfo();
        }
        echo json_encode($result);
    }
    else{
      $result['success'] = false;
      $result['errorCode'] = 2;
      $result['errorInfo'] = 'Must be Marshall to create bounties';
      echo json_encode($result);
    }
  }

});

$app->post('/logout', function() use ($dbh){
  session_destroy();
  $result = array("success" => true);
  echo json_encode($result);
});

$app->get('/api/getUser/:username', function($username) {
  global $dbh;
  $sth = $dbh->prepare(
    "SELECT userID, email, dateCreated FROM Account
    WHERE username = :username");
  $sth->bindParam(':username', $username);
  if ($sth->execute()) {
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    $result['success'] = true;
    $result['userID'] = $row['userID'];
    $result['email'] = $row['email'];
    $result['dateCreated'] = $row['dateCreated'];
  }
  else {
    $result['success'] = false;
    $result['error'] = $sth->errorInfo();
  }
  echo json_encode($result);
});

$app->post('/api/addUser', function() {
  global $dbh;

  if (!isset($_POST['email']) ||
    !isset($_POST['username']) ||
    !isset($_POST['password'])) {
    $result['success'] = false;
    $result['errorInfo'] = "please fill out all of the fields.";
    echo json_encode($result);
    return;
  }

  $infoCheck = validateSignUpInfo($_POST['username'], $_POST['email']);

  if ($infoCheck['validUsername'] == false) {
    $result['success'] = false;
    $result['errorInfo'] = $infoCheck['errorInfo']['usernameError'];
  }
  else if ($infoCheck['validEmail'] == false) {
    $result['success'] = false;
    $result['errorInfo'] = $infoCheck['errorInfo']['emailError'];
  }
  else {
    $args[':email'] = $_POST['email'];
    $args[':username'] = $_POST['username'];
    $args[':password'] = $_POST['password'];
    $sth = $dbh->prepare(
      "INSERT INTO Account (email, username, password, dateCreated, activated)
      VALUE (:email, :username, :password, NOW(), 1)");
    if ($sth->execute($args)) {
      $result['success'] = true;
      $result['userId'] = $dbh->lastInsertId();
    }
    else {
      $result['success'] = false;
      $result['errorInfo'] = $sth->errorInfo();
    }
  }
  echo json_encode($result);
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
