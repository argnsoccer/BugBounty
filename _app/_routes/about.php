<?php

$app->get('/about', function() use ($app) {
		if (isset($_SESSION['userLogin'])) {
		$app->render('about.php', 
			array (
			"username" => "true",
			"userType" => $_SESSION['userType']));
	}
	else {
		$app->render('about.php');
	}
});