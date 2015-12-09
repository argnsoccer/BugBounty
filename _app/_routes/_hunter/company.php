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

	$template_array['company'] = getUserFromUsername($dbh, $args);

	$template_array['company']['name'] = $companyUsername;
	
	$template_array['company']['active'] = getActiveBounties($dbh, $args);

	$template_array['company']['inactive'] = getPastBounties($dbh, $args);

	$template_array['company']['numActive'] = sizeof($template_array['company']['active'])-2;

	$template_array['company']['numBounties'] = (sizeof($template_array['company']['active'])-2) + 
		(sizeof($template_array['company']['inactive'])-2);

	return $template_array;
}

$app->get('/_hunter/company/:companyName', function($companyUsername) use ($app, $dbh) {

	$template_array = prepareCompanyProfilePage($dbh, $companyUsername);

	$app->render('_hunter/company.php', $template_array);

	echo print_r($template_array);

});