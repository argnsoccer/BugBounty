<?php

$app->get('/_signup/hunter', function() use ($app) {
	$app->render('_signup/hunter.php');
});

$app->post('/_profiles/hunter', function() use ($app) {
	echo "hunter page post";
});