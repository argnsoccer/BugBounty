<?php

//session_destroy();
if(!isset($_SESSION))
{
  session_start();
}
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
