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
	echo "please include bounty id";
});

$app->get('/_marshal/track/:bountyID', function($bountyID) use ($app, $dbh)
{
	$template_array = prepareTrackPage($dbh, $bountyID);

	$template_array['test'] =  "hey";
	$app->render('_marshall/track.php', $template_array);
	echo print_r($template_array);
});
