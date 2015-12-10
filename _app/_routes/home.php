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

		$template_array['trackBounties'] = array(
			array (
				'id' => "0001",
				'company' => 'testMarshall1',
				'number' => 3,
				'date' => '11/03/1993',
				'name' => "Google Needs A Car"),
			array (
				'id' => "0002",
				'company' => 'Microsoft',
				'number' => 3,
				'date' => '11/03/1993',
				'name' => "Microsoft Helps the World"),
			array (
				'id' => "0003",
				'company' => 'Apple',
				'number' => 3,
				'date' => '11/03/1993',
				'name' => "Apple wants an orange"),
			array (
				'id' => "0004",
				'company' => 'Yahoo',
				'number' => 3,
				'date' => '11/03/1993',
				'name' => "Yahoo is not very good milk")
		); //need to be 4 most recent bounties

		return $template_array;
	}
	else if($_SESSION['userType'] === "marshall")
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
		}
		else if ($_SESSION['userType'] == 'marshall' || $_SESSION['userType'] == 'sheriff')
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
	}
});
