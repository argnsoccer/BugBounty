<?php

session_start();
session_set_cookie_params(0);

$app->get('/_hunter/profile', function() use ($app) {
	echo "include a username";
	//$app->render('_profiles/');
});

$app->get('/_hunter/profile/:username', function($username) use ($app) {
	//echo $username;
	$app->render('_hunter/profile.php', array('username' => $_SESSION['userLogin']));
});