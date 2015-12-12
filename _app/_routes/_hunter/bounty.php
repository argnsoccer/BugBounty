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

	$args[":bountyID"] = $bountyID;

	$template_array['bounty'] = getBountyFromBountyID($dbh, $args);
	$template_array['bounty']['id'] = $bountyID;

	$args[':username'] = $_SESSION['userLogin'];

	$template_array['submittedReports'] = getReportsFromUsernameBountyID($dbh, $args);

	

	return $template_array;
}

$app->get('/_hunter/bounty/:bountyID', function($bountyID) use ($app, $dbh) {

if($_SESSION['userType'] == 'hunter')
{
	$template_array = prepareBountyProPage($dbh, $bountyID);

		$app->render('_hunter/bounty.php', $template_array);

	// echo print_r($template_array);
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorSolution'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}
});