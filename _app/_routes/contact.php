<?php

session_start();
session_set_cookie_params(0);

$app->get('/contact', function() use ($app) {
	$app->render('contact.php');
});