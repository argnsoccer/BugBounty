<?php

session_start();
session_set_cookie_params(0);

$app->get('/signup', function() use ($app) {
	$app->render('sign_up.php');
});