<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshal/upload', function() use ($app) {
	$app->render('_marshall/upload.php');
});