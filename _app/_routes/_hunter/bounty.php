<?php

function prepareBountyProPage($dbh, $companyName, $bountyID) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email'],
		"bountyID" => $bountyID
	);

	$args[":bountyID"] = $bountyID;

	$template_array['bounty'] = getBountyFromBountyID($dbh, $args);
	$template_array['bounty']['companyName'] = $companyName;
	$template_array['bounty']['id'] = $bountyID;

	$args[':username'] = $_SESSION['userLogin'];

	$template_array['submittedReports'] = getReportsFromUsernameBountyID($dbh, $args);

	

	return $template_array;
}

$app->get('/_hunter/bounty/:company/:bountyID', function($companyName, $bountyID) use ($app, $dbh) {

	$template_array = prepareBountyProPage($dbh, $companyName, $bountyID);

	$app->render('_hunter/bounty.php', $template_array);

	// echo print_r($template_array);

});