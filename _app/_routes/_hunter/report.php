<?php

session_start();
session_set_cookie_params(0);

function prepareReportPage($dbh, $bountyID) {

	//Need bounty link, bounty name, bounty owner

	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email'],
	);

	$template_array["bounty"] = array(
		'id' => $bountyID,
		'name' => '',
		'ownder' => '',
		'link' => "http://www.smu.edu"
		); //call for bounty link, name, ownder

	return $template_array;
}

$app->get('/_hunter/report', function() use ($app, $dbh) {

	echo "please include a bounty ID";

});

$app->get('/_hunter/report/:bountyID', function($bountyID) use ($app, $dbh) {

	$template_array = prepareReportPage($dbh, $bountyID);

	$app->render('_hunter/report.php', $template_array);

});