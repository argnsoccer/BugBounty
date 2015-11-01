<?php

//session_destroy();
session_start();
session_set_cookie_params(0);
//$_SESSION['userLogin'] = "mgilbert";
//$_SESSION['userType'] = "hunter";

$app->get('/howto', function() use ($app) {

	$app->render('how_to.php');
});