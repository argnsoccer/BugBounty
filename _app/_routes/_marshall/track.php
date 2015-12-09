<?php

session_start();
session_set_cookie_params(0);

function prepareTrackPage($dbh, $company, $bountyID)
{
	$template_array['company'] = $company;
	$args[':bountyID'] = $bountyID;
	$template_array['bounty'] = getBountyFromBountyID($dbh, $args);
	//$template_array['reports'] = getReportsFromBountyID($dbh, $args);

	//Test reports
	$template_array['reports'] = array(
		array(
			'dateCreated' => '2015-10-29',
			'name' => 'Tupac the Eskimo'
		),
		array(
			'dateCreated' => '2015-10-29',
			'name' => 'Tupac the Eskimo'
		),
		array(
			'dateCreated' => '2015-10-29',
			'name' => 'Tupac the Eskimo'
		),
		array(
			'dateCreated' => '2015-10-29',
			'name' => 'Tupac the Eskimo'
		),
		array(
			'dateCreated' => '2015-10-29',
			'name' => 'Tupac the Eskimo'
		)
	);

	$template_array['numReports'] = sizeof($template_array['reports']);

	return $template_array;
}

$app->get('/_marshall/track', function() use ($app) {
	echo "please include bounty id";
});

$app->get('/_marshall/track/:company/:bountyID', function($company, $bountyID) use ($app, $dbh)
{
	$template_array = prepareTrackPage($dbh, $company, $bountyID);

	$template_array['test'] =  "hey";
	$app->render('_marshall/track.php', $template_array);
	echo print_r($template_array);
});
