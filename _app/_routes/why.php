<?php

session_start();
session_set_cookie_params(0);

$app->get('/why', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('why.php', $template_array);

});