<?php

session_start();
session_set_cookie_params(0);

$app->get('/why', function() use ($app) {

	if (isset($_SESSION['userLogin'])) {

		$app->render('why.php', 
			array (
			"username" => "true",
			"userType" => $_SESSION['userType']));
	}
	else {
		$app->render('why.php');
	}

});