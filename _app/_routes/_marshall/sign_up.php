<?php

if(!isset($_SESSION))
{
  session_start();
}
session_set_cookie_params(0);

$app->get('/_marshall/signup', function() use ($app) {
	$app->render('_marshall/sign_up.php');
});
