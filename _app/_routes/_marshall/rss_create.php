<?php

session_start();
session_set_cookie_params(0);

function prepareMarshallRSSCreate($dbh, $username)
{
		
	if ($username === $_SESSION['userLogin'] 
		&& $_SESSION['userType'] === 'marshall')
	{
		$template_array['username'] = $username;
		$template_array['userType'] = $_SESSION['userType'];
		$template_array['email'] = $_SESSION['email'];

		$template_array["error"] = 0; //for time being

		return $template_array;
	}
	else
	{

	}
}

$app->get('/_marshall/rsscreate', function() use ($app) {
	echo "include a username";
});

$app->get('/_marshall/rsscreate/:username', function($username) use ($app, $dbh) {
	//echo $username;

	$template_array = prepareMarshallRSSCreate($dbh, $username);

	if (isset($_SESSION['userLogin'])
		&& isset($template_array['error'])
		&& $template_array['error'] === 0)
	{
		$app->render('_marshall/rss_create.php', $template_array);
	}
	else 
	{
		echo "Not singed in correctly";
	}
});
