<?php

session_start();
session_set_cookie_params(0);

function prepareMarshallProfile($dbh, $username)
{
	// for marshall profile we need
	// 	1)  email
	// 	2) company name
	// 	3) username
	// 	4) all bounties currently active for user
	// 	5) all bounties that have expired
	//call for current bounties in database
	//call for past bounties in database
	//call for profile picture

	$template_array["error"] = 0; //for time being
	$args[':username'] = $username;
	$template_array['user'] = getMarshalFromUsername($dbh, $args);
	$template_array['activeBounties'] = getActiveBounties($dbh, $args);
	$template_array['pastBounties'] = getPastBounties($dbh, $args);

	$template_array['user']['numActive'] = 
		sizeof($template_array['activeBounties']['result']);

	$template_array['user']['numTotal'] = 
		sizeof($template_array['activeBounties']['result']) +
		sizeof($template_array['pastBounties']['result']);

	return $template_array;
}

$app->get('/_marshall/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_marshall/profile/:username', function($username) use ($app, $dbh) {
	//echo $username;

	$template_array = prepareMarshallProfile($dbh, $username);

	if (isset($_SESSION['userLogin'])
		&& isset($template_array['error'])
		&& $template_array['error'] === 0)
	{
			$app->render('_marshall/profile.php', $template_array);
			echo print_r($template_array);
	}
	else
	{
		if ($template_array['error'] === 1)
		{
			echo "error - No username is database with passed username";
		}
		else if ($template_array['error'] === 2)
		{
			echo "error - statement was not ran";
		}
		else
		{
			echo "error - no error code returned";
		}
	}
});
