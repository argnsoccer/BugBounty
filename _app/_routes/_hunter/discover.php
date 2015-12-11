<?php

function prepareDiscoverPage($dbh) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array['preferredBounties'] = getPreferredBounties($dbh);

	$template_array['username'] = $_SESSION['userLogin'];
	$template_array['email'] = $_SESSION['email'];

	return $template_array;
}

$app->get('/_hunter/discover', function() use ($app, $dbh) {

	$template_array = prepareDiscoverPage($dbh);

	$app->render('_hunter/discover.php', $template_array);
	echo print_r($template_array);

});