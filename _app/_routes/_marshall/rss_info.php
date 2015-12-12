<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshal/rssinfo', function() use ($app, $dbh) {
if($_SESSION['accountType'] == 'marshal')
{
	$app->render('_marshall/rss_info.php');
}
else
{
<<<<<<< HEAD
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
=======
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorMessage'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
>>>>>>> 15b1134c349cd2a4cef550bd06996170646ad4ca
}
});
