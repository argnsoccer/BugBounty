<?php

session_start();
session_set_cookie_params(0);

function prepareHomeMarshall($dbh, $username)
{
	$statement = $dbh->prepare("
				SELECT *
				FROM Account
				WHERE username = :username");

	$args[':username'] = $username;

	if($statement->execute($args)) {
		$row = $statement->fetch(PDO::FETCH_ASSOC);

    if (isset($row['username'])) {
    	$template_array = array(
    		"username" => $row['username'],
    		"email" => $row['email'],
    		"error" => 0,
    		//"picture" => $row['picture'],
    	);
    }
    else {
    	$template_array = array(
    		"error" => 1,
    		"message" => 'No username',
    	);
    }

	}
	else {
		$template_array = array(
    		"error" => 2,
    		"message" => 'Statement not ran',
    	);
	}

	return $template_array;
}

$app->get('/_marshall/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_marshall/profile/:username', function($username) use ($app, $dbh) {
	//echo $username;

	if (isset($_SESSION['userLogin']))
	{
		$template_array = prepareHomeMarshall($dbh, $username);

		if($template_array['error'] == 0)
		{
			$app->render('_marshall/profile.php', $template_array);
		}
		else if ($template_array['error'] == 1)
		{
			echo "error - No username is database with passed username";
		}
		else if ($template_array['error'] == 1)
		{
			echo "error - statement was not ran";
		}
	}
});
