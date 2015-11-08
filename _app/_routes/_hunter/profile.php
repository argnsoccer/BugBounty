<?php

session_start();
session_set_cookie_params(0);

function prepareHunterProfile($dbh, $username) {
	// for the hunter profile page, we need
	// 	1)  the username
	// 	2)  the email
	// 	3)  the path to the profile picture
	// 	4)  all the reports this user has ever submitted
	// 		(paid and non-paid) (all info including bountyID)
		
	if ($username === $_SESSION['userLogin'] 
		&& $_SESSION['userType'] === 'hunter')
	{
		$template_array['username'] = $username;
		$template_array['userType'] = $_SESSION['userType'];
		$template_array['email'] = $_SESSION['email'];
		$template_array['unpaid'] = array();  //call for paid and viewed reports
		$template_array['paid'] = array();  //call for paid and viewed reports
		$template_array['picture'] = "";  //call for profile picture

		$template_array['error'] = 0; //for time being

		return $template_array;
	}
	else
	{

	}
	
}

$app->get('/_hunter/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_hunter/profile/:username', function($username) use ($app, $dbh) {

	$template_array = prepareHunterProfile($dbh, $username);

	if (isset($_SESSION['userLogin'])
		&& isset($template_array['error'])
		&& $template_array['error'] === 0)
	{
			$app->render('_hunter/profile.php', $template_array);
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
