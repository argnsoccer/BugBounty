<?php

function prepareTrackPage($dbh) {

}

$app->get('/_marshall/track', function() use ($app) {
	echo "please include bounty id";
});

$app->get('/_marshall/track/:bountyID', function($bountyID) use ($app) {
	echo $bountyID;
	$app->render('_marshall/track.php');
});