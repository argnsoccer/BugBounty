<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshal/signup', function() use ($app) {
if($_SESSION['accountType'] == 'marshal')
{
	$app->render('_marshall/sign_up.php');
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
}
});