<?php

session_start();
session_set_cookie_params(0);


function prepareHomeHunter($dbh, $username)
{
	$template_array = array();

	$statement = $dbh->prepare("
				SELECT *
				FROM Account
				WHERE username = :username");

	$args[':username'] = $username;

	if($statement->execute($args)) {
		$row = $statement->fetch(PDO::FETCH_ASSOC);

    if (isset($row['username'])) {
			$template_array = array(

				'error' => array('code' => '0', 'message' => 'success'),
				'user' => array("username" => $row['username'], "email" => $row['email'], "userID" => $row['userID'])
			);

    }
    else {
    	$template_array['error'] = array(
    		"code" => '1',
    		"message" => 'No username'
			);

    	return $template_array;
    }

	}
	else {
		$template_array = array(
    		"error" => '2',
    		"message" => 'Statement not ran'
    	);

    	return $template_array;
	}
	/*$args2[':username'] = $_SESSION['userLogin'];
	$statement = $dbh->prepare("
	SELECT * FROM Report
	WHERE username=:username");

	if($statement->execute($args2)){
		$template_array['reports'] = array(

		);
	}*/
	// $statement = $dbh->("
	// 	SELECT *
	// 	FROM Report
	// 	WHERE hunterID = :hunterID
	// 	");

	// if($statement->execute($args)) {

	// 	$template_array['reports'] = array();

	// 	while($row = $statement->fetch(PDO::FETCH_ASSOC))
	// 	{
	// 		$report['reportText'] = $row['reportText'];
	// 		$report
	// 		array_push($template_array['reports'], $report);
	// 	}
	// }

	return $template_array;
}





$app->get('/_hunter/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_hunter/profile/:username', function($username) use ($app, $dbh) {

	//echo $username;
	if (isset($_SESSION['userLogin']))
	{
		if($_SESSION['userLogin'] == $username)
	{

			$template_array = prepareHomeHunter($dbh, $username);

			if($template_array['error'] == 0)
			{
				$app->render('_hunter/profile.php', $template_array);
			}
			else if ($template_array['error'] == 1)
			{
				echo "error - No username is database with passed username";
			}
			else if ($template_array['error'] == 1)
			{
				echo "error - statement could not be run";
			}
		}
		else
		{
			echo "please login";
		}
	}
	else
	{
		echo "No session setup";
	}
});
