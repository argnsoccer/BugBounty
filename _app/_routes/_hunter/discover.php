<?php

function prepareDiscoverPage($dbh) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array = array();

	return $template_array;
}

$app->get('/_hunter/discover', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/discover.php', $template_array);

});