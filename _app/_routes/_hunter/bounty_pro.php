<?php

function prepareBountyProPage($dbh, $bountyID) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email'],
		"bountyID" => $bountyID
	);
	
	$template_array['bounties'] = array();  //call for 10 bounties

	return $template_array;
}

$app->get('/_hunter/bountypro/:bountyID', function($bountyID) use ($app, $dbh) {

	$template_array = prepareBountyProPage($dbh, $bountyID);

	$app->render('_hunter/bounty_pro.php', $template_array);

});