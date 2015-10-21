<?php

session_start();
session_set_cookie_params(0);

$app->get('/_profiles/hunter', function() use ($app) {
	$app->render('_profiles/hunter.php');
});

$app->post('/_profiles/hunter', function() use ($app) {
	echo "hunter page post";
});