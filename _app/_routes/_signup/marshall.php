<?php

$app->get('/_signup/marshall', function() use ($app) {
	$app->render('_signup/marshall.php');
});

$app->post('/_profiles/hunter', function() use ($app) {
	echo "hunter page post";
});