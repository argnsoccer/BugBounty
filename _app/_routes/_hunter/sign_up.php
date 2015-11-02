<?php

$app->get('/_hunter/signup', function() use ($app) {
	$app->render('_hunter/sign_up.php');
});