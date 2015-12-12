<?php

session_start();
session_set_cookie_params(0);

function prepareSearchHunterPage($dbh) {
	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email']
	);

	return $template_array;
}

$app->get('/_hunter/search', function() use ($app, $dbh) {
if($_SESSION['accountType'] == 'hunter')
{
	$template_array = prepareSearchHunterPage($dbh);

	$app->render('_hunter/search.php', $template_array);
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorMessage'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}
});