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

	//Test reports
	/*$template_array['reports'] = array(
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
	);*/

	$template_array['numReports'] = sizeof($template_array['reports']);

	return $template_array;
}

$app->get('/_marshal/track', function() use ($app) {
if($_SESSION['accountType'] == 'marshal')
{
	echo "please include bounty id";
}
else
{
<<<<<<< HEAD
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
=======
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorMessage'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
>>>>>>> 15b1134c349cd2a4cef550bd06996170646ad4ca
}
});

$app->get('/_marshal/track/:bountyID', function($bountyID) use ($app, $dbh)
{
if($_SESSION['accountType'] == 'marshal')
{
	$template_array = prepareTrackPage($dbh, $bountyID);

	$template_array['test'] =  "hey";
	$app->render('_marshall/track.php', $template_array);
	echo print_r($template_array);
}
else
{
<<<<<<< HEAD
	$template_array['errorMessage'] = "You are not signed in as a marshal";
	$template_array['errorSolution'] = "Sign in or sign up as a marshal";
	$app->render('error.php',$template_array);
=======
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorMessage'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
>>>>>>> 15b1134c349cd2a4cef550bd06996170646ad4ca
}
});
