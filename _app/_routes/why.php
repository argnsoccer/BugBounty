<?php

function prepareWhyPage($dbh) {
	
}

$app->get('/why', function() use ($app) {

	$template_array = array("username" => "test");

	$app->render('why.php', $template_array);

});