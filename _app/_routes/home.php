<?php

session_start();
session_set_cookie_params(0);

$app->get('/', function() use ($app) {

	if (isset($_SESSION['userLogin']))
	{
		echo $_SESSION['userLogin'];
		if ($_SESSION['userType'] == 'hunter')
		{
			$app->render('/_profiles/hunter.php');
		}
	}
	else
	{
		$app->render('home.php');
	}
});