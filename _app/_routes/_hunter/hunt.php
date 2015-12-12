<?php

session_start();
session_set_cookie_params(0);

function prepareHuntpage($dbh, $bountyID){

	// for Hunt, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the bounty link
	//	4)  the bounty name
	//	5)  the bounty owner

	$args[':bountyID'] = $bountyID;

	$template_array = getBountyFromBountyID($dbh, $args);

	$template_array["username"] = $_SESSION['userLogin'];
	$template_array["email"] = $_SESSION['email'];



	// $template_array= array(
	// 	'id' => $bountyID,
	// 	'name' => '',
	// 	'ownder' => '',
	// 	'bountyLink' => "http://www.soccernet.com"
	// 	); //call for bounty link, name, ownder


	return $template_array;
}

$app->get('/_hunter/hunt', function() use ($app) {
if($_SESSION['accountType'] == 'hunter')
{
	echo "please include a bounty ID";
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorSolution'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}
});

$app->get('/_hunter/hunt/:bountyID', function($bountyID) use ($app, $dbh) {
if($_SESSION['accountType'] == 'hunter')
{
	$template_array = prepareHuntpage($dbh, $bountyID);

	// echo print_r($template_array);

	$app->render('_hunter/hunt.php', $template_array);
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorSolution'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}

});
