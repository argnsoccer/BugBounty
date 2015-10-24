<?php

session_start();
session_set_cookie_params(0);

$app->get('/_hunter/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_hunter/profile/:username', function($username) use ($app) {
	
	//echo $username;
	if (isset($_SESSION['userLogin']))
	{
		if($_SESSION['userLogin'] == $username)
		{
			$app->render('_hunter/profile.php', array('username' => $_SESSION['userLogin']));
		}
		else 
		{
			echo "You do not have access to view another person's profile";
		}
	}
	else
	{
		echo "please login";
	}
});