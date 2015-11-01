<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshall/pay', function() use ($app) {
	echo "please include a bouty id";
});

$app->get('/_marshall/pay/:bountyID', function($bounty_id) use ($app) {
	echo $bounty_id;
	$app->render('_marshall/pay.php');
});