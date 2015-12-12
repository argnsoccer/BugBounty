<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshal/upload', function() use ($app) {
if($_SESSION['userType'] == 'marshal')
{
	$app->render('_marshall/upload.php');
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorSolution'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}
});