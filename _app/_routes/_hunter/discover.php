<?php

function prepareDiscoverPage($dbh) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email']
	);
	
	$template_array['bounties'] = array();  //call for 10 bounties

	return $template_array;
}

$app->get('/_hunter/discover', function() use ($app, $dbh) {

	$template_array = prepareDiscoverPage($dbh);

	$app->render('_hunter/discover.php', $template_array);

});