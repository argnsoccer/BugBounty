<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshal/signup', function() use ($app) {
	$app->render('_marshall/sign_up.php');
});