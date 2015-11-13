<?php

//session_destroy();
session_start();
session_set_cookie_params(0);
//$_SESSION['userLogin'] = "mgilbert";
//$_SESSION['userType'] = "hunter";

function prepareHome($dbh){

	if ($_SESSION['userType'] === "hunter")
	{
		$template_array["username"] = $_SESSION['username'];

		$template_array['trackBounties'] = array(
			array (
				'id' => "0001",
				'name' => "Google"),
			array (
				'id' => "0002",
				'name' => "Microsoft"),
			array (
				'id' => "0003",
				'name' => "Apple"),
			array (
				'id' => "0004",
				'name' => "Yahoo")
		); //need to be 4 most recent bounties

		return $template_array;
	}
	else if($_SESSION['userType'] === "marshall")
	{
		$template_array["username"] = $_SESSION['username'];

		return $template_array;
	}
}

$app->get('/', function() use ($app, $dbh) {

	if (isset($_SESSION['userLogin']))
	{
		if ($_SESSION['userType'] == 'hunter')
		{

			$template_array = prepareHome($dbh);

			$app->render('/_hunter/home.php', $template_array);
		}
		else if ($_SESSION['userType'] == 'marshall' || $_SESSION['userType'] == 'sheriff')
		{

			$template_array = prepareHome($dbh);

			$app->render('/_marshall/home.php', $template_array);
		}
		else
		{
			echo "account type not specified";
		}
	}
	else
	{
		$app->render('home.php');
	}
});
