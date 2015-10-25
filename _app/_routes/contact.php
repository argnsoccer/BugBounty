<?php

session_start();
session_set_cookie_params(0);

$app->get('/contact', function() use ($app) {
	if (isset($_SESSION['userLogin'])) {
		$app->render('contact.php', array (
			"username" => "true"));
	}
	else {
		$app->render('contact.php');
	}
});