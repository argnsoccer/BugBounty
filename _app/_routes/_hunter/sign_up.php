<?php

session_start();
session_set_cookie_params(0);

$app->get('/_hunter/signup', function() use ($app) {
	$app->render('_hunter/sign_up.php');
});