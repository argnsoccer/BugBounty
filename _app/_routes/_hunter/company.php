<?php

function prepareCompanyProfilePage($dbh, $companyUsername) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array = array(
		"username" => $_SESSION['userLogin'],
		"email" => $_SESSION['email'],
	);

	$args[':username'] = $companyUsername;

	$template_array['company'] = getMarshalFromUsername($dbh, $args);

	if ($template_array['company']['error'] == 2) {
		return $template_array;
	}

	$template_array['company']['name'] = $companyUsername;
	
	$template_array['company']['active'] = getActiveBounties($dbh, $args);

	$template_array['company']['inactive'] = getPastBounties($dbh, $args);

	$template_array['company']['numActive'] = sizeof($template_array['company']['active']['result']);

	$template_array['company']['numBounties'] = $template_array['company']['numActive'] + 
		(sizeof($template_array['company']['inactive']['result']));

	return $template_array;
}

$app->get('/_hunter/company/:companyName', function($companyUsername) use ($app, $dbh) {
if($_SESSION['userType'] == 'hunter')
{
	$template_array = prepareCompanyProfilePage($dbh, $companyUsername);


	if($template_array['company']['error'] == 2) {
		$template_array["errorMessage"] = "We have no Marshal with that username!";
		$template_array["errorSolution"] = "Try finding a new company!";

		$app->render('error.php', $template_array);
	}
	else {
		$app->render('_hunter/company.php', $template_array);

		echo print_r($template_array);
	}
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorSolution'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}

});