<?php

function prepareDiscoverPage($dbh) {
	// for discover, the template array must contain
	// 	1)  the username
	// 	2)  the email of the username
	// 	3)  the top 10 bounties

	$template_array['preferredBounties'] = getPreferredBounties($dbh);

	$template_array['username'] = $_SESSION['userLogin'];
	$template_array['email'] = $_SESSION['email'];

	return $template_array;
}

$app->get('/_hunter/discover', function() use ($app, $dbh) {
if($_SESSION['userType'] == 'hunter')
{
	$template_array = prepareDiscoverPage($dbh);

	$app->render('_hunter/discover.php', $template_array);
}
else
{
	$template_array['errorMessage'] = "You are not signed in as a hunter";
	$template_array['errorSolution'] = "Sign in or sign up as a hunter";
	$app->render('error.php', $template_array);
}

});
