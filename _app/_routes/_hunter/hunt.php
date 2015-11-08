<?php

session_start();
session_set_cookie_params(0);

function prepareHuntpage($dbh, $bountyID){

	// for HUnt, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the bounty link
	//	4)  the bounty name
	//	5)  the bounty owner

	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email']
	);
	
	$template_array["bounty"] = array(
		'id' => $bountyID,
		'name' => '',
		'ownder' => '',
		'link' => "http://www.smu.edu"
		); //call for bounty link, name, ownder

	
	return $template_array;
}

$app->get('/_hunter/hunt', function() use ($app) {

	echo "please include a bounty ID";

});

$app->get('/_hunter/hunt/:bountyID', function($bountyID) use ($app, $dbh) {

	$template_array = prepareHuntpage($dbh, $bountyID);

	$app->render('_hunter/hunt.php', $template_array);

});