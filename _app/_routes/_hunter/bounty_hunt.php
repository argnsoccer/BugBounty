<?php

if(!isset($_SESSION))
{
  session_start();
}
session_set_cookie_params(0);

$app->get('/_hunter/bountyhunt', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('_hunter/bounty_hunt.php', $template_array);

});