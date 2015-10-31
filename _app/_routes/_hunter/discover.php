<?php

session_start();
session_set_cookie_params(0);

$app->get('/_hunter/discover', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/discover.php', $template_array);

});