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
		&& $_SESSION['userType'] === 'marshal')
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
		$template_array['username'] = $username;
		$template_array['userLogin'] = $_SESSION['userLogin'];
		$template_array['userType'] = $_SESSION['userType'];
		$template_array['wtf'] = "hey";
		return $template_array;
	}
}

$app->get('/_marshal/rssadd', function() use ($app) {
if($_SESSION['userType'] == 'marshal')
{
	echo "include a username";
	//$app->render('_profiles/');
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php', $template_array);
}
});


$app->get('/_marshal/rssadd/:username', function($username) use ($app, $dbh) {
if($_SESSION['userType'] == 'marshal')
{
	//echo $username;

	$template_array = prepareMarshallRSSAdd($dbh, $username);

	if (isset($_SESSION['userLogin']))
	{
		$app->render('_marshall/rss_add.php', $template_array);
	}
	else if (!$template_array['rssExists'])
	{
		echo "here";
	}
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
}
});
