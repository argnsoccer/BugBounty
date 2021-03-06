<?php

session_start();
session_set_cookie_params(0);

function prepareTrackPage($dbh, $bountyID)
{
	$template_array['company'] = $company;
	$args[':bountyID'] = $bountyID;
	$template_array['bounty'] = getBountyFromBountyID($dbh, $args);
	$template_array['submittedReports'] = getReportsFromBountyID($dbh, $args);
	//$template_array['reports'] = getReportsFromBountyID($dbh, $args);

	$template_array['numReports'] = sizeof($template_array['submittedReports']['result']);

	return $template_array;
}

$app->get('/_marshal/track', function() use ($app) {
if($_SESSION['userType'] == 'marshal')
{
	echo "please include bounty id";
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
}
});

$app->get('/_marshal/track/:bountyID', function($bountyID) use ($app, $dbh){
if($_SESSION['userType'] == 'marshal')
{
	$template_array = prepareTrackPage($dbh, $bountyID);

	$template_array['test'] =  "hey";
	$app->render('_marshall/track.php', $template_array);
	// echo print_r($template_array);
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
}
});
