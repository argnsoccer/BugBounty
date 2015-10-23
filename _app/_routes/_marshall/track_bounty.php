<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshall/track', function() use ($app) {
	echo "please include bounty id";
});

$app->get('/_marshall/track/:bountyID', function($bountyID) use ($app) {
	echo $bountyID;
	$app->render('_marshall/track_bounty.php');
});