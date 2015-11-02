<?php

function prepareHuntPage($dbh, $username, $bountyID) {
	// the hunt page needs
	// 	1) the username
	// 	2) the email
	// 	3) all info regarding the bounty

	$template_array = array();

	return $template_array;
}

$app->get('/_hunter/hunt', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/hunt.php', $template_array);

});