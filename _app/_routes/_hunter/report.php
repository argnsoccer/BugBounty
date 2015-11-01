<?php

session_start();
session_set_cookie_params(0);

$app->get('/_hunter/report', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/report.php', $template_array);

});