<?php

session_start();
session_set_cookie_params(0);

function prepareHunterProfile($dbh, $username) {
	// for the hunter profile page, we need
	// 	1)  the username
	// 	2)  the email
	// 	3)  the path to the profile picture
	// 	4)  all the reports this user has ever submitted
	// 		(paid and non-paid) (all info including bountyID)
		

	$args[':username'] = $username;

	$template_array['user'] = getHunterFromUsername($dbh, $args);

	$template_array['submittedReports'] = getReportsFromUsername($dbh, $args);

	$template_array['user']['numReportsFiled'] = sizeof($template_array['submittedReports']['result']);

	$template_array['reportsApproved'] = getNumberReportsApproved($dbh, $args);

	$template_array['user']['numReportsApproved'] = sizeof($template_array['reportsApproved']['result']);

	$template_array['pastBounties'] = getBountiesFromUsername($dbh, $args);

	return $template_array;

}

$app->get('/_hunter/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_hunter/profile/:username', function($username) use ($app, $dbh) {

	$template_array = prepareHunterProfile($dbh, $username);

	$app->render('_hunter/profile.php', $template_array);
	// echo print_r($template_array);

});
