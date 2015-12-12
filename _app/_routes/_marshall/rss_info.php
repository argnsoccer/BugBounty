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
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorMessage'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}
});
