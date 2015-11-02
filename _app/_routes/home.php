<?php

function prepareHomePage($dbh) {
	
}

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
			$app->render('/_marshall/home.php', 
				array('username' => $_SESSION['userLogin']));
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