<?php

//session_destroy();
session_start();
session_set_cookie_params(0);
//$_SESSION['userLogin'] = "mgilbert";
//$_SESSION['userType'] = "hunter";

function prepareHome($dbh){

	if ($_SESSION['userType'] === "hunter")
	{
		$template_array["username"] = $_SESSION['userLogin'];

		$template_array['preferredBounties'] = getPreferredBounties($dbh);

		$template_array['messageOfDay'] = getMessageOfDayHunter($dbh);

		$args[':username'] = $_SESSION['userLogin'];

		$template_array['trackBounties'] = getBountiesFromUsernameRecentReports($dbh, $args);

		// $template_array['subscriptions'] = getRSSSubscriptions($dbh);

		return $template_array;
	}
	else if($_SESSION['userType'] === "marshal")
	{
		$template_array["username"] = $_SESSION['userLogin'];

		$args[':username'] = $_SESSION['userLogin'];

		$template_array['rssExists'] = rssExists($dbh, $args);

		$dummy = getMessageOfDayMarshal($dbh);

		$template_array["messageOfDay"] = getMessageOfDayMarshal($dbh);

		return $template_array;
	}
	else 
	{
		$template_array = getPreferredBounties($dbh);

		return $template_array;
	}
}

$app->get('/', function() use ($app, $dbh) {

	echo $_SESSION['username'];

	if (isset($_SESSION['userLogin']))
	{
		if ($_SESSION['userType'] == 'hunter')
		{

			$template_array = prepareHome($dbh);

			$app->render('/_hunter/home.php', $template_array);

			// echo print_r($template_array);
		}
		else if ($_SESSION['userType'] == 'marshal' 
			|| $_SESSION['userType'] == 'sheriff'
			|| $_SESSION['userType'] == 'marshal')
		{

			$template_array = prepareHome($dbh);

			$app->render('/_marshall/home.php', $template_array);

			echo print_r($template_array);
		}
		else
		{
			echo "account type not specified";
		}
	}
	else
	{
		$template_array = prepareHome($dbh);

		$app->render('home.php', $template_array);

		// echo print_r($template_array);
	}
});
