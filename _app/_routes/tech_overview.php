<?php

session_start();
session_set_cookie_params(0);

$app->get('/tech_overview', function() use ($app) {

	if (isset($_SESSION['userLogin'])) {

		$app->render('tech_overview.php',
			array (
			"username" => "true",
			"userType" => $_SESSION['userType']));
	}
	else {
		$app->render('tech_overview.php');
	}

});
