<?php

session_start();
session_set_cookie_params(0);

$app->get('/_marshall/rssinfo', function() use ($app, $dbh) {
	$app->render('_marshall/rss_info.php');
});
