<?php

//session_destroy();
session_start();
session_set_cookie_params(0);
//$_SESSION['userLogin'] = "mgilbert";
//$_SESSION['userType'] = "hunter";

$app->get('/', function() use ($app) {

	if (isset($_SESSION['userLogin']))
	{
		if ($_SESSION['userType'] == 'hunter')
		{

			$app->render('/_hunter/home.php', 
				array('username' => $_SESSION['userLogin']));
		}
		else if ($_SESSION['userType'] == 'marshall' || $_SESSION['userType'] == 'sheriff')
		{
			$app->render('/_marshall/home.php');
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