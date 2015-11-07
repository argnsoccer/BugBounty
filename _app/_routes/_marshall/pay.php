<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshall/pay', function($bounty_id) use ($app) {
	$app->render('_marshall/pay.php');
});