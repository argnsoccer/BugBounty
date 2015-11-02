<?php

function prepareHunterProfile($dbh, $username)
{
	// for the hunter profile page, we need
	// 	1)  the username
	// 	2)  the email
	// 	3)  the path to the profile picture
	// 	4)  all the reports this user has ever submitted
	// 		(paid and non-paid) (all info including bountyID)
		

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

			$template_array = prepareHunterProfile($dbh, $username);

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
