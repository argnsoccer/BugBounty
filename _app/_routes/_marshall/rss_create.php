<?php

session_start();
session_set_cookie_params(0);

function prepareMarshallRSSCreate($dbh, $username)
{
		
	if ($username === $_SESSION['userLogin'] 
		&& $_SESSION['userType'] === 'marshal')
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

$app->get('/_marshal/rsscreate', function() use ($app) {
if($_SESSION['accountType'] == 'marshal')
{
	echo "include a username";
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
}
});

$app->get('/_marshall/rsscreate/:username', function($username) use ($app, $dbh) {
if($_SESSION['accountType'] == 'marshal')
{
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
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
}
});
