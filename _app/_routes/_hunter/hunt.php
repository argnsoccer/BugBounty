<?php

session_start();
session_set_cookie_params(0);

$app->get('/_hunter/hunt', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/hunt.php', $template_array);

});