<?php

function prepareContactPage($dbh) {
	
}

$app->get('/contact', function() use ($app) {
	if (isset($_SESSION['userLogin'])) {
		$app->render('contact.php', array (
			"username" => "true"));
	}
	else {
		$app->render('contact.php');
	}
});