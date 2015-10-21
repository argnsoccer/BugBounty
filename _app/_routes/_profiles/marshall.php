<?php

session_start();
session_set_cookie_params(0);

$app->get('/_profiles/marshall', function() use ($app) {
	$app->render('_profiles/marshall.php');
});

$app->post('/_profiles/marshall', function() {
	echo "marshall page post";
});