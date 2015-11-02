<?php

function prepareHowToPage($dbh) {
	
}

$app->get('/howto', function() use ($app) {

	$app->render('how_to.php');
});