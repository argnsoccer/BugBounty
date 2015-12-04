<?php

session_start();
session_set_cookie_params(0);

function prepareMarshallRSSAdd($dbh, $username)
{
	// for marshall profile we need 
	// 	1)  email
	// 	2) company name
	// 	3) username
	// 	4) all bounties currently active for user
	// 	5) all bounties that have expired
		
	if ($username === $_SESSION['userLogin'] 
		&& $_SESSION['userType'] === 'marshall')
	{
		$template_array['username'] = $username;
		$template_array['userType'] = $_SESSION['userType'];
		$template_array['email'] = $_SESSION['email'];

		$template_array["error"] = 0; //for time being

		$args[":username"] = $username;

		$dummy = rssExists($dbh, $args);

		$template_array['rssExists'] = $dummy['exists'];

		return $template_array;
	}
	else
	{

	}
}

$app->get('/_marshall/rssadd', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_marshall/rssadd/:username', function($username) use ($app, $dbh) {
	//echo $username;

	$template_array = prepareMarshallRSSAdd($dbh, $username);

	if (isset($_SESSION['userLogin'])
		&& isset($template_array['error'])
		&& $template_array['error'] === 0
		&& $template_array['rssExists'])
	{
		$app->render('_marshall/rss_add.php', $template_array);
	}
	else if (!$template_array['rssExists'])
	{
		$template_array['sendMessage'] = "1";

		$app->render('_marshall/rss_create.php', $template_array);
	}
});