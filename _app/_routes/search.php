<?php

//session_destroy();
session_start();
session_set_cookie_params(0);
//$_SESSION['userLogin'] = "mgilbert";
//$_SESSION['userType'] = "hunter";

$app->get('/search', function() use ($app) {

	if (!isset($_SESSION['userLogin']))
	{
		echo "please login before searching!";
	}
	else
	{
		$app->render('search.php');
	}
});