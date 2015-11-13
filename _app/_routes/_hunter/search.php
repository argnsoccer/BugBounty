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

	$template_array = prepareSearchHunterPage($dbh);

	$app->render('_hunter/search.php', $template_array);

});